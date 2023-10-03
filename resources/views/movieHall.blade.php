@extends('layout')

@section('content')
    <div class="movie-hall__wrapper">
        <ul class="showcase">
            <li>
                <div class="seat"></div>
                <small>N/A</small>
            </li>

            <li>
                <div class="seat selected"></div>
                <small>Selected</small>
            </li>

            <li>
                <div class="seat occupied"></div>
                <small>Occupied</small>
            </li>
        </ul>

        <div class="movie-hall__container inverted">
            <div class="screen"></div>
            <div class="row__wrapper">
                @for($i = 0; $i<$hall->rows_count; $i++)
                    <div class="row">
                        @for($j = 0; $j<$hall->seats_in_row; $j++)
                            <div class="col">
                                <form action="@if($seats[$j+$i*$hall->seats_in_row]->seatStatus->title == 'Selected') {{route('cart.remove', ['seat' => $seats[$j+$i*$hall->seats_in_row]->id])}}
                                    @else {{route('cart.add', ['seat' => $seats[$j+$i*$hall->seats_in_row]->id])}}
                                    @endif" class="form-button" method="POST">
                                    @csrf
                                    <button type="submit"
                                            @if($seats[$j+$i*$hall->seats_in_row]->seatStatus->title == 'Occupied') disabled
                                            @endif
                                            class="seat
                                        @if($seats[$j+$i*$hall->seats_in_row]->seatStatus->title == 'Occupied') occupied
                                        @elseif($seats[$j+$i*$hall->seats_in_row]->seatStatus->title == 'Selected') selected
                                        @endif
                                        " data-bs-toggle="tooltip"
                                            data-bs-custom-class="custom-tooltip"
                                            data-bs-html="true"
                                            data-bs-title="
                                            <span><b>{{$seats[$j+$i*$hall->seats_in_row]->row}} ряд</b></span>
                                            <span><b>{{$seats[$j+$i*$hall->seats_in_row]->number}} место</b></span>
                                            <br>
                                            <span><b>{{$seats[$j+$i*$hall->seats_in_row]->seatType->title}}</b></span>
                                            <span><b>{{$seats[$j+$i*$hall->seats_in_row]->seatType->price}} BYN</b></span>
                                        ">
                                    </button>
                                </form>
                            </div>
                        @endfor
                    </div>
                @endfor
            </div>
        </div>

        <p class="text">
            You have selected <span id="count">@if($selectedSeats)
                    {{count($selectedSeats)}}
                @else
                    0
                @endif</span> seats for a price of <span id="total">
                   @if($selectedSeats)
                    {{$selectedSeats->sum(function ($seat){
                        return $seat->seatType->price;
                    })}}
                @else
                    0
                @endif
            </span>
            BYN
        </p>

        <a href="{{route('cart.get', ['session' => $session->id])}}" class="btn btn-submit">Submit and go to pay</a>
    </div>

@endsection
