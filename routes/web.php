<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return [
        'error' => false,
        'message' => 'Pong!',
        'time' => now()->toDateTimeString(),
    ];
});
