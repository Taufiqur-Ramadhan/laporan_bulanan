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
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Concerns\WithPreCalculateFormulas;

class KegiatanExport implements FromCollection, WithHeadings, WithMapping, WithDrawings, WithStyles, WithColumnWidths, WithTitle, WithColumnFormatting, WithPreCalculateFormulas
{
    protected $records;
    protected $rowIndex = 2; // Start after heading

    public function __construct(Collection $records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        return $this->records;
    }

    public function title(): string
    {
        return 'Laporan Kegiatan';
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
        
        // Membersihkan nilai anggaran agar benar-benar numeric
        $anggaranRaw = $record->anggaran;
        if (is_numeric($anggaranRaw)) {
            $anggaranMurni = (float) $anggaranRaw;
        } else {
            // Jika dalam format string "Rp 500.000", bersihkan karakter non-digit
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
            'D' => '#,##0', // Format angka di baris data
        ];
    }

    public function drawings()
    {
        $drawings = [];
        $currentRow = 2;

        foreach ($this->records as $record) {
            // Foto Sebelum (Column H)
            if ($record->foto_sebelum && Storage::disk('public')->exists($record->foto_sebelum)) {
                $drawing = new Drawing();
                $drawing->setName('Foto Sebelum');
                $drawing->setPath(storage_path('app/public/' . $record->foto_sebelum));
                $drawing->setHeight(130); // Fill row height (140) minus padding
                $drawing->setWidth(180); // Fill column width (30 approx 210px) minus padding
                $drawing->setCoordinates('H' . $currentRow);
                $drawing->setOffsetX(15);
                $drawing->setOffsetY(10);
                $drawing->getShadow()->setVisible(true);
                $drawing->getShadow()->setDirection(45);
                $drawings[] = $drawing;
            }

            // Foto Sesudah (Column I)
            if ($record->foto_sesudah && Storage::disk('public')->exists($record->foto_sesudah)) {
                $drawing = new Drawing();
                $drawing->setName('Foto Sesudah');
                $drawing->setPath(storage_path('app/public/' . $record->foto_sesudah));
                $drawing->setHeight(130);
                $drawing->setWidth(180);
                $drawing->setCoordinates('I' . $currentRow);
                $drawing->setOffsetX(15);
                $drawing->setOffsetY(10);
                $drawing->getShadow()->setVisible(true);
                $drawing->getShadow()->setDirection(45);
                $drawings[] = $drawing;
            }

            $currentRow++;
        }

        return $drawings;
    }

    public function styles(Worksheet $sheet)
    {
        $rowCount = $this->records->count();
        $dataEndRow = $rowCount + 1;
        $totalRow = $rowCount + 2;

        // Header Style
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('E2E8F0');

        // General Alignment & Borders for all data
        $sheet->getStyle('A1:J' . ($totalRow))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        
        // Data Row Heights - Increased for better "Place in Cell" feel
        for ($i = 2; $i <= $dataEndRow; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(140); 
        }

        // Currency format for data rows
        $sheet->getStyle('D2:D' . $dataEndRow)->getNumberFormat()->setFormatCode('#,##0');

        // Add Footer Row for Total
        if ($rowCount > 0) {
            // Memberi warna latar belakang pada baris total
            $sheet->getStyle('A' . $totalRow . ':J' . $totalRow)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('E2E8F0');

            $sheet->setCellValue('C' . $totalRow, 'TOTAL SELURUH ANGGARAN:');
            $sheet->getStyle('C' . $totalRow)->getFont()->setBold(true);
            $sheet->getStyle('C' . $totalRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT);
            
            // RUMUS SUM
            $sheet->setCellValue('D' . $totalRow, '=SUM(D2:D' . $dataEndRow . ')');
            
            // Style untuk angka Total
            $sheet->getStyle('D' . $totalRow)->getFont()->setBold(true);
            $sheet->getStyle('D' . $totalRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $sheet->getStyle('D' . $totalRow)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            
            // Format mata uang yang benar
            $sheet->getStyle('D' . $totalRow)->getNumberFormat()->setFormatCode('"Rp " #,##0');
            
            $sheet->getRowDimension($totalRow)->setRowHeight(40);
        }

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
            'H' => 35, // Wider for images
            'I' => 35, // Wider for images
            'J' => 15,
        ];
    }
}
