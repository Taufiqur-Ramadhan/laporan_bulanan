<?php

namespace App\Filament\Resources\KegiatanResource\Pages;

use App\Filament\Resources\KegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKegiatan extends ListRecords
{
    protected static string $resource = KegiatanResource::class;
    protected static string $view = 'filament.resources.kegiatan-resource.pages.list-kegiatan';

    public function getViewData(): array
    {
        return [
            'userName' => auth()->user()->name,
            'userRole' => auth()->user()->role ?? 'Admin',
            'userAvatar' => auth()->user()->getFilamentAvatarUrl() ?? "https://ui-avatars.com/api/?name=".urlencode(auth()->user()->name)."&color=7c3aed&background=f0f0f5",
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Lapor Kegiatan'),
        ];
    }
}
