<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ActivityLogResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Spatie\Activitylog\Models\Activity;

class ActivityLogResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-finger-print';
    protected static ?string $navigationGroup = 'Manajemen';
    protected static ?string $pluralModelLabel = 'Log Aktivitas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Aktivitas')
                    ->schema([
                        Forms\Components\TextInput::make('created_at')
                            ->label('Waktu Kejadian')
                            ->disabled(),
                        Forms\Components\TextInput::make('causer.name')
                            ->label('Nama Pelaku')
                            ->disabled()
                            ->placeholder('Sistem'),
                        Forms\Components\TextInput::make('event')
                            ->label('Jenis Aksi')
                            ->disabled(),
                        Forms\Components\TextInput::make('description')
                            ->label('Keterangan')
                            ->disabled(),
                        Forms\Components\TextInput::make('subject_type')
                            ->label('Modul')
                            ->disabled()
                            ->formatStateUsing(fn ($state) => str_replace('App\\Models\\', '', $state)),
                        Forms\Components\TextInput::make('subject_id')
                            ->label('ID Target')
                            ->disabled(),
                    ])->columns(2),
                Forms\Components\Section::make('Data Perubahan')
                    ->schema([
                        Forms\Components\Textarea::make('properties')
                            ->label('Metadata / Properti')
                            ->disabled()
                            ->rows(15)
                            ->formatStateUsing(fn ($state) => json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))
                            ->columnSpanFull(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('causer.name')
                    ->label('Pelaku')
                    ->placeholder('Sistem')
                    ->searchable(),
                Tables\Columns\TextColumn::make('event')
                    ->label('Aksi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('description')
                    ->label('Deskripsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subject_type')
                    ->label('Modul')
                    ->formatStateUsing(fn ($state) => str_replace('App\\Models\\', '', $state)),
                Tables\Columns\TextColumn::make('subject_id')
                    ->label('ID'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                //
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit($record): bool
    {
        return false;
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->isAdmin();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListActivityLogs::route('/'),
        ];
    }
}
