<?php

namespace App\Filament\Pages\Auth;

use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class VerifyOtp extends Page
{
    protected static string $view = 'filament.pages.auth.verify-otp';

    protected static ?string $slug = 'auth/verify-otp';

    protected static string $layout = 'filament-panels::components.layout.simple';

    protected static bool $shouldRegisterNavigation = false;

    public ?array $data = [];

    public function mount(): void
    {
        if (Auth::user()->email_verified_at) {
            redirect()->intended('/dashboards');
        }

        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('otp')
                    ->label('Kode OTP')
                    ->required()
                    ->numeric()
                    ->length(6),
            ])
            ->statePath('data');
    }

    public function verify(): void
    {
        $data = $this->form->getState();
        $user = Auth::user();

        if ($user->otp_code === $data['otp'] && now()->lt($user->otp_expires_at)) {
            $user->update([
                'email_verified_at' => now(),
                'otp_code' => null,
                'otp_expires_at' => null,
            ]);

            Notification::make()
                ->title('Akun berhasil diverifikasi!')
                ->success()
                ->send();

            redirect()->intended('/dashboards');
        } else {
            Notification::make()
                ->title('Kode OTP salah atau sudah kedaluwarsa.')
                ->danger()
                ->send();
        }
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('verify')
                ->label('Verifikasi')
                ->submit('verify'),
        ];
    }

    public function getHeading(): string
    {
        return 'Verifikasi Akun';
    }

    public function getSubheading(): string
    {
        return 'Masukkan 6 digit kode yang kami kirim ke email ' . Auth::user()->email;
    }
}
