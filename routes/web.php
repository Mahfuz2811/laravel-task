<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PocketController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pockets', PocketController::class)->only(['index', 'show']);
