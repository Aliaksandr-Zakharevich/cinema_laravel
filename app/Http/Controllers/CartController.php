<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Session;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function add(Seat $seat)
    {
        $this->cartService->addSeat($seat);
        return redirect()->back();
//        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }

    public function getCart(Session $session)
    {
        $cart = session()->get('cart');
//        session()->flush();
//        dd($cart);

        return view('cart', [
            'seats' => $cart ? Seat::with(['seatType', 'seatStatus'])->whereIn('id', array_keys($cart))->get() : null,
            'session' => Session::with(['hall', 'movie'])->where('id', $session->id)->first(),
            'cart' => $cart
        ]);
    }

    public function remove(Seat $seat)
    {
        $this->cartService->removeSeat($seat);
        return redirect()->back();
    }
}
