<?php

namespace App\Http\Controllers;

use App\Mail\TicketMail;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Seat;
use App\Models\Session;
use App\Models\Ticket;
use App\Services\TicketService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{

    private $ticketService;

    public function __construct(TicketService $ticketService)
    {
        $this->ticketService = $ticketService;
    }

    public function createTicket(Session $seance)
    {
        $user = Auth::user();
        $ticket = $this->ticketService->create($seance, $user);
        Mail::to($user->email)->send(new TicketMail($user, $ticket, $seance));
        return redirect()->route('tickets.all');
    }

    public function allTickets()
    {
        $tickets = Ticket::query()->where('user_id', Auth::user()->id)->get();
        return view('tickets.all', [
            'tickets' => $tickets
        ]);
    }
}
