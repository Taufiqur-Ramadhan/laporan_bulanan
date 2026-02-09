<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    protected static string $view = 'filament.pages.custom-profile';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                FileUpload::make('avatar_url')
                    ->label('Foto Profil')
                    ->avatar()
                    ->imageEditor()
                    ->directory('avatars'),
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                TextInput::make('nip')
                    ->label('NIP / Nomor Pegawai'),
                TextInput::make('unit_kerja')
                    ->label('Unit Kerja'),
                TextInput::make('alamat')
                    ->label('Alamat Kantor'),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    public function getViewData(): array
    {
        return [
            'userName' => auth()->user()->name,
            'userRole' => auth()->user()->role ?? 'Admin',
            'userAvatar' => auth()->user()->getFilamentAvatarUrl() ?? "https://ui-avatars.com/api/?name=".urlencode(auth()->user()->name)."&color=7c3aed&background=f0f0f5",
        ];
    }

    public function render(): \Illuminate\Contracts\View\View
    {
        return view(static::$view, $this->getViewData())
            ->layout('filament-panels::components.layout.base');
    }
}
