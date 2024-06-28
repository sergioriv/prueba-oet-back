<?php

use App\Http\Controllers\api\DriverController;
use App\Http\Controllers\api\OwnerController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/drivers', DriverController::class)->except('destroy');

Route::apiResource('/owners', OwnerController::class)->except('destroy');
