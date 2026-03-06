<?php

namespace App\Filament\Resources\ReportResource\Pages;

use App\Filament\Resources\ReportResource;
use App\Models\Kegiatan;
use App\Models\User;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Request;

class ListReports extends ListRecords
{
    protected static string $resource = ReportResource::class;
    protected static string $view = 'filament.pages.export';

    public function getViewData(): array
    {
        // Ambil list unit_kerja unik dari tabel users
        $unitKerjaList = User::whereNotNull('unit_kerja')
            ->distinct()
            ->orderBy('unit_kerja')
            ->pluck('unit_kerja');

        // Statistik ringkas
        $totalKegiatan  = Kegiatan::count();
        $totalApproved  = Kegiatan::where('status', 'approved')->count();
        $totalPending   = Kegiatan::where('status', 'pending')->count();

        return [
            'unitKerjaList' => $unitKerjaList,
            'totalKegiatan' => $totalKegiatan,
            'totalApproved' => $totalApproved,
            'totalPending'  => $totalPending,
            'userName'      => auth()->user()->name,
            'userRole'      => auth()->user()->role,
            'userAvatar'    => auth()->user()->getFilamentAvatarUrl()
                               ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7c3aed&background=f0f0f5',
        ];
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view(static::$view, $this->getViewData())
            ->layout('filament-panels::components.layout.base');
    }
}
