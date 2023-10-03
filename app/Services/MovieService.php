<?php

namespace App\Services;


use App\Models\Genre;
use App\Models\Movie;
use App\Models\Session;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;

class MovieService
{
    public function getMovies(array $params)
    {
        $movies = Movie::query();

        if (isset($params['hall'])) {
            $movies->join('sessions', 'sessions.movie_id', '=', 'movies.id')
                ->where('sessions.hall_id', '=', $params['hall']);
        }

        if (isset($params['genre'])) {
            $movies->join('genre_movie', 'genre_movie.movie_id', '=', 'movies.id')
                ->join('genres', 'genre_movie.genre_id', '=', 'genres.id')
                ->where('genres.id', '=', $params['genre']);
        }

        if (isset($params['day'])) {
            $now = (new Carbon())->now()->toImmutable();
            $selectDay = $now->addDays($params['day'])->format('Y-m-d');
            $nextDay = $now->addDays($params['day'] + 1)->format('Y-m-d');
            if(!isset($params['hall'])){
                $movies->join('sessions', 'sessions.movie_id', '=', 'movies.id');
            }
                $movies->whereBetween('start_date', [$selectDay, $nextDay]);
        }

        return $movies->where('is_active', 1)->paginate(12);
    }

    public function createRangeDate(int $countDays): array
    {
        $dateArray = [];
        for ($i = 0; $i <= $countDays; $i++) {
            $now = (new Carbon())->now();
            $dateArray[] = $now->addDays($i)->format('d-m-Y');
        }

        return $dateArray;
    }
}
