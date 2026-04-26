<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SwapiService
{
    public function getPeople()
    {
        $response = Http::withoutVerifying()->get('https://swapi.info/api/people');

        return $response->json();
    }

    public function getPersonById($id)
    {
        $response = Http::withoutVerifying()->get("https://swapi.info/api/people/{$id}");
        
        return $response->json();
    }
}

