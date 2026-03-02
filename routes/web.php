<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-email', function () {
    Mail::raw('Ovo je test email!', function ($message) {
        $message->to('karla.fisic@gmail.com')
                ->subject('Test Email');
    });
    
    return 'Email poslan! Provjeri inbox.';
});
