<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/events', [EventController::class, 'index']);
Route::get('/events/{event}', [EventController::class, 'show']);

// Protected routes for creating events and uploading banners
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/events', [EventController::class, 'store']);
    Route::post('/events/{event}/banner', [EventController::class, 'uploadBanner']);
});
