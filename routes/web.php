<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PlanetsController;

Route::get('/people', [PeopleController::class, 'index']);
Route::get('/people/{id}', [PeopleController::class, 'show']);
Route::get('/planets',[PlanetsController::class, 'index']);
Route::get('/planets/{id}',[PlanetsController::class, 'show']);