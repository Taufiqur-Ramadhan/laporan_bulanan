<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KegiatanResource\Pages;
use App\Filament\Resources\KegiatanResource\RelationManagers;
use App\Models\Kegiatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Database\Eloquent\Collection;

class KegiatanResource extends Resource
{
    protected static ?string $model = Kegiatan::class;
    protected static ?string $pluralModelLabel = 'Kegiatan';
    protected static ?string $modelLabel = 'Kegiatan';
    protected static ?string $navigationGroup = 'Manajemen';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Status Revisi')
                    ->description('Catatan dari admin jika laporan memerlukan perbaikan.')
                    ->schema([
                        Forms\Components\Placeholder::make('catatan_revisi_display')
                            ->label('Pesan Revisi')
                            ->content(fn ($record) => $record?->catatan_revisi),
                    ])
                    ->icon('heroicon-m-exclamation-triangle')
                    ->aside()
                    ->collapsed(false)
                    ->visible(fn ($record) => $record && $record->status === 'revision' && $record->catatan_revisi)
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('nama_kegiatan')
                ->label('Nama Kegiatan')
                ->required()
                ->maxLength(255),
            
            Forms\Components\Select::make('budget_id')
                ->label('Alokasi Anggaran')
                ->relationship('budget', 'nama_program')
                ->getOptionLabelFromRecordUsing(fn ($record) => "[{$record->kode_rekening}] {$record->nama_program}")
                ->searchable()
                ->preload()
                ->required(),

            Forms\Components\TextInput::make('anggaran')
                ->label('Anggaran Kegiatan')
                ->required()
                ->numeric()
                ->prefix('Rp')
                ->default(0),
                
             Forms\Components\Textarea::make('deskripsi')
                ->label('Deskripsi')
                ->rows(6)
                ->columnSpanFull()
                ->required(),

            Forms\Components\Grid::make(2)
                ->schema([  
                    Forms\Components\FileUpload::make('foto_sebelum')
                        ->label('Foto Sebelum')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('kegiatan/before')
                        ->required(),

                    Forms\Components\FileUpload::make('foto_sesudah')
                        ->label('Foto Sesudah')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('kegiatan/after')
                        ->required()
                ]),



            Forms\Components\Grid::make(2)
                ->schema([
                    Forms\Components\TextInput::make('latitude')
                        ->numeric()
                        ->readOnly(),
                    Forms\Components\TextInput::make('longitude')
                        ->numeric()
                        ->readOnly(),
                ]),

