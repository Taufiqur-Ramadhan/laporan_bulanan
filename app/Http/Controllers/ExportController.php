<?php

namespace App\Http\Controllers;

use App\Exports\KegiatanExport;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\PhpWord;

class ExportController extends Controller
{
    /**
     * Bangun query Kegiatan berdasarkan filter dari request.
     */
    private function buildQuery(Request $request)
    {
        $query = Kegiatan::with('user')->oldest();

        // Filter tanggal spesifik
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        } else {
            // Filter bulan/tahun HANYA jika tanggal tidak diisi
            if ($request->filled('bulan') && $request->filled('tahun')) {
                $query->whereMonth('created_at', $request->bulan)
                      ->whereYear('created_at', $request->tahun);
            } elseif ($request->filled('tahun')) {
                $query->whereYear('created_at', $request->tahun);
            }
        }

        // Filter unit kerja (via user relationship)
        if ($request->filled('unit_kerja')) {
            $query->whereHas('user', fn ($q) => $q->where('unit_kerja', $request->unit_kerja));
        }

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return $query;
    }

    /**
     * Download laporan dalam format Excel (.xlsx)
     */
    public function excel(Request $request)
    {
        $records = $this->buildQuery($request)->get();

        $filename = 'Laporan_Kegiatan_' . now()->format('Y-m-d') . '.xlsx';

        if ($request->excel_type === 'separated') {
            return Excel::download(new \App\Exports\KegiatanMultipleSheetExport($records), $filename);
        }

        return Excel::download(new KegiatanExport($records), $filename);
    }

    /**
     * Download laporan dalam format Word (.docx)
     */
    public function word(Request $request)
    {
        $records = $this->buildQuery($request)->get();

        $phpWord = new PhpWord();
        $section = $phpWord->addSection();

        if ($request->word_type === 'summary') {
            $phpWord->addTitleStyle(1, ['size' => 16, 'bold' => true], ['alignment' => 'center']);
            $section->addTitle('REKAPITULASI HASIL KEGIATAN', 1);
            $section->addTextBreak(1);

            $phpWord->addTableStyle('SummaryTable', ['borderSize' => 6, 'borderColor' => '000000', 'cellMargin' => 50, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER]);
            $table = $section->addTable('SummaryTable');

            // Header Row
            $table->addRow();
            $table->addCell(500, ['bgColor' => 'f2f2f2'])->addText('No', ['bold' => true]);
            $table->addCell(1500, ['bgColor' => 'f2f2f2'])->addText('Tanggal', ['bold' => true]);
            $table->addCell(2000, ['bgColor' => 'f2f2f2'])->addText('Pelapor', ['bold' => true]);
            $table->addCell(2500, ['bgColor' => 'f2f2f2'])->addText('Nama Kegiatan', ['bold' => true]);
            $table->addCell(1500, ['bgColor' => 'f2f2f2'])->addText('Status', ['bold' => true]);
            $table->addCell(1500, ['bgColor' => 'f2f2f2'])->addText('Anggaran', ['bold' => true]);

            foreach ($records as $index => $record) {
                $pelapor = $record->user->role === 'admin'
                    ? 'Admin'
                    : $record->user->name;

                $statusLabel = match ($record->status) {
                    'pending'  => 'Menunggu',
                    'approved' => 'Disetujui',
                    'revision' => 'Perlu Revisi',
                    'rejected' => 'Ditolak',
                    default    => $record->status,
                };

                $table->addRow();
                $table->addCell(500)->addText($index + 1);
                $table->addCell(1500)->addText($record->created_at ? $record->created_at->format('d/m/Y') : '-');
                $table->addCell(2000)->addText($pelapor);
                $table->addCell(2500)->addText($record->nama_kegiatan);
                $table->addCell(1500)->addText($statusLabel);
                $table->addCell(1500)->addText('Rp ' . number_format($record->anggaran, 0, ',', '.'));
            }

        } else {
            $phpWord->addTitleStyle(1, ['size' => 16, 'bold' => true], ['alignment' => 'center']);
            $section->addTitle('LAPORAN HASIL KEGIATAN', 1);
            $section->addTextBreak(1);

            foreach ($records as $index => $record) {
                $pelapor = $record->user->role === 'admin'
                    ? 'Admin'
                    : $record->user->name . ' Anggota';

                $section->addText('Tanggal: ' . ($record->created_at ? $record->created_at->format('d/m/Y') : '-'), ['size' => 11]);
                $section->addText('Pelapor: ' . $pelapor, ['size' => 11]);
                $section->addText('Nama Kegiatan: ' . $record->nama_kegiatan, ['bold' => true, 'size' => 12]);
                $section->addText('Anggaran: Rp ' . number_format($record->anggaran, 0, ',', '.'), ['size' => 11]);

                $statusLabel = match ($record->status) {
                    'pending'  => 'Menunggu',
                    'approved' => 'Disetujui',
                    'revision' => 'Perlu Revisi',
                    'rejected' => 'Ditolak',
                    default    => $record->status,
                };

                $section->addText('Status: ' . $statusLabel, ['size' => 11]);
                $section->addText('Lokasi: ' . $record->latitude . ', ' . $record->longitude, ['size' => 11]);
                $section->addText('Deskripsi: ', ['bold' => true, 'size' => 11]);
                $section->addText($record->deskripsi, ['size' => 11]);
                $section->addTextBreak(1);

                // Tabel foto
                $table = $section->addTable(['borderSize' => 6, 'borderColor' => '999999', 'cellMargin' => 80]);
                $table->addRow();
                $table->addCell(4500)->addText('Foto Sebelum', ['bold' => true], ['alignment' => 'center']);
                $table->addCell(4500)->addText('Foto Sesudah', ['bold' => true], ['alignment' => 'center']);

                $table->addRow(3000);
                $cellBefore = $table->addCell(4500);
                $cellAfter  = $table->addCell(4500);

                if ($record->foto_sebelum && Storage::disk('public')->exists($record->foto_sebelum)) {
                    $cellBefore->addImage(
                        storage_path('app/public/' . $record->foto_sebelum),
                        ['width' => 180, 'height' => 130, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
                    );
                } else {
                    $cellBefore->addText('Tidak ada foto', [], ['alignment' => 'center']);
                }

                if ($record->foto_sesudah && Storage::disk('public')->exists($record->foto_sesudah)) {
                    $cellAfter->addImage(
                        storage_path('app/public/' . $record->foto_sesudah),
                        ['width' => 180, 'height' => 130, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER]
                    );
                } else {
                    $cellAfter->addText('Tidak ada foto', [], ['alignment' => 'center']);
                }

                if ($index < count($records) - 1) {
                    $section->addPageBreak();
                }
            }
        }

        $filename = 'Laporan_Kegiatan_' . now()->format('Y-m-d') . '.docx';
        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');

        return response()->streamDownload(function () use ($objWriter) {
            $objWriter->save('php://output');
        }, $filename, ['Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);
    }
}
