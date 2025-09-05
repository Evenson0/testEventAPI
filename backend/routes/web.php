<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventWebController;
use App\Http\Controllers\EventController;

Route::get('/', [EventWebController::class, 'index'])->name('events.index');

Route::middleware('auth')->group(function () {
    Route::get('/events/create', [EventWebController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
});
