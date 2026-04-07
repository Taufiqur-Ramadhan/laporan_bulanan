<?php

namespace App\Exports;

use App\Models\Kegiatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class KegiatanSingleSheetExport implements FromCollection, WithHeadings, WithMapping, WithDrawings, WithStyles, WithColumnWidths, WithTitle, WithColumnFormatting
{
    protected $record;
    protected $index;

    public function __construct(Kegiatan $record, int $index)
    {
        $this->record = $record;
        $this->index = $index;
    }

    public function collection()
    {
        return collect([$this->record]);
    }

    public function title(): string
    {
        // Title Excel dibatasi 31 karakter dan tidak boleh ada karakter unik seperti / ? * : [ ]
        $safeTitle = preg_replace('/[\\\\\/\?\*\:\[\]]/', '', $this->record->nama_kegiatan);
        $title = $this->index . '. ' . $safeTitle;
        return substr($title, 0, 31);
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Pelapor',
            'Nama Kegiatan',
            'Anggaran (Rp)',
            'Isi Kegiatan',
            'Latitude',
            'Longitude',
            'Foto Sebelum',
            'Foto Sesudah',
            'Status',
        ];
    }

    public function map($record): array
    {
        $pelapor = $record->user->role === 'admin' ? 'Admin' : $record->user->name . " Anggota";
        
        $anggaranRaw = $record->anggaran;
        if (is_numeric($anggaranRaw)) {
            $anggaranMurni = (float) $anggaranRaw;
        } else {
            $anggaranMurni = (float) preg_replace('/[^0-9]/', '', (string)$anggaranRaw);
        }
        
        $statusLabel = match ($record->status) {
            'pending' => 'Menunggu',
            'approved' => 'Disetujui',
            'revision' => 'Perlu Revisi',
            'rejected' => 'Ditolak',
            default => $record->status,
        };

        return [
            $record->created_at ? $record->created_at->format('d/m/Y') : '-',
            $pelapor,
            $record->nama_kegiatan,
            $anggaranMurni,
            $record->deskripsi,
            $record->latitude,
            $record->longitude,
            '', // Placeholder for Foto Sebelum
            '', // Placeholder for Foto Sesudah
            $statusLabel,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => '"Rp " #,##0',
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $currentRow = 2; // Data row is always 2 since it's only 1 record

        // Foto Sebelum
        if ($this->record->foto_sebelum && Storage::disk('public')->exists($this->record->foto_sebelum)) {
            $drawing = new Drawing();
            $drawing->setName('Foto Sebelum');
            $drawing->setPath(storage_path('app/public/' . $this->record->foto_sebelum));
            $drawing->setHeight(130);
            $drawing->setWidth(180);
            $drawing->setCoordinates('H' . $currentRow);
            $drawing->setOffsetX(15);
            $drawing->setOffsetY(10);
            $drawing->getShadow()->setVisible(true);
            $drawing->getShadow()->setDirection(45);
            $drawings[] = $drawing;
        }

        // Foto Sesudah
        if ($this->record->foto_sesudah && Storage::disk('public')->exists($this->record->foto_sesudah)) {
            $drawing = new Drawing();
            $drawing->setName('Foto Sesudah');
            $drawing->setPath(storage_path('app/public/' . $this->record->foto_sesudah));
            $drawing->setHeight(130);
            $drawing->setWidth(180);
            $drawing->setCoordinates('I' . $currentRow);
            $drawing->setOffsetX(15);
            $drawing->setOffsetY(10);
            $drawing->getShadow()->setVisible(true);
            $drawing->getShadow()->setDirection(45);
            $drawings[] = $drawing;
        }

        return $drawings;
    }

    public function styles(Worksheet $sheet)
    {
        // Header Style
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('E2E8F0');

        // General Alignment & Borders for all data
        $sheet->getStyle('A1:J2')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(2)->setRowHeight(140); 

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 12,
            'B' => 20,
            'C' => 30,
            'D' => 20,
            'E' => 45,
            'F' => 12,
            'G' => 12,
            'H' => 35,
            'I' => 35,
            'J' => 15,
        ];
    }
}
