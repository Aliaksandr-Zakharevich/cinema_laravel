<?php

namespace App\Mail;

use App\Models\Seat;
use App\Models\Session;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    private $user;
    private $ticket;
    private $seance;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, Ticket $ticket, Session $seance)
    {
        $this->user = $user;
        $this->ticket = $ticket;
        $this->seance = $seance;

    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ticket Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'tickets.emails.ticket',
            with: [
                'user' => $this->user,
                'ticket' => $this->ticket,
                'seance' => $this->seance
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
