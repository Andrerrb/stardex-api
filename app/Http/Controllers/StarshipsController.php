<?php

namespace App\Http\Controllers;

use App\Services\SwapiService;
use Illuminate\Http\Request;


class StarshipsController extends Controller {
    // =========================
    // GET ALL
    // =========================

    public function index(SwapiService $swapiService)
    {
        $starships = $swapiService->getStarships();

        if ($starships === 'api_error') {
            return response()->json([
                'success' => false,
                'error' => 'External API unavailable'
            ], 503);
        }

        $formattedStarships = array_map(
            fn($starship) => $this->formatStarship($starship),
            $starships
        );

        return response()->json([
            'success' => true,
            'data' => $formattedStarships
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // =========================
    // GET BY ID
    // =========================

    public function show($id, SwapiService $swapiService)
    {
        $starship = $swapiService->getStarshipById($id);

        if ($starship === 'not_found') {
            return response()->json([
                'success' => false,
                'error' => 'Starship not found'
            ], 404);
        }

        if ($starship === 'api_error') {
            return response()->json([
                'success' => false,
                'error' => 'External API unavailable'
            ], 503);
        }

        $formattedStarship = $this->formatStarship($starship);

        return response()->json([
            'success' => true,
            'data' => $formattedStarship
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // =========================
    // HELPERS
    // =========================

    private function formatStarship(array $starships): array
    {
        return [
            'name' => $starships['name'],
            'model' => $starships['model'],
            'manufacturer' => $starships['manufacturer'],
            'cost_in_credits' => $starships['cost_in_credits'],
            'max_atmosphering_speed' => $starships['max_atmosphering_speed'],
            'pilots' => $starships['pilots'],
        ];
    }
}

