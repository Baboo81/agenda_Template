<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;


/**
 * CRUD
 */
//Liste des évènements :
Route::get('/events', [EventController::class, 'index'])->name('events.index');
//Formulaire de création :
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
//Enregistrer un évènement :
Route::post('/events', [EventController::class, 'store'])->name('events.store');
//Formulaire d'édition :
Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
//Mettre à jour :
Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
//Supprimer :
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');


