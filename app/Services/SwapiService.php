<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class SwapiService
{
    public function getPeople()
    {
        try {
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->get('https://swapi.info/api/people');

            if ($response->failed()) {
                return null;
            }

            return $response->json();
        } catch (ConnectionException $e) {
            return null;
        }
    }

    public function getPersonById($id)
    {
        try {
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->get("https://swapi.info/api/people/{$id}");

            if ($response->failed()) {
                return null;
            }

            return $response->json();
        } catch (ConnectionException $e) {
            return null;
        }
    }
}