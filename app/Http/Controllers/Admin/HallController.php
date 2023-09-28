<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateHallRequest;
use App\Http\Requests\UpdateHallRequest;
use App\Models\Hall;
use App\Models\Seat;
use App\Models\SeatType;
use Illuminate\Http\Request;

class HallController extends Controller
{
    public function index()
    {
        $halls = Hall::query()->orderByDesc('created_at')->paginate(12);
        return view('admin.halls.index', [
            'halls' => $halls
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createView()
    {
        return view('admin.halls.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(CreateHallRequest $request)
    {
        $validated = $request->validated();
        $hall = Hall::query()->create($validated);
        return redirect()->route('admin.halls.index')->with('success', 'Hall has been successfully created');

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
    public function edit(Hall $hall)
    {
        return view('admin.halls.update', [
            'hall' => $hall
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHallRequest $request, Hall $hall)
    {
        $hall->update($request->validated());
        return redirect()->route('admin.halls.index', ['hall' => $hall->id])->with('success', 'Hall has been successfully updated');
    }

    public function editSeats(Hall $hall)
    {
        $seats = Seat::query()->where('hall_id', $hall->id)->get();
        $seatTypes = SeatType::all();
        $cart = session()->get('selected');
        return view('admin.halls.seatsUpdate', [
            'hall' => $hall,
            'seats' => $seats,
            'seatTypes' => $seatTypes,
            'selectedSeat' => $cart ? Seat::find($cart) : null,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hall $hall)
    {
        $deletedSeats = Seat::query()->where('hall_id', $hall->id)->delete();
        $hall->delete();

        return redirect()->back()->with('success', 'Hall has been successfully deleted');
    }
}
