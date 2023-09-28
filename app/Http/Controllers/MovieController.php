<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function movie(Movie $movie)
    {
        $halls = Hall::where('is_active', 1)->get();
        return view('movie', [
            'movie' => $movie,
            'halls' => $halls
        ]);
    }

    public function afisha()
    {
        $movies = Movie::query()->with(['sessions', 'genres'])->where('is_active', 1)->paginate(12);
        $halls = Hall::where('is_active', 1)->get();

        return view('afisha', [
            'movies' => $movies,
            'halls' => $halls
        ]);
    }
}
