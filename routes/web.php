<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/planets-view', function () {
    return view('planets');
});

Route::get('/planets-view/{id}', function ($id) {
    return view('planet-details', ['id' => $id]);
});