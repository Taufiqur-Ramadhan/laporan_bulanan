<?php

namespace App\Filament\Resources\KegiatanResource\Pages;

use App\Filament\Resources\KegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKegiatan extends CreateRecord
{
    protected static string $resource = KegiatanResource::class;
    protected static string $view = 'filament.resources.kegiatan-resource.pages.create-kegiatan';

    public function getViewData(): array
    {
        return [
            'userName' => auth()->user()->name,
            'userRole' => auth()->user()->role ?? 'Admin',
            'userAvatar' => auth()->user()->getFilamentAvatarUrl() ?? "https://ui-avatars.com/api/?name=".urlencode(auth()->user()->name)."&color=7c3aed&background=f0f0f5",
        ];
    }

    public function getTitle(): string
    {
        return 'Lapor Kegiatan';
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();

        return $data;
    }
}
