<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerifiedByOtp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && ! $user->email_verified_at) {
            $otpRouteName = 'filament.admin.pages.auth.verify-otp';

            if ($request->routeIs($otpRouteName) || $request->routeIs('filament.admin.auth.logout')) {
                return $next($request);
            }

            return redirect()->route($otpRouteName);
        }

        return $next($request);
    }
}
