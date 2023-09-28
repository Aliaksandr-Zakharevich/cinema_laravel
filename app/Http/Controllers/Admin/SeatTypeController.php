<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTypesRequest;
use App\Http\Requests\UpdateTypesRequest;
use App\Models\SeatType;
use Illuminate\Http\Request;

class SeatTypeController extends Controller
{

    public function index()
    {
        $seatTypes = SeatType::query()->orderByDesc('created_at')->paginate(12);;
        return view('admin.types.index', [
            'seatTypes' => $seatTypes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createView()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(CreateTypesRequest $request)
    {
        $validated = $request->validated();
        $seatType = SeatType::query()->create($validated);
        return redirect()->route('admin.types.index')->with('success', 'Seat type has been successfully created');
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
    public function edit(SeatType $type)
    {
        return view('admin.types.update', [
            'seatType' => $type
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypesRequest $request, SeatType $type)
    {
        $type->update($request->validated());
        return redirect()->route('admin.types.index')->with('success', 'Seat type has been successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SeatType $type)
    {
        $type->delete();
        return redirect()->route('admin.types.index')->with('success', 'Seat type has been successfully deleted');
    }
}
