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

    public function authenticate(): ?\App\Http\Responses\Auth\CustomLoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (\Illuminate\Cache\RateLimiter $exception) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'data.email' => __('filament-panels::pages/auth/login.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]),
            ]);
        }

        $data = $this->form->getState();

        if (! \Illuminate\Support\Facades\Auth::attempt($this->getCredentialsFromFormData($data), $data['remember'] ?? false)) {
            $this->throwFailureValidationException();
        }

        $user = \Illuminate\Support\Facades\Auth::user();

        if (
            ($user instanceof \Filament\Models\Contracts\FilamentUser) &&
            (! $user->canAccessPanel(filament()->getCurrentPanel()))
        ) {
            \Illuminate\Support\Facades\Auth::logout();

            $this->throwFailureValidationException();
        }

        session()->regenerate();

        return new \App\Http\Responses\Auth\CustomLoginResponse();
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
