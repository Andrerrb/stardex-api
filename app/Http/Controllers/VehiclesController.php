<?php

namespace App\Http\Controllers;

use App\Services\SwapiService;

class VehiclesController extends Controller {
    // =========================
    // GET ALL
    // =========================


    public function index (SwapiService $swapiService){
        
        $vehicles = $swapiService->getVehicles();
    }

}