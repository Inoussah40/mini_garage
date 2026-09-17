<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\ReparationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// =========================================================
// VÉHICULES — interface Blade
// =========================================================

Route::get('/vehicules', [VehiculeController::class, 'bladeIndex'])
    ->name('vehicules.index');


// =========================================================
// RÉPARATIONS — interface Blade
// =========================================================

// Liste des réparations
Route::get('/reparations', [ReparationController::class, 'bladeIndex'])
    ->name('reparations.blade.index');

// Formulaire de création
Route::get('/reparations/create', [ReparationController::class, 'createBlade'])
    ->name('reparations.blade.create');

// Enregistrement d'une réparation
Route::post('/reparations', [ReparationController::class, 'storeBlade'])
    ->name('reparations.blade.store');

Route::get('/reparations/{reparation}', [ReparationController::class, 'bladeShow'])
    ->name('reparations.blade.show');