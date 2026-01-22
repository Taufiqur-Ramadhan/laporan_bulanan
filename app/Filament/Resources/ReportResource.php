<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReportResource\Pages;
use App\Models\Kegiatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;
use pxlrbt\FilamentExcel\Columns\Column;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Database\Eloquent\Collection;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KegiatanExport;

class ReportResource extends Resource
{
    protected static ?string $model = Kegiatan::class;
    protected static ?string $navigationIcon = 'heroicon-o-arrow-up-on-square-stack';
    protected static ?string $navigationGroup = 'Pelaporan';
    
    // Memberikan label bahasa Indonesia
    protected static ?string $pluralModelLabel = 'Export';
    protected static ?string $modelLabel = 'Export';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Informasi Utama')
                ->schema([
                    Forms\Components\TextInput::make('created_at')
                        ->label('Tanggal Input')
                        ->disabled(),
                    Forms\Components\TextInput::make('pelapor')
                        ->label('Pelapor')
                        ->afterStateHydrated(function ($state, $record, Forms\Set $set) {
                            if ($record && $record->user) {
                                $name = $record->user->name;
                                $role = $record->user->role;
                                $set('pelapor', $role === 'admin' ? 'Admin' : "$name Anggota");
                            }
                        })
                        ->disabled(),
                    Forms\Components\TextInput::make('nama_kegiatan')
                        ->label('Nama Kegiatan')
                        ->disabled(),
                    Forms\Components\TextInput::make('anggaran')
                        ->label('Anggaran')
                        ->prefix('Rp')
                        ->numeric()
                        ->disabled(),
                ])->columns(2),

            Forms\Components\Section::make('Detail & Dokumentasi')
                ->schema([
                    Forms\Components\Textarea::make('deskripsi')
                        ->label('Isi Kegiatan')
                        ->rows(5)
                        ->columnSpanFull()
                        ->disabled(),
                    
                    Forms\Components\Grid::make(2)
                        ->schema([
                            Forms\Components\FileUpload::make('foto_sebelum')
                                ->label('Foto Sebelum')
                                ->disk('public')
                                ->directory('kegiatan/before')
                                ->image()
                                ->disabled(),
                            Forms\Components\FileUpload::make('foto_sesudah')
                                ->label('Foto Sesudah')
                                ->disk('public')
                                ->directory('kegiatan/after')
                                ->image()
                                ->disabled(),
                        ]),
                ]),

