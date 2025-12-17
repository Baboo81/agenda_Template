<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;

// Route vers le calendrier :
Route::get('/', [EventController::class, 'index'])->name('events.index');

//Routes qui gèrent la prise de RDV :
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointments/unavailable', [AppointmentController::class, 'unavailableHours'])->name('appointments.unavailable');



