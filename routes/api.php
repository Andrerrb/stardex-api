<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PlanetsController;
use App\Http\Controllers\StarshipsController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\FilmsController;
use App\Http\Controllers\SpeciesController;

Route::get('/people', [PeopleController::class, 'index']);
Route::get('/people/{id}', [PeopleController::class, 'show']);

Route::get('/planets', [PlanetsController::class, 'index']);
Route::get('/planets/{id}', [PlanetsController::class, 'show']);

Route::get('/vehicles', [VehiclesController::class, 'index']);
Route::get('/vehicles/{id}', [VehiclesController::class,'show']);

Route::get('/starships', [StarshipsController::class, 'index']);
Route::get('/starships/{id}', [StarshipsController::class,'show']);

Route::get('/films', [FilmsController::class, 'index']);
Route::get('/films/{id}', [FilmsController::class,'show']);

Route::get('/species', [SpeciesController::class, 'index']);
Route::get('/species/{id}', [SpeciesController::class,'show']);