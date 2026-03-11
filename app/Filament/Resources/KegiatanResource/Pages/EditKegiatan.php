<?php

namespace App\Filament\Resources\KegiatanResource\Pages;

use App\Filament\Resources\KegiatanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKegiatan extends EditRecord
{
    protected static string $resource = KegiatanResource::class;
    protected static string $view = 'filament.resources.kegiatan-resource.pages.edit-kegiatan';

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
            Actions\DeleteAction::make()
                ->visible(false), // Tombol kustom di blade yang memanggil via wire:click mountAction('delete')
        ];
    }

    public function save(bool $shouldRedirect = true, bool $shouldStayOnPage = false): void
    {
        try {
            parent::save(false, false); // jangan redirect dulu, kita redirect manual via JS

            // Kirim event ke Alpine/browser agar blade bisa tampilkan animasi, lalu redirect
            $this->dispatch('kegiatan-saved', redirectUrl: $this->getResource()::getUrl('index'));
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

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['status'] = 'pending';
        $data['catatan_revisi'] = null;
        
        return $data;
    }
}