            Forms\Components\TextInput::make('search_location')
                ->label('Cari Lokasi')
                ->placeholder('Ketik nama tempat lalu tekan Enter atau klik icon cari...')
                ->prefixIcon('heroicon-o-magnifying-glass')
                ->helperText('Contoh: "Monas", "Alun-alun Klaten", atau "Jalan Pemuda Jakarta"')
                ->columnSpanFull()
                ->dehydrated(false)
                ->live(onBlur: true)
                ->extraInputAttributes([
                    'onkeydown' => "if (event.key === 'Enter') { event.preventDefault(); @this.callAfterStateUpdated('search_location'); }",
                ])
                ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set, $livewire, $state) {
                    if (empty($state)) return;

                    try {
                        $response = \Illuminate\Support\Facades\Http::withHeaders([
                            'User-Agent' => 'LaporanBulanan/1.0',
                        ])->get('https://nominatim.openstreetmap.org/search', [
                            'q' => $state,
                            'format' => 'json',
                            'limit' => 1,
                            'countrycodes' => 'id'
                        ]);

                        if ($response->successful()) {
                            $data = $response->json();
                            if (!empty($data)) {
                                $lat = (float) $data[0]['lat'];
                                $lng = (float) $data[0]['lon'];
                                $label = $data[0]['display_name'];

                                $set('latitude', $lat);
                                $set('longitude', $lng);
                                $set('location', ['lat' => $lat, 'lng' => $lng]);

                                $livewire->dispatch('refreshMap');

                                \Filament\Notifications\Notification::make()
                                    ->title('Lokasi ditemukan')
                                    ->body($label)
                                    ->success()
                                    ->send();
                            } else {
                                \Filament\Notifications\Notification::make()
                                    ->title('Lokasi tidak ditemukan')
                                    ->body('Coba gunakan kata kunci lain.')
                                    ->warning()
                                    ->send();
                            }
                        }
                    } catch (\Exception $e) {
                        \Filament\Notifications\Notification::make()
                            ->title('Kesalahan sistem')
                            ->body('Gagal menghubungkan ke layanan peta.')
                            ->danger()
                            ->send();
                    }
                })
                ->suffixAction(
                    Forms\Components\Actions\Action::make('do_search')
                        ->icon('heroicon-m-magnifying-glass')
                        ->color('primary')
                ),

            \Dotswan\MapPicker\Fields\Map::make('location')
                ->label('Location')
                ->columnSpanFull()
                ->dehydrated(false)
                ->afterStateUpdated(function (Forms\Get $get, Forms\Set $set, mixed $old, ?array $state) {
                    if ($state) {
                        $set('latitude', $state['lat']);
                        $set('longitude', $state['lng']);
                    }
                })
                ->afterStateHydrated(function ($state, $record, Forms\Set $set) {
                    if ($record) {
                        $set('location', ['lat' => $record->latitude, 'lng' => $record->longitude]);
                    }
                })
                ->extraStyles([
                    'min-height: 50vh',
                    'border-radius: 10px'
                ])
                ->liveLocation()
                ->showMarker()
                ->markerColor('#22c55e')
                ->showFullscreenControl()
                ->showZoomControl()
                ->draggable()
                ->tilesUrl('https://tile.openstreetmap.de/{z}/{x}/{y}.png')
                ->zoom(15)
                ->detectRetina()
                ->showMyLocationButton()
                ->geoMan(false)
                ->drawCircleMarker(false)
                ->rotateMode(false)
                ->drawMarker(false)
                ->drawPolygon(false)
                ->drawPolyline(false)
                ->drawCircle(false)
                ->dragMode(false)
                ->cutPolygon(false)
                ->editPolygon(false)
                ->deleteLayer(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal & Waktu')
                    ->dateTime('d/m/Y h:i A')
                    ->timezone('Asia/Jakarta')
                    ->sortable(),

                Tables\Columns\TextColumn::make('user.name')
                    ->label('Pelapor')
                    ->formatStateUsing(fn ($state, $record) => $record->user->role === 'admin' ? 'Admin' : "$state Anggota"),
                    
                Tables\Columns\TextColumn::make('nama_kegiatan')
                    ->label('Kegiatan')
                    ->searchable(),

                Tables\Columns\TextColumn::make('anggaran')
                    ->label('Anggaran')
                    ->money('IDR')
                    ->sortable(),



                Tables\Columns\TextColumn::make('deskripsi')
                    ->label('Isi Kegiatan')
                    ->limit(50)
                    ->wrap(),

                Tables\Columns\TextColumn::make('latitude')
                    ->label('Latitude')
                    ->numeric(),

                Tables\Columns\TextColumn::make('longitude')
                    ->label('Longitude')
                    ->numeric(),
                    
                Tables\Columns\ImageColumn::make('foto_sebelum')
                    ->label('Foto Sebelum')
                    ->disk('public')
                    ->height(60)
                    ->extraImgAttributes(['loading' => 'lazy']),

                Tables\Columns\ImageColumn::make('foto_sesudah')
                    ->label('Foto Sesudah')
                    ->disk('public')
                    ->height(60)
                    ->extraImgAttributes(['loading' => 'lazy']),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->label('Status')
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved' => 'success',
                        'revision' => 'info',
                        'rejected' => 'danger',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'revision' => 'Perlu Revisi',
                        'rejected' => 'Ditolak',
                        default => $state,
                    })
                    ->action(
                        Tables\Actions\Action::make('view_status_detail')
                            ->modalHeading(fn ($record) => match ($record->status) {
                                'approved' => 'Detail Persetujuan',
                                'revision' => 'Catatan Revisi',
                                'rejected' => 'Detail Penolakan',
                                default => 'Detail Status',
                            })
                            ->modalContent(fn ($record) => view('filament.components.status-detail', ['record' => $record]))
                            ->modalSubmitAction(false)
                            ->modalCancelActionLabel('Tutup')
                            ->visible(fn ($record) => in_array($record->status, ['approved', 'revision', 'rejected']))
                    ),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-m-check')
                    ->color('success')
                    ->visible(fn ($record) => auth()->user()->isAdmin() && $record->status === 'pending')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->update([
                        'status' => 'approved',
                        'verified_by' => auth()->id(),
                        'verified_at' => now(),
                    ])),

                Tables\Actions\Action::make('revision')
                    ->label('Revisi')
                    ->icon('heroicon-m-arrow-path')
                    ->color('warning')
                    ->visible(fn ($record) => auth()->user()->isAdmin() && $record->status === 'pending')
                    ->form([
                        Forms\Components\Textarea::make('catatan_revisi')
                            ->label('Catatan Revisi')
                            ->required()
                            ->rows(3),
                    ])
                    ->action(fn ($record, array $data) => $record->update([
                        'status' => 'revision',
                        'catatan_revisi' => $data['catatan_revisi'],
                        'verified_by' => auth()->id(),
                        'verified_at' => now(),
                    ])),

                Tables\Actions\Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-m-x-mark')
                    ->color('danger')
                    ->visible(fn ($record) => auth()->user()->isAdmin() && $record->status === 'pending')
                    ->requiresConfirmation()
                    ->action(fn ($record) => $record->update([
                        'status' => 'rejected',
                        'verified_by' => auth()->id(),
                        'verified_at' => now(),
                    ])),

                Tables\Actions\EditAction::make()
                    ->visible(fn ($record) => 
                        auth()->user()->isAdmin() || 
                        in_array($record->status, ['pending', 'revision'])
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListKegiatan::route('/'),
            'create' => Pages\CreateKegiatan::route('/create'),
            'edit' => Pages\EditKegiatan::route('/{record}/edit'),
        ];
    }

}
