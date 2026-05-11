<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Handle language switching
    if (request()->has('lang')) {
        $locale = request('lang');
        if (in_array($locale, ['id', 'en'])) {
            session(['locale' => $locale]);
            app()->setLocale($locale);
        }
        return redirect('/');
    }

    // If already authenticated, redirect to dashboard
    if (session('authenticated')) {
        return redirect('/dashboard');
    }

    return view('welcome');
});

Route::get('/dashboard', function () {
    if (!session('authenticated')) {
        return redirect('/');
    }
    return view('dashboard');
});

Route::get('/logout', function () {
    session()->forget(['authenticated', 'auth_user_id', 'auth_user_name']);
    return redirect('/');
});
