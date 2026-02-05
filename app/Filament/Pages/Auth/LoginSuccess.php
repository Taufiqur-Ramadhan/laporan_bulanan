<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class LoginSuccess extends Page
{
    protected static string $view = 'filament.pages.auth.login-success';

    protected static ?string $slug = 'auth/login-success';

    protected static string $layout = 'filament-panels::components.layout.base';

    protected static bool $shouldRegisterNavigation = false;

    public function mount(): void
    {
        if (! Auth::check()) {
            redirect('/dashboards/login');
        }
    }

    public function getViewData(): array
    {
        return [
            'dashboardUrl' => '/dashboards',
            'userName' => Auth::user()->name,
            'userAvatar' => Auth::user()->avatar_url ? \Illuminate\Support\Facades\Storage::url(Auth::user()->avatar_url) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&color=FFFFFF&background=3211d4',
        ];
    }
}
