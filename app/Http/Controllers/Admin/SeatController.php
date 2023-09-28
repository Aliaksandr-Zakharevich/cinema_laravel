<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSeatRequest;
use App\Models\Seat;
use App\Services\SeatService;

class SeatController extends Controller
{
    private $seatService;

    public function __construct(SeatService $seatService)
    {
        $this->seatService = $seatService;
    }

    public function add(Seat $seat)
    {
        $this->seatService->addSeat($seat);
        return redirect()->back();
    }

    public function update(UpdateSeatRequest $request)
    {
        $this->seatService->updateSeat($request->validated());
        return redirect()->back();
    }

    public function remove()
    {
        $this->seatService->removeSeat();
        return redirect()->back();
    }
}
