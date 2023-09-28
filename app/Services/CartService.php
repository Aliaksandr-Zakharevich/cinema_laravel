<?php

namespace App\Services;

use App\Models\Seat;
use App\Models\SeatStatus;

class CartService
{
    public function addSeat(Seat $seat)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$seat->id])) {
            $selectedSeat = Seat::find($seat->id);
            $seatStatus = SeatStatus::find(2);
            $selectedSeat->seatStatus()->associate($seatStatus);
            $selectedSeat->save();
            $cart[$seat->id] = $selectedSeat->id;
            session()->put('cart', $cart);
        }
    }

    public function removeSeat(Seat $seat)
    {
        $cart = session()->get('cart');

        if (isset($cart[$seat->id])) {
            $selectedSeat = Seat::find($seat->id);
            $seatStatus = SeatStatus::find(1);
            $selectedSeat->seatStatus()->associate($seatStatus);
            $selectedSeat->save();
            unset($cart[$selectedSeat->id]);
            session()->put('cart', $cart);
        }
    }
}
