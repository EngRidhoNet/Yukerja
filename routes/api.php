<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Mitra\ServiceAreaController;

Route::middleware(['auth:sanctum', 'role:mitra'])->prefix('mitra')->group(function () {
    Route::post('/update-location', [\App\Http\Controllers\ServiceAreaController::class, 'updateLocation']);
    Route::post('/update-service-areas', [\App\Http\Controllers\ServiceAreaController::class, 'updateServiceAreas']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
