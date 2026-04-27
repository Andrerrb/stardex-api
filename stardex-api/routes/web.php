<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;

Route::get('/people', [PeopleController::class, 'index']);