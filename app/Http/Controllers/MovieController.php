<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Hall;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function movie(Movie $movie)
    {
        $needHalls = [];
        foreach ($movie->sessions as $session){
            $needHalls[] = $session->hall_id;
        }
        $halls = Hall::query()->get()->only($needHalls);
        return view('movie', [
            'movie' => $movie,
            'halls' => $halls
        ]);
    }

    public function afisha(Request $request, MovieService $service)
    {
        $movies = $service->getMovies($request->all());
        $halls = Hall::where('is_active', 1)->get();
        $genres = Genre::all();
        $days = $service->createRangeDate(7);

        return view('afisha', [
            'movies' => $movies,
            'halls' => $halls,
            'genres' => $genres,
            'days' => $days
        ]);
    }
}
