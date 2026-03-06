<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $navigationIcon  = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Pengaturan';
    protected static ?string $navigationGroup = 'System';
    protected static ?int    $navigationSort  = 99;
    protected static string  $view            = 'filament.pages.settings';

    public function getViewData(): array
    {
        return [
            'userName'   => auth()->user()->name,
            'userRole'   => auth()->user()->role,
            'userEmail'  => auth()->user()->email,
            'userAvatar' => auth()->user()->getFilamentAvatarUrl()
                           ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7c3aed&background=f0f0f5',
        ];
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view(static::$view, $this->getViewData())
            ->layout('filament-panels::components.layout.base');
    }
}
