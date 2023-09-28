@extends('layout')

@section('content')
    <!-- Page title -->
    <section id="page-title">
        <div class="container">
            <div class="page-title">
                <h1>Shopping Cart</h1>
                <span>Shopping details</span>
            </div>
        </div>
    </section>
    <!-- end: Page title -->
    @if($seats)
        <!-- SHOP CART -->
        <section id="shop-cart">
            <div class="container">
                <form class="shop-cart" action="{{route('tickets.create', ['seance' => $session->id])}}" method="POST">
                    @csrf
                    <div class="table table-sm table-striped table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="cart-product-remove"></th>
                                <th class="cart-product-thumbnail">Movie Title</th>
                                <th class="cart-product-thumbnail">Hall Title</th>
                                <th class="cart-product-name">Description</th>
                                <th class="cart-product-price">Unit Price</th>
                                <th class="cart-product-subtotal">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($seats as $seat)
                                <tr>
                                    <td class="cart-product-remove">
                                        <a href="#"><i class="fa fa-times"></i></a>
                                    </td>
                                    <td class="cart-product-thumbnail">
                                        <a href="#">
                                            <img src="{{$session->movie->poster}}" alt="{{$session->movie->title}}">
                                        </a>
                                        <div class="cart-product-thumbnail-name">{{$session->movie->title}}</div>
                                    </td>
                                    <td class="cart-product-price">
                                        <div class="cart-product-thumbnail-name">{{$session->hall->title}}</div>
                                    </td>
                                    <td class="cart-product-description">
                                        <p><span>Type Seat: {{$seat->seatType->title}}</span>
                                            <span>Row: {{$seat->row}}</span>
                                            <span>Number: {{$seat->number}}</span>
                                        </p>
                                    </td>
                                    <td class="cart-product-price">
                                        <span class="amount">{{$seat->seatType->price}} BYN</span>
                                    </td>
                                    <td class="cart-product-subtotal">
                                        <span class="amount">{{$seat->seatType->price}} BYN</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-11 text-right">
                            <button type="submit" class="btn">
                                <div class="icon-holder">
                                    <i class="fa fa-wallet"></i>
                                </div>
                                Pay
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- end: SHOP CART -->
        {{--    <form action="{{route('tickets.create', ['seance' => $session->id])}}" method="POST">--}}
        {{--        @csrf--}}
        {{--        <h2>@if(count($seats) > 1) Ваши билеты @else Ваш билет @endif {{' на фильм "'. $session->movie->title .'"'}}</h2>--}}
        {{--        <table>--}}
        {{--            <tr>--}}
        {{--                <th>Дата Сеанса: </th>--}}
        {{--                <td>{{$session->start_date}}</td>--}}
        {{--            </tr>--}}
        {{--            <tr>--}}
        {{--                <th>Зал: </th>--}}
        {{--                <td>{{$session->hall->title}}</td>--}}
        {{--            </tr>--}}
        {{--            <tr>--}}
        {{--                <th>Места: </th>--}}
        {{--            @foreach($seats as $index => $seat)--}}
        {{--                <tr>--}}
        {{--                    <td>{{$index + 1 . '. Ряд ' . $seat->row . ', Место '.$seat->number.' , '.$seat->seatType->price.' BYN'}}</td>--}}
        {{--                </tr>--}}
        {{--                @endforeach--}}
        {{--                </tr>--}}
        {{--                <tr>--}}
        {{--                    <th>Общая стоимость: </th>--}}
        {{--                    <td>--}}
        {{--                        {{$seats->sum(function ($seat){--}}
        {{--                        return $seat->seatType->price;--}}
        {{--                        })}}--}}
        {{--                    </td>--}}
        {{--                </tr>--}}
        {{--        </table>--}}
        {{--        <button type="submit" class="btn btn-submit">Pay</button>--}}
        {{--    </form>--}}
    @else
        <!-- SHOP CART EMPTY -->
        <section id="shop-cart">
            <div class="container">
                <div class="p-t-10 m-b-20 text-center">
                    <div class="heading-text heading-line text-center">
                        <h4>Your cart is currently empty.</h4>
                    </div>
                    <a class="btn icon-left" href="{{route('seance', ['session' => $session->id])}}"><span>Return To Seance</span></a>
                </div>
            </div>
        </section>
        <!-- end: SHOP CART EMPTY -->
    @endif

@endsection
