<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::query()->with(['genres'])->orderByDesc('created_at')->paginate(12);

        return view('admin.movies.index', [
            'movies' => $movies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createView()
    {
        $genres = Genre::all();
        return view('admin.movies.create', [
            'genres' => $genres
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(CreateMovieRequest $request)
    {
        $validated = $request->validated();
        $movie = Movie::query()->create($validated);
        if ($request->has('genres')) {
            foreach ($request->genres as $genre) {
                $movie->genres()->attach($genre);
            }
        }

        return redirect()->route('admin.movies.index')->with('success', 'Movie has been successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        return view('admin.movies.update', [
            'movie' => $movie,
            'genres' => $genres
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $movie->update($request->validated());
        if ($request->has('genres')) {
            foreach ($request->genres as $genre) {
                $movie->genres()->attach($genre);
            }
        }
        return redirect()->route('admin.movies.index')->with('success', 'Movie has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->back()->with('success', 'Movie has been successfully deleted');
    }
}
