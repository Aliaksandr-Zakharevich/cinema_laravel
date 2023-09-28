<?php

namespace App\Services;

use App\Models\Seat;
use App\Models\SeatStatus;
use App\Models\SeatType;
use Nette\Utils\Type;

class SeatService
{
    private $seatStatuses;

    public function __construct()
    {
        $this->seatStatuses = SeatStatus::all();
    }

    public function addSeat(Seat $seat)
    {
        $this->removeSeat();
        $selected = session()->get('selected');
        $selectedSeat = Seat::find($seat->id);
        $seatStatus = $this->seatStatuses->firstWhere('title', 'Selected');
        $selectedSeat->seatStatus()->associate($seatStatus);
        $selectedSeat->save();
        $selected = $selectedSeat->id;

        session()->put('selected', $selected);
    }

    public function updateSeat(array $data)
    {
        $selected = session()->get('selected');
        $selectedSeat = Seat::find($selected);
        $seatType = SeatType::find($data['seat_type_id']);
        $selectedSeat->seatType()->associate($seatType);
        $selectedSeat->save();
    }

    public function removeSeat()
    {
        $selected = session()->get('selected');
        if ($selected) {
            $selectedSeat = Seat::find($selected);
            $seatStatus = $this->seatStatuses->firstWhere('title', 'N/A');
            $selectedSeat->seatStatus()->associate($seatStatus);
            $selectedSeat->save();
            session()->forget('selected');
        }
    }
}
