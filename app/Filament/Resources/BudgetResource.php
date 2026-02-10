<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BudgetResource\Pages;
use App\Models\Budget;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BudgetResource extends Resource
{
    protected static ?string $model = Budget::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationGroup = 'Manajemen';
    protected static ?string $pluralModelLabel = 'Pengaturan Anggaran';
    protected static ?string $modelLabel = 'Anggaran Tahunan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Ketentuan Anggaran')
                    ->schema([
                        Forms\Components\TextInput::make('year')
                            ->label('Tahun')
                            ->numeric()
                            ->required()
                            ->minValue(2000)
                            ->maxValue(2100)
                            ->placeholder('Contoh: 2026'),
                        Forms\Components\TextInput::make('kode_rekening')
                            ->label('Kode Rekening')
                            ->required()
                            ->placeholder('Contoh: 5.1.02.01.01.001'),
                        Forms\Components\TextInput::make('nama_program')
                            ->label('Nama Program/Kegiatan')
                            ->required()
                            ->placeholder('Contoh: Gaji dan Tunjangan ASN')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('kategori')
                            ->label('Kategori')
                            ->options([
                                'Belanja Pegawai' => 'Belanja Pegawai',
                                'Belanja Barang & Jasa' => 'Belanja Barang & Jasa',
                                'Belanja Pemeliharaan' => 'Belanja Pemeliharaan',
                                'Belanja Perjalanan' => 'Belanja Perjalanan',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required(),
                        Forms\Components\TextInput::make('amount')
                            ->label('Pagu Anggaran')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->placeholder('Masukkan total anggaran tahunan'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kode_rekening')
                    ->label('Kode Rekening')
                    ->fontFamily('mono')
                    ->weight('bold')
                    ->color('primary'),
                Tables\Columns\TextColumn::make('nama_program')
                    ->label('Nama Program/Kegiatan')
                    ->description(fn (Budget $record): string => $record->kategori)
                    ->wrap(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Pagu Anggaran')
                    ->money('IDR', locale: 'id_ID')
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('realisasi')
                    ->label('Realisasi')
                    ->getStateUsing(fn (Budget $record) => $record->kegiatans()->where('status', 'approved')->sum('anggaran'))
                    ->money('IDR', locale: 'id_ID')
                    ->weight('medium'),
                Tables\Columns\TextColumn::make('persentase')
                    ->label('Persentase (%)')
                    ->getStateUsing(function (Budget $record) {
                        $realisasi = $record->kegiatans()->where('status', 'approved')->sum('anggaran');
                        return $record->amount > 0 ? ($realisasi / $record->amount) * 100 : 0;
                    })
                    ->formatStateUsing(fn ($state) => number_format($state, 1) . '%')
                    ->html()
                    ->view('filament.resources.budget-resource.columns.progress-bar'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('year')
                    ->label('Tahun')
                    ->options(fn () => \App\Models\Budget::distinct()->pluck('year', 'year')->toArray()),
            ])
            ->filtersLayout(Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Removed for cleaner UI
            ]);
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageBudgets::route('/'),
        ];
    }
}
