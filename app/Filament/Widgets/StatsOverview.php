<?php

namespace App\Filament\Widgets;

use App\Models\Kegiatan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $query = Kegiatan::query();

        $totalKegiatan = (clone $query)->count();
        $totalAnggaran = (clone $query)->sum('anggaran');
        
        // Pagu Anggaran (Contoh: 1 Miliar, silakan disesuaikan)
        $paguAnggaran = 1000000000; 
        $sisaAnggaran = $paguAnggaran - $totalAnggaran;

        return [
            Stat::make('Total Kegiatan', $totalKegiatan)
                ->description('Jumlah seluruh kegiatan terinput')
                ->descriptionIcon('heroicon-m-clipboard-document-list')
                ->color('primary'),

            Stat::make('Menunggu Verifikasi', (clone $query)->where('status', 'pending')->count())
                ->description('Laporan butuh persetujuan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Kegiatan Disetujui', (clone$query)->where('status', 'approved')->count())
                ->description('Laporan telah diverifikasi')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Laporan Ditolak', (clone$query)->where('status', 'rejected')->count())
                ->description('Laporan tidak disetujui')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            Stat::make('Total Anggaran', 'Rp ' . number_format($totalAnggaran, 0, ',', '.'))
                ->description('Akumulasi anggaran kegiatan')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('info'),

            Stat::make('Sisa Anggaran', 'Rp ' . number_format($sisaAnggaran, 0, ',', '.'))
                ->description('Sisa anggaran tersedia')
                ->descriptionIcon('heroicon-m-wallet')
                ->color($sisaAnggaran > 0 ? 'success' : 'danger'),
        ];
    }
}
