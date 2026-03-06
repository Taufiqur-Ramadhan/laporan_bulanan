<?php

use App\Http\Controllers\ExportController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\UserManagementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboards');
});

Route::get('/login', function () {
    return redirect('/login/dashboards');
})->name('login');

// URL login yang ditampilkan ke user: /login/dashboards
Route::get('/login/dashboards', function () {
    return redirect('/dashboards/login');
})->name('login.dashboards');

Route::get('/auth/google/redirect', [SocialiteController::class, 'redirect'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'callback'])->name('auth.google.callback');

Route::get('/terms', function () {
    return view('legal.terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('legal.privacy');
})->name('privacy');

// Route custom untuk form HTML di Manajemen User (bypass Filament Livewire)
Route::middleware(['auth'])->group(function () {
    Route::post('/dashboards/users/store', [UserManagementController::class, 'store'])->name('users.store');
    Route::delete('/dashboards/users/{id}/destroy', [UserManagementController::class, 'destroy'])->name('users.destroy');

    // Route export laporan (bypass Filament Livewire agar bisa download file langsung)
    Route::get('/dashboards/reports/export-excel', [ExportController::class, 'excel'])->name('reports.export.excel');
    Route::get('/dashboards/reports/export-word', [ExportController::class, 'word'])->name('reports.export.word');
});
