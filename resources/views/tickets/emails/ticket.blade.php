<html>
<head>
    <link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
</head>
<body>
<div class="wrapper">
    @foreach($ticket->seats as $seat)
        <div class="ticket">
        <div class="holes-top"></div>
        <div class="title">
            <p class="cinema">ODEON CINEMA PRESENTS</p>
            <p class="movie-title">{{$seance->movie->title}}</p>
        </div>
        <div class="poster">
            <img class='ticket__img' src="{{$seance->movie->poster}}" alt="{{$seance->movie->title}}" />
        </div>
        <div class="info">
            <table>
                <tr>
                    <th>SCREEN</th>
                    <th>ROW</th>
                    <th>SEAT</th>
                </tr>
                <tr>
                    <td class="bigger">{{$seance->hall->title}}</td>
                    <td class="bigger">{{$seat->row}}</td>
                    <td class="bigger">{{$seat->number}}</td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>PRICE</th>
                    <th>DATE</th>
                    <th>TIME</th>
                </tr>
                <tr>
                    <td>{{$seat->seatType->price}} BYN</td>
                    <td>{{ date_format(date_create($seance->start_date), 'd-M-Y') }}</td>
                    <td>{{ date_format(date_create($seance->start_date), 'H:i') }}</td>
                </tr>
            </table>
        </div>
        <div class="holes-lower"></div>
    </div>
    @endforeach
</div>
</body>
</html>

