<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class CustomWelcomeWidget extends Widget
{
    protected static string $view = 'filament.widgets.custom-welcome-widget';

    protected static bool $isLazy = false;

    // Menentukan urutan widget di dashboard (paling atas)
    protected static ?int $sort = -5;

    protected int | string | array $columnSpan = 'full';

    // Mengambil data user yang sedang login
    public function getUser()
    {
        return auth()->user();
    }
}
