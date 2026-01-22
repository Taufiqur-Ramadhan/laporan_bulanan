<?php

namespace App\Filament\Resources\ReportResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Database\Eloquent\Collection;

class KegiatansRelationManager extends RelationManager
{
    protected static string $relationship = 'kegiatans';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kegiatan')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nama_kegiatan')
            ->columns([
                Tables\Columns\TextColumn::make('nama_kegiatan'),
                Tables\Columns\TextColumn::make('anggaran')->money('IDR'),
                Tables\Columns\TextColumn::make('status')->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
            ])
            ->actions([
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make(),
                    Tables\Actions\BulkAction::make('export_word')
                        ->label('Ekspor Word')
                        ->icon('heroicon-o-document-text')
                        ->action(function (Collection $records) {
                            $phpWord = new PhpWord();
                            $section = $phpWord->addSection();

                            $phpWord->addTitleStyle(1, ['size' => 16, 'bold' => true], ['alignment' => 'center']);
                            $section->addTitle('LAPORAN HASIL KEGIATAN', 1);
                            $section->addTextBreak(1);

                            foreach ($records as $record) {
                                $section->addText("Nama Kegiatan: " . $record->nama_kegiatan, ['bold' => true]);
                                $section->addText("Anggaran: Rp " . number_format($record->anggaran, 0, ',', '.'));
                                $section->addText("Deskripsi: " . $record->deskripsi);
                                
                                if ($record->foto_sebelum) {
                                    $path = storage_path('app/public/' . $record->foto_sebelum);
                                    if (file_exists($path)) {
                                        $section->addText("Foto Sebelum:");
                                        $section->addImage($path, ['width' => 200]);
                                    }
                                }
                                
                                if ($record->foto_sesudah) {
                                    $path = storage_path('app/public/' . $record->foto_sesudah);
                                    if (file_exists($path)) {
                                        $section->addText("Foto Sesudah:");
                                        $section->addImage($path, ['width' => 200]);
                                    }
                                }

                                $section->addHorizontalLine();
                                $section->addTextBreak(1);
                            }

                            $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
                            $fileName = 'Export_Kegiatan_' . now()->format('Y-m-d') . '.docx';

                            return response()->streamDownload(function () use ($objWriter) {
                                $objWriter->save('php://output');
                            }, $fileName);
                        }),
                ]),
            ]);
    }
}
