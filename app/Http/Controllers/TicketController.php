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
        $ticket = $this->ticketService->create($seance);
        return redirect()->route('payment.create', ['ticket' => $ticket->id]);
    }

    public function allTickets()
    {
        $tickets = Ticket::query()->where('user_id', Auth::user()->id)->get();
        return view('tickets.all', [
            'tickets' => $tickets
        ]);
    }
}
