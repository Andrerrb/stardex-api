<?php

namespace App\Http\Controllers;

use App\Services\SwapiService;

class PeopleController extends Controller
{
    public function index(SwapiService $swapiService)
    {
        $people = $swapiService->getPeople();

        $formattedPeople = [];

        foreach($people as $person){
            $formattedPeople[] = $this->formatPerson($person);
        }
        
        return response()->json([
            'success' => true,
            'data' => $formattedPeople
        ]);
    }

    public function show($id, SwapiService $swapiService)
    {
        $person = $swapiService->getPersonById($id);

        if($person === 'not_found'){
            return response()->json([
                'error' => 'Person not found'
            ],404);
        }
        
        if($person === 'api_error'){
            return response()->json([
                'error' => 'External API unavailable'
            ], 503);

        }



        $formattedPerson = $this->formatPerson($person);

        return response()->json([
            'success' => true,
            'data' => $formattedPerson
    ]);

    }

    private function formatPerson($person)
    {
        return[
            'name' => $person['name'],
            'height' => $person['height'],
            'mass' => $person['mass'],
            'birth_year' =>$person['birth_year'],
            'gender' => $person['gender'],
        ];
    }

}
