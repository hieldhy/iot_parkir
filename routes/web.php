<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ParkingController;

Route::get('/', [ParkingController::class, 'index']);
Route::post('/update-slot', [ParkingController::class, 'update']);
