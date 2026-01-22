<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboards');
});

Route::get('/login', function () {
    return redirect('/dashboards/login');
})->name('login');
