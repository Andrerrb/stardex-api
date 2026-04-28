<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\ConnectionException;

class SwapiService
{

    public function getPlanets()
    {
        try {
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->get('https://swapi.info/api/planets');

            if ($response->failed()) {
                return 'api_error';
            }

            return $response->json();
        } catch (ConnectionException $e){
            return 'api_error';
        }
    }

    public function getPlanetById($id)
    {
        try {
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->get("https://swapi.info/api/planets/{$id}");

            if ($response->status() === 404) {
                return 'not_found';
            }

            if ($response->failed()){
                return 'api_error';
            }

            return $response->json();

        } catch (ConnectionException $e) {
            return 'api_error';
        }
    }

    public function getPeople()
    {
        try {
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->get('https://swapi.info/api/people');

            if ($response->failed()) {
                return 'api_error';
            }

            return $response->json();
        } catch (ConnectionException $e) {
            return 'api_error';
        }
    }

    public function getPersonById($id)
    {
        try {
            $response = Http::withoutVerifying()
                ->timeout(10)
                ->get("https://swapi.info/api/people/{$id}");

            if ($response->status() === 404) {
                return 'not_found';
            }

            if ($response->failed()){
                return 'api_error';
            }

            return $response->json();

        } catch (ConnectionException $e) {
            return 'api_error';
        }
    }
}