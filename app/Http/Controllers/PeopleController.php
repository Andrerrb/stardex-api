<?php

namespace App\Http\Controllers;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index()
    {
        $response = Http::withoutVerifying()->get('https://swapi.info/api/people');

        return response()->json($response->json());
    }
}
