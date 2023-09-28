<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSeanceRequest;
use App\Http\Requests\UpdateSeanceRequest;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Seat;
use App\Models\Session;
use App\Services\SeanceService;
use Illuminate\Http\Request;

class SeanceController extends Controller
{
    private $seanceService;

    public function __construct(SeanceService $seanceService)
    {
        $this->seanceService = $seanceService;
    }

    public function index()
    {
        $seances = Session::query()->with(['hall', 'movie'])->orderByDesc('movie_id')->get();

        return view('admin.seances.index', [
            'seances' => $seances
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createView()
    {
        $halls = Hall::query()->where('is_active', 1)->get();
        $movies = Movie::query()->where('is_active', 1)->get();
        return view('admin.seances.create', [
            'halls' => $halls,
            'movies' => $movies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(CreateSeanceRequest $request)
    {
        $validated = $request->validated();
        if ($this->seanceService->isValidTimeSeance($validated)) {
            $seance = Session::query()->create($validated);
            $hall = Hall::find($seance->hall_id);
            for ($row = 1; $row <= $hall->rows_count; $row++) {
                for ($seatNumber = 1; $seatNumber <= $hall->seats_in_row; $seatNumber++) {
                    Seat::query()->create([
                        'row' => $row,
                        'number' => $seatNumber,
                        'hall_id' => $hall->id,
                        'session_id' => $seance->id
                    ]);
                }
            }
            return redirect()->route('admin.halls.update.seats.view', ['hall' => $hall->id])->with('success', 'Seance has been successfully created');
        }
        return redirect()->route('admin.seances.index')->with('error', 'Seance has not been created');
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
    public function edit(Session $seance)
    {
        $halls = Hall::query()->where('is_active', 1)->get();
        $movies = Movie::query()->where('is_active', 1)->get();
        return view('admin.seances.update', [
            'seance' => $seance,
            'halls' => $halls,
            'movies' => $movies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSeanceRequest $request, Session $seance)
    {

        $validated = $request->validated();
        if ($this->seanceService->isValidTimeSeance($validated)) {
            $seance->update($request->validated());
            return redirect()->route('admin.seances.index')->with('success', 'Seance has been successfully updated');
        }
        return redirect()->route('admin.seances.index')->with('error', 'Seance has not been created');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Session $seance)
    {
        $seance->delete();

        return redirect()->back()->with('success', 'Seance has been successfully deleted');
    }
}
