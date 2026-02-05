<?php

namespace App\Filament\Pages\Auth;

use Filament\Pages\Auth\Register;

class CustomRegister extends Register
{
    protected static string $view = 'filament.pages.auth.custom-register';

    // Kita bisa menambahkan data tambahan jika diperlukan ke view
    protected function getViewData(): array
    {
        return [
            'loginUrl' => filament()->getLoginUrl(),
        ];
    }
}
