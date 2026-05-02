<?php

namespace App\Http\Controllers;

use App\Services\SwapiService;

class SpeciesController extends Controller
{
    // =========================
    // GET ALL
    // =========================

    public function index(SwapiService $swapiService)
    {
        $species = $swapiService->getSpecies();

        if ($species === 'api_error') {
            return response()->json([
                'success' => false,
                'error' => 'External API unavailable'
            ], 503);
        }

        $formattedSpecies = array_map(
            fn($specie) => $this->formatSpecies($specie),
            $species
        );

        return response()->json([
            'success' => true,
            'data' => $formattedSpecies
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // =========================
    // GET BY ID
    // =========================

    public function show($id, SwapiService $swapiService)
    {
        $specie = $swapiService->getSpeciesById($id);

        if ($specie === 'not_found') {
            return response()->json([
                'success' => false,
                'error' => 'Species not found'
            ], 404);
        }

        if ($specie === 'api_error') {
            return response()->json([
                'success' => false,
                'error' => 'External API unavailable'
            ], 503);
        }

        $formattedSpecies = $this->formatSpecies($specie);

        return response()->json([
            'success' => true,
            'data' => $formattedSpecies
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // =========================
    // HELPERS
    // =========================

    private function formatSpecies(array $species): array
    {
        return [
            'name' => $species['name'],
            'classification' => $species['classification'],
            'designation' => $species['designation'],
            'average_height' => $species['average_height'],
            'average_lifespan' => $species['average_lifespan'],
            'homeworld' => $species['homeworld'],
        ];
    }
}