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
                            ->unique(ignoreRecord: true)
                            ->minValue(2000)
                            ->maxValue(2100)
                            ->placeholder('Contoh: 2026'),
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
                Tables\Columns\TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('amount')
                    ->label('Total Anggaran')
                    ->money('IDR', locale: 'id_ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Terakhir Diubah')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
