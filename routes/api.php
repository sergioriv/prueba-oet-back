<?php

use App\Http\Controllers\api\DriverController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/drivers', DriverController::class)->except('destroy');
