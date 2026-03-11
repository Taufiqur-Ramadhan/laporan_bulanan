<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;
    protected static string $view = 'filament.resources.user-resource.pages.edit-user';

    public function getViewData(): array
    {
        return [
            'adminName'   => auth()->user()->name,
            'adminRole'   => auth()->user()->role ?? 'Admin',
            'adminAvatar' => auth()->user()->getFilamentAvatarUrl()
                ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=7c3aed&background=f0f0f5',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->visible(false), // delete dipanggil via tombol kustom di blade
        ];
    }

    public function save(bool $shouldRedirect = true, bool $shouldStayOnPage = false): void
    {
        try {
            parent::save($shouldRedirect, $shouldStayOnPage);
        } catch (\Throwable $e) {
            \Filament\Notifications\Notification::make()
                ->title('Gagal Menyimpan')
                ->body($e->getMessage())
                ->danger()
                ->send();

            throw $e;
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
