<?php

namespace App\Services;

use App\Mail\TicketMail;
use App\Models\Seat;
use App\Models\Ticket;
use Illuminate\Support\Facades\Mail;
use Stripe\Checkout\Session;
use Stripe\StripeClient;

class PaymentService
{
    private StripeClient $stripeClient;

    public function __construct()
    {
        $this->stripeClient = new StripeClient(config("services.stripe.secret_key"));
    }

    public function createPayment(Ticket $ticket, string $paymentHash)
    {
        $paymentSession = $this->stripeClient->checkout->sessions->create([
            'success_url' => route('payment.callback', ['hash' => $paymentHash]),
            'cancel_url' => url()->previous(),
            'line_items' => $this->ticketsGeneration($ticket),
            'mode' => 'payment',
            'customer_email' => $ticket->user->email
        ]);
        return $paymentSession;
    }

    private function ticketsGeneration(Ticket $ticket)
    {
        $tickets = [];
        /** @var Ticket $ticket */
        foreach ($ticket->seats as $seat) {
            $tickets[] = [
                'quantity' => 1,
                'price_data' => [
                    'currency' => 'BYN',
                    'product_data' => [
                        'name' => $ticket->session->movie->title,
                        'description' => $ticket->session->movie->description
                    ],
                    'unit_amount' => $seat->seatType->price * 100
                ]
            ];
        }
        return array_values($tickets);
    }

    public function getPayment(string $id): Session
    {
        return $this->stripeClient->checkout->sessions->retrieve(
            $id
        );
    }

    public function sendTicketsToMail(Ticket $ticket){
        Mail::to($ticket->user->email)->send(new TicketMail($ticket->user, $ticket, $ticket->session));
    }
}