            Forms\Components\Section::make('Lokasi & Status')
                ->schema([
                    Forms\Components\TextInput::make('latitude')
                        ->label('Latitude')
                        ->disabled(),
                    Forms\Components\TextInput::make('longitude')
                        ->label('Longitude')
                        ->disabled(),
                    Forms\Components\TextInput::make('status')
                        ->label('Status Laporan')
                        ->disabled(),
                ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('created_at')
                ->label('Tanggal')
                ->date('d/m/Y')
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
                ->limit(30)
                ->toggleable(),

            Tables\Columns\TextColumn::make('latitude')
                ->label('Latitude')
                ->numeric()
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\TextColumn::make('longitude')
                ->label('Longitude')
                ->numeric()
                ->toggleable(isToggledHiddenByDefault: true),

            Tables\Columns\ImageColumn::make('foto_sebelum')
                ->label('Foto Sebelum')
                ->disk('public')
                ->height(60),

            Tables\Columns\ImageColumn::make('foto_sesudah')
                ->label('Foto Sesudah')
                ->disk('public')
                ->height(60),
                
            Tables\Columns\TextColumn::make('status')
                ->badge()
                ->label('Status')
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'warning',
                    'approved' => 'success',
                    'revision' => 'warning',
                    'rejected' => 'danger',
                    default => 'gray',
                })
                ->formatStateUsing(fn (string $state): string => match ($state) {
                    'pending' => 'Menunggu',
                    'approved' => 'Disetujui',
                    'revision' => 'Perlu Revisi',
                    'rejected' => 'Ditolak',
                    default => $state,
                }),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('status')
                ->label('Status')
                ->options([
                    'pending' => 'Menunggu',
                    'approved' => 'Disetujui',
                    'revision' => 'Perlu Revisi',
                    'rejected' => 'Ditolak',
                ]),
        ])
        ->actions([
            Tables\Actions\ViewAction::make(),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\BulkAction::make('export_excel')
                    ->label('Export Excel')
                    ->icon('heroicon-o-document-chart-bar')
                    ->action(function (Collection $records) {
                        return Excel::download(new KegiatanExport($records), 'Laporan_Kegiatan' . date('Y-m-d') . '.xlsx');
                    }),
                Tables\Actions\BulkAction::make('export_word')
                    ->label('Export Word')
                    ->icon('heroicon-o-document-text')
                    ->action(function (Collection $records) {
                        $phpWord = new PhpWord();
                        $section = $phpWord->addSection();

                        $phpWord->addTitleStyle(1, ['size' => 16, 'bold' => true], ['alignment' => 'center']);
                        $section->addTitle('LAPORAN HASIL KEGIATAN', 1);
                        $section->addTextBreak(1);

                        foreach ($records as $record) {
                            $pelapor = $record->user->role === 'admin' ? 'Admin' : $record->user->name . " Anggota";
                            
                            // Header Information
                            $section->addText("Tanggal: " . ($record->created_at ? $record->created_at->format('d/m/Y') : '-'), ['size' => 11]);
                            $section->addText("Pelapor: " . $pelapor, ['size' => 11]);
                            $section->addText("Nama Kegiatan: " . $record->nama_kegiatan, ['bold' => true, 'size' => 12]);
                            $section->addText("Anggaran: Rp " . number_format($record->anggaran, 0, ',', '.'), ['size' => 11]);
                            $statusLabel = match ($record->status) {
                                'pending' => 'Menunggu',
                                'approved' => 'Disetujui',
                                'revision' => 'Perlu Revisi',
                                'rejected' => 'Ditolak',
                                default => $record->status,
                            };
                            $section->addText("Status: " . $statusLabel, ['size' => 11]);
                            $section->addText("Lokasi: " . $record->latitude . ", " . $record->longitude, ['size' => 11]);
                            $section->addText("Deskripsi: ", ['bold' => true, 'size' => 11]);
                            $section->addText($record->deskripsi, ['size' => 11]);
                            $section->addTextBreak(1);

                            // Image Table
                            $table = $section->addTable(['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 80]);
                            $table->addRow();
                            $table->addCell(4500)->addText("Foto Sebelum", ['bold' => true], ['alignment' => 'center']);
                            $table->addCell(4500)->addText("Foto Sesudah", ['bold' => true], ['alignment' => 'center']);
                            
                            $table->addRow(3000);
                            $cellBefore = $table->addCell(4500);
                            $cellAfter = $table->addCell(4500);

                            // Handle Before Photo
                            if ($record->foto_sebelum && \Illuminate\Support\Facades\Storage::disk('public')->exists($record->foto_sebelum)) {
                                $pathBefore = storage_path('app/public/' . $record->foto_sebelum);
                                $cellBefore->addImage($pathBefore, ['width' => 180, 'height' => 130, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                            } else {
                                $cellBefore->addText("Tidak ada foto", [], ['alignment' => 'center']);
                            }

                            // Handle After Photo
                            if ($record->foto_sesudah && \Illuminate\Support\Facades\Storage::disk('public')->exists($record->foto_sesudah)) {
                                $pathAfter = storage_path('app/public/' . $record->foto_sesudah);
                                $cellAfter->addImage($pathAfter, ['width' => 180, 'height' => 130, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]);
                            } else {
                                $cellAfter->addText("Tidak ada foto", [], ['alignment' => 'center']);
                            }

                            $section->addHorizontalLine();
                            $section->addTextBreak(1);
                        }

                        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
                        $fileName = 'Laporan_Kegiatan' . now()->format('Y-m-d') . '.docx';

                        return response()->streamDownload(function () use ($objWriter) {
                            $objWriter->save('php://output');
                        }, $fileName);
                    }),
            ]),
        ]);
    }

    public static function canViewAny(): bool
    {
        return true;
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReports::route('/'),
        ];
    }
}