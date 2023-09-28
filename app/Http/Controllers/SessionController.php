<?php

namespace App\Http\Controllers;

use App\Models\Hall;
use App\Models\Movie;
use App\Models\Seat;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function seance(Session $session)
    {

        $movie = Movie::query()->where('id', $session->movie->id)->get();
        $hall = Hall::find($session->hall->id);
        $seats = Seat::query()->where('session_id', $session->id)->get();
        $cart = session()->get('cart');
        return view('movieHall', [
            'session' => $session,
            'movie' => $movie,
            'hall' => $hall,
            'seats' => $seats,
            'selectedSeats' => $cart ? Seat::with('seatType')->whereIn('id', array_keys($cart))->get() : null,
        ]);
    }
}
