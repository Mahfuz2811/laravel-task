<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PocketController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('pockets', [PocketController::class, 'index']);
