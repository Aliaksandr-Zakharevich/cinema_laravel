<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Ticket;
use App\Services\PaymentService;
use Illuminate\Support\Str;

class PaymentController extends Controller
{

    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function createPayment(Ticket $ticket){
        $successPayment = $ticket->payments()->where('status', 'complete')->get();
        if (count($successPayment) != 0) {
            return redirect()->route('tickets.all')->with('success', 'Already paid');
        }
        $paymentHash = Str::random(40);
        $paymentSession = $this->paymentService->createPayment($ticket, $paymentHash);
        Payment::query()->create([
            'status' => $paymentSession->status,
            'ticket_id' => $ticket->id,
            'session_id' => $paymentSession->id,
            'hash' => $paymentHash
        ]);

        return redirect($paymentSession->url);
    }

    public function callback(string $hash){
        $payment = Payment::query()->where('hash', $hash)->firstOrFail();
        $paymentSession = $this->paymentService->getPayment($payment->session_id);
        $status = $paymentSession->status;
        $payment->status = $status;
        $payment->save();

        if ($status === 'complete') {
            $this->paymentService->sendTicketsToMail($payment->ticket);
            return redirect()->route('tickets.all')->with('success', 'Payment completed');
        }

        return redirect()->route('main')->with('fail', 'Something wrong');
    }
}
