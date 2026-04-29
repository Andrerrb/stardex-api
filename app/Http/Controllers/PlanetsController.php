<?php

namespace App\Http\Controllers;

use App\Services\SwapiService;

class PlanetsController extends Controller
{
    // =========================
    // GET ALL
    // =========================

    public function index(SwapiService $swapiService)
    {
        $planets = $swapiService->getPlanets();

        if ($planets === 'api_error') {
            return response()->json([
                'success' => false,
                'error' => 'External API unavailable'
            ], 503);
        }

        $formattedPlanets = array_map(
            fn($planet) => $this->formatPlanet($planet),
            $planets
        );

        return response()->json([
            'success' => true,
            'data' => $formattedPlanets
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // =========================
    // GET BY ID
    // =========================

    public function show($id, SwapiService $swapiService)
    {
        $planet = $swapiService->getPlanetById($id);

        if ($planet === 'not_found') {
            return response()->json([
                'success' => false,
                'error' => 'Planet not found'
            ], 404);
        }

        if ($planet === 'api_error') {
            return response()->json([
                'success' => false,
                'error' => 'External API unavailable'
            ], 503);
        }

        $formattedPlanet = $this->formatPlanet($planet);

        return response()->json([
            'success' => true,
            'data' => $formattedPlanet
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // =========================
    // HELPERS
    // =========================

    private function formatPlanet($planet)
    {
        return [
            'name' => $planet['name'],
            'climate' => $planet['climate'],
            'terrain' => $planet['terrain'],
            'population' => $planet['population'],
        ];
    }
}