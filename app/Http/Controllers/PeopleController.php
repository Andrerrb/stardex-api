<?php

namespace App\Http\Controllers;

use App\Services\SwapiService;

class PeopleController extends Controller
{
    public function index(SwapiService $swapiService)
    {
        $people = $swapiService->getPeople();

        return response()->json($people);
    }

    public function show($id, SwapiService $swapiService)
    {
        $person = $swapiService->getPersonById($id);

        return response()->json($person);
    }
}
