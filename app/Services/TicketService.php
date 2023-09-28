<?php

namespace App\Services;

use App\Models\Seat;
use App\Models\SeatStatus;
use App\Models\Session;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TicketService
{
    public function create(Session $seance, User $user)
    {
        $cart = session()->get('cart', []);
        $seats = Seat::with('seatType')->whereIn('id', array_keys($cart))->get();
        $seatStatus = SeatStatus::query()->where('title', 'Occupied')->first();

        $ticket = Ticket::query()->create([
            'user_id' => $user->id,
            'session_id' => $seance->id
        ]);

        foreach ($seats as $seat) {
            $ticket->seats()->attach($seat);
            $seat->seatStatus()->associate($seatStatus);
            $seat->save();
        }
        session()->forget('cart');
        return $ticket;
    }

}
