<?php

namespace App\Http\Controllers;

use App\Notifications\SendOTPNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirectUrl(config('services.google.redirect'))->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->redirectUrl(config('services.google.redirect'))->user();
        } catch (\Exception $e) {
            return redirect('/dashboards/login')->with('error', 'Gagal login menggunakan Google.');
        }

        $user = User::where('google_id', $googleUser->id)
            ->orWhere('email', $googleUser->email)
            ->first();

        if ($user) {
            $user->update([
                'google_id' => $googleUser->id,
            ]);
            
            // Resend OTP if not verified
            if (!$user->email_verified_at) {
                $otp = rand(100000, 999999);
                $user->update([
                    'otp_code' => $otp,
                    'otp_expires_at' => now()->addMinutes(10),
                ]);
                $user->notify(new SendOTPNotification($otp));
            }
        } else {
            $otp = rand(100000, 999999);
            
            $user = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => bcrypt(Str::random(16)),
                'role' => User::ROLE_ANGGOTA,
                'email_verified_at' => null,
                'otp_code' => $otp,
                'otp_expires_at' => now()->addMinutes(10),
            ]);

            $user->notify(new SendOTPNotification($otp));
        }

        Auth::login($user);

        if (!$user->email_verified_at) {
            return redirect()->route('filament.admin.pages.auth.verify-otp');
        }

        return redirect()->to('/dashboards/auth/login-success');
    }
}
