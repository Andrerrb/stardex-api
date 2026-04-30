<?php

namespace App\Http\Controllers;

use App\Services\SwapiService;

class VehiclesController extends Controller
{
    // =========================
    // GET ALL
    // =========================

    public function index(SwapiService $swapiService)
    {
        $vehicles = $swapiService->getVehicles();

        if ($vehicles === 'api_error') {
            return response()->json([
                'success' => false,
                'error' => 'External API unavailable'
            ], 503);
        }

        $formattedVehicles = array_map(
            fn($vehicle) => $this->formatVehicle($vehicle),
            $vehicles
        );

        return response()->json([
            'success' => true,
            'data' => $formattedVehicles
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // =========================
    // GET BY ID
    // =========================

    public function show($id, SwapiService $swapiService)
    {
        $vehicle = $swapiService->getVehicleById($id);

        if ($vehicle === 'not_found') {
            return response()->json([
                'success' => false,
                'error' => 'Vehicle not found'
            ], 404);
        }

        if ($vehicle === 'api_error') {
            return response()->json([
                'success' => false,
                'error' => 'External API unavailable'
            ], 503);
        }

        $formattedVehicle = $this->formatVehicle($vehicle);

        return response()->json([
            'success' => true,
            'data' => $formattedVehicle
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // =========================
    // HELPERS
    // =========================

    private function formatVehicle(array $vehicle): array
    {
        return [
            'name' => $vehicle['name'],
            'model' => $vehicle['model'],
            'manufacturer' => $vehicle['manufacturer'],
            'cost_in_credits' => $vehicle['cost_in_credits'],
            'max_atmosphering_speed' => $vehicle['max_atmosphering_speed'],
            'pilots' => $vehicle['pilots'],
        ];
    }
}