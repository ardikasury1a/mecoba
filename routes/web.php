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

    return view('welcome');
});
