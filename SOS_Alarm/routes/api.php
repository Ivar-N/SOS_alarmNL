<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\DeviceController;
use App\Http\Controllers\API\V1\GebruikerController;


// Authentication routes
Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
});

// Device Management routes
Route::middleware('auth:sanctum')->prefix('v1/devices')->group(function () {
    Route::get('/', [DeviceController::class, 'index']); // List devices
    Route::get('/{device}', [DeviceController::class, 'show']); // Get device details
    Route::post('/', [DeviceController::class, 'store']); // Add a new device
    Route::put('/{device}', [DeviceController::class, 'update']); // Update a device
    Route::delete('/{device}', [DeviceController::class, 'destroy']); // Delete a device
});

Route::middleware('auth:sanctum')->prefix('v1/profile')->group(function () {
    Route::get('/', [GebruikerController::class, 'show']); // View Profile
    Route::put('/', [GebruikerController::class, 'update']); // Update Profile
});