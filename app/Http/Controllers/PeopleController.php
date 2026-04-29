<?php

namespace App\Http\Controllers;

use App\Services\SwapiService;

class PeopleController extends Controller
{
    // =========================
    // GET ALL
    // =========================

    public function index(SwapiService $swapiService)
    {
        $people = $swapiService->getPeople();

        if ($people === 'api_error') {
            return response()->json([
                'success' => false,
                'error' => 'External API unavailable'
            ], 503);
        }

        $formattedPeople = array_map(
            fn($person) => $this->formatPerson($person),
            $people
        );

        return response()->json([
            'success' => true,
            'data' => $formattedPeople
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // =========================
    // GET BY ID
    // =========================

    public function show($id, SwapiService $swapiService)
    {
        $person = $swapiService->getPersonById($id);

        if ($person === 'not_found') {
            return response()->json([
                'success' => false,
                'error' => 'Person not found'
            ], 404);
        }

        if ($person === 'api_error') {
            return response()->json([
                'success' => false,
                'error' => 'External API unavailable'
            ], 503);
        }

        $formattedPerson = $this->formatPerson($person);

        return response()->json([
            'success' => true,
            'data' => $formattedPerson
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // =========================
    // HELPERS
    // =========================

    private function formatPerson($person)
    {
        return [
            'name' => $person['name'],
            'height' => $person['height'],
            'mass' => $person['mass'],
            'birth_year' => $person['birth_year'],
            'gender' => $person['gender'],
        ];
    }
}