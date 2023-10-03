<?php

namespace App\Services;

use App\Models\Seat;
use App\Models\SeatStatus;
use App\Models\Session;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class TicketService
{
    public function create(Session $seance)
    {
        $cart = session()->get('cart', []);
        $seats = Seat::with('seatType')->whereIn('id', array_keys($cart))->get();
        $seatStatus = SeatStatus::query()->where('title', 'Occupied')->first();

        try{
            $ticket = Ticket::query()->create([
                'user_id' => Auth::user()->id,
                'session_id' => $seance->id
            ]);

            foreach ($seats as $seat) {
                $seat->ticket_id = $ticket->id;
                $seat->seatStatus()->associate($seatStatus);
                $seat->save();
            }
            session()->forget('cart');
            DB::commit();
        } catch (Exception $exception){
            DB::rollBack();
        }

        return $ticket;
    }

}
