<?php

namespace App\Http\Controllers;

use App\Services\SwapiService;
use Illuminate\Http\Request;


class PlanetsController extends Controller
{
    public function index(SwapiService $swapiService){
        $planets = $swapiService->getPlanets();

        if ($planets === 'api_error'){
            return response()->json([
                'success' => false,
                'error' => 'External API unavailable'
            ], 503);
        }

        
    }
}
