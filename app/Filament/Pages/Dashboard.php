<?php

namespace App\Filament\Pages;

use App\Models\Kegiatan;
use App\Models\User;
use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Support\Facades\DB;

class Dashboard extends BaseDashboard
{
    protected static string $view = 'filament.pages.dashboard';

    public function getViewData(): array
    {
        return [
            'totalKegiatan' => Kegiatan::count(),
            'pendingKegiatan' => Kegiatan::where('status', 'pending')->count(),
            'totalAnggaran' => Kegiatan::sum('anggaran'),
            'totalUser' => User::count(),
            'recentKegiatans' => Kegiatan::with('user')->latest()->take(5)->get(),
            'globalActivityStats' => Kegiatan::join('users', 'kegiatans.user_id', '=', 'users.id')
                ->select('users.unit_kerja', DB::raw('count(*) as total'))
                ->groupBy('users.unit_kerja')
                ->get(),
            'inputHariIni' => Kegiatan::whereDate('created_at', now())->count(),
            'userName' => auth()->user()->name,
            'userRole' => auth()->user()->role,
            'userAvatar' => auth()->user()->getFilamentAvatarUrl() ?? "https://ui-avatars.com/api/?name=".urlencode(auth()->user()->name)."&color=7c3aed&background=f0f0f5",
        ];
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view(static::$view, $this->getViewData())
            ->layout('filament-panels::components.layout.base');
    }
}
