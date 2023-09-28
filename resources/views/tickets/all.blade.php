@extends('layout')
@section('content')
    <!-- Page title -->
    <section id="page-title">
        <div class="container">
            <div class="page-title">
                <h1>Tickets</h1>
                <span>Information about your tickets</span>
            </div>
        </div>
    </section>
    <!-- end: Page title -->

    <section id="page-content" class="no-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <table id="datatable" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Movie</th>
                            <th>Hall</th>
                            <th>Seats</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($tickets as $ticket)
                            <tr>
                                <td>{{ date_format(date_create($ticket->session->start_date), 'd-M-Y') }}</td>
                                <td>{{ date_format(date_create($ticket->session->start_date), 'H:i') }}</td>
                                <td>{{ $ticket->session->movie->title }}</td>
                                <td>{{ $ticket->session->hall->title }}</td>
                                <td>@foreach($ticket->seats as $seat)
                                        {{"{$seat->number} место {$seat->row} ряд \t {$seat->seatType->price} BYN"}}
                                        <br>
                                    @endforeach</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
