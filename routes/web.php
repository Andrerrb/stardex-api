<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

Route::get('/people', function () {
    $response = Http::withoutVerifying()->get('https://swapi.info/api/people');

    return $response->json();
});