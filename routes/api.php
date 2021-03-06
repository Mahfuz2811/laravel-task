<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PocketController;
use App\Http\Controllers\Api\V1\ContentController;

Route::group(['prefix' => 'v1'], function ($router) {

    $router->apiResource('pockets', PocketController::class)->only(['store']);
    $router->apiResource('pockets.contents', ContentController::class)->shallow()->only(['store', 'index', 'destroy']);

});
