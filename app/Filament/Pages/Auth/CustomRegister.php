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

    public function register(): ?\App\Http\Responses\Auth\CustomRegistrationResponse
    {
        try {
            $this->rateLimit(2);
        } catch (\Illuminate\Cache\RateLimiter $exception) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'data.email' => __('filament-panels::pages/auth/register.notifications.throttled.title', [
                    'seconds' => $exception->secondsUntilAvailable,
                    'minutes' => ceil($exception->secondsUntilAvailable / 60),
                ]),
            ]);
        }

        $user = $this->wrapInDatabaseTransaction(function () {
            $this->callHook('beforeRegister');

            $data = $this->form->getState();

            $user = $this->getUserModel()::create($data);

            $this->sendEmailVerificationNotification($user);

            \Illuminate\Support\Facades\Auth::login($user);

            $this->callHook('afterRegister');

            return $user;
        });

        session()->regenerate();

        return new \App\Http\Responses\Auth\CustomRegistrationResponse();
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
