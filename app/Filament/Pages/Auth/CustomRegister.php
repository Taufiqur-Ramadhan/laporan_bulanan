<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Register;

class CustomRegister extends Register
{
    protected static string $view = 'filament.pages.auth.custom-register';

    public function render(): \Illuminate\Contracts\View\View
    {
        return view(static::$view, $this->getViewData())
            ->layout('filament-panels::components.layout.base');
    }

    public function register(): ?\Filament\Http\Responses\Auth\Contracts\RegistrationResponse
    {
        session()->forget('url.intended');

        return parent::register();
    }

    protected function getRedirectUrl(): string
    {
        return '/dashboards/auth/login-success';
    }

    protected function getViewData(): array
    {
        return [
            'loginUrl' => filament()->getLoginUrl(),
        ];
    }
}
