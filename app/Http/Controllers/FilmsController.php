<?php   

namespace App\Http\Controllers;

use App\Services\SwapiService;
use Illuminate\Http\Request;


class FilmsController extends Controller {
    // =========================
    // GET ALL
    // =========================

    public function index(SwapiService $swapiService)
    {
        $films = $swapiService->getFilms();

        if ($films === 'api_error') {
            return response()->json([
                'success' => false,
                'error' => 'External API unavailable'
            ], 503);
        }

        $formattedFilms = array_map(
            fn($film) => $this->formatFilm($film),
            $films
        );
        return response()->json([
            'success' => true,
            'data' => $formattedFilms
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // =========================
    // GET BY ID
    // =========================

    public function show($id, SwapiService $swapiService)
    {
        $film = $swapiService->getFilmsById($id);

        if ($film === 'not_found') {
            return response()->json([
                'success' => false,
                'error' => 'Film not found'
            ], 404);
        }

        if ($film === 'api_error') {
            return response()->json([
                'success' => false,
                'error' => 'External API unavailable'
            ], 503);
        }

        $formattedFilms = $this->formatFilm($film);

        return response()->json([
            'success' => true,
            'data' => $formattedFilms
        ], 200, [], JSON_PRETTY_PRINT);
    }

    // =========================
    // HELPERS
    // =========================

    private function formatFilm(array $film): array
    {
         return [
          'title' => $film['title'],
          'episode_id' => $film['episode_id'],
          'director' => $film['director'],
          'producer' => $film['producer'],
          'release_date' => $film['release_date'],
    ];
}
}

