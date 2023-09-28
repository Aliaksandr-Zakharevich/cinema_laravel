<?php

namespace App\Services;


use App\Models\Genre;
use App\Models\Movie;
use App\Models\Session;
use Illuminate\Http\UploadedFile;

class MovieService
{
    public function getMovies(array $params)
    {
        $movies = Movie::query()->with(['sessions', 'genres'])->where('is_active', 1);

        if (isset($params['halls'])) {
            $movies->where('hall_id', '=', $params['halls']);
        }

        if (isset($params['genre'])) {
            $movies->join('genre_movie', 'genre_movie.movie_id', '=', 'movies.id')
                ->join('genres', 'genre_movie.genre_id', '=', 'genres.id')
                ->where('genres.title', '=', $params['genre']);
        }

        if (isset($params['date'])) {
            $movies->join('sessions', 'sessions.movie_id', '=', 'movies.id')
                ->where('sessions.date', '=', $params['date']);
        }

        return $movies->paginate(12);
    }
}
