<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login;

class CustomLogin extends Login
{
    protected static string $view = 'filament.pages.auth.custom-login';

    public function render(): \Illuminate\Contracts\View\View
    {
        return view(static::$view, $this->getViewData())
            ->layout('filament-panels::components.layout.base');
    }

    public function authenticate(): ?\Filament\Http\Responses\Auth\Contracts\LoginResponse
    {
        session()->forget('url.intended');

        return parent::authenticate();
    }

    protected function getRedirectUrl(): string
    {
        return '/dashboards/auth/login-success';
    }

    protected function getViewData(): array
    {
        return [
            'registerUrl' => filament()->getRegistrationUrl(),
        ];
    }
}
