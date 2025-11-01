<?php

use App\Http\Controllers\CarbonTrackerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CarbonTrackerController::class, 'dashboard'])->name('dashboard');
Route::get('/input', [CarbonTrackerController::class, 'input'])->name('input');
Route::get('/insights', [CarbonTrackerController::class, 'insights'])->name('insights');
Route::get('/achievements', [CarbonTrackerController::class, 'achievements'])->name('achievements');

Route::post('/activities/transport', [CarbonTrackerController::class, 'storeTransport'])->name('activities.transport');
Route::post('/activities/food', [CarbonTrackerController::class, 'storeFood'])->name('activities.food');
Route::post('/activities/energy', [CarbonTrackerController::class, 'storeEnergy'])->name('activities.energy');