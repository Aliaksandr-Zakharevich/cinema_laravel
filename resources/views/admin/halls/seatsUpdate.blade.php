@extends('layout')

@section('content')
    <div class="movie-hall__wrapper">
        <div class="align-self-start m-20">
            <a href="{{route('admin.seances.index')}}" class="btn btn-outline">return to admin</a>
        </div>
        <div class="d-flex flex-row justify-content-around w-75">
            <div class="wrapper">
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

                <div class="movie-hall__container">
                    <div class="screen"></div>
                    <div class="row__wrapper">
                        @for($i = 0; $i<$hall->rows_count; $i++)
                            <div class="row">
                                @for($j = 0; $j<$hall->seats_in_row; $j++)
                                    <div class="col">
                                        <form action="@if($seats[$j+$i*$hall->seats_in_row]->seatStatus->title == 'Selected') {{route('admin.seat.remove')}}
                                    @else {{route('admin.seat.add', ['seat' => $seats[$j+$i*$hall->seats_in_row]->id])}}
                                    @endif" method="POST" style="display:inline!important">
                                            @csrf
                                            <button type="submit"
                                                    class="seat
                                        @if($seats[$j+$i*$hall->seats_in_row]->seatStatus->title == 'Selected') selected
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
            </div>
            @if($selectedSeat)
                <form action="{{route('admin.seat.update')}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <p>{{"{$selectedSeat->row} ряд {$selectedSeat->number} место"}}</p>
                                <label>Seat Type</label>
                                <select name="seat_type_id" class="form-control">
                                    @foreach($seatTypes as $seatType)
                                        <option value="{{$seatType->id}}"
                                                @if($selectedSeat->seatType->id == $seatType->id) selected @endif>{{$seatType->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn">Submit</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>

@endsection
