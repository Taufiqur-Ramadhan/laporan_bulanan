<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Login;

class CustomLogin extends Login
{
    protected function getRedirectUrl(): string
    {
        return '/dashboards/auth/login-success';
    }
}
