@extends('layout')

@section('content')
    <!-- Page title -->
    <section id="page-title">
        <div class="container">
            <div class="page-title">
                <h1>Afisha</h1>
                <span>Movies list</span>
            </div>
        </div>
    </section>
    <!-- end: Page title -->

    <!-- Shop products -->
    <section>
        <div class="container">
            <form class="row gx-3 gy-2 align-items-center m-b-20">
                <div class="col-sm-3">
                    <label class="visually-hidden" for="specificSizeSelect">Sort by hall</label>
                    <select class="form-select" name="hall" id="specificSizeSelect">
                        <option value="" selected></option>
                        @foreach($halls as $index => $hall)
                            <option value="{{$hall->id}}">{{$hall->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label class="visually-hidden" for="specificSizeSelect">Sort by day</label>
                    <select class="form-select" name="day" id="specificSizeSelect">
                        <option value="" selected></option>
                        @foreach($days as $index => $day)
                            <option value="{{$index}}">{{$day}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-3">
                    <label class="visually-hidden" for="specificSizeSelect">Sort by genre</label>
                    <select class="form-select" name="genre" id="specificSizeSelect">
                        <option value="" selected></option>
                        @foreach($genres as $index => $genre)
                            <option value="{{$genre->id}}">{{$genre->title}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Sort</button>
                </div>
            </form>
            <!--Product list-->
            <div class="shop">
                <div class="grid-layout grid-3-columns" data-item="grid-item">
                    @foreach($movies as $movie)
                        <div class="grid-item">
                            <div class="product">
                                <div class="product-image">
                                    <a href="{{route('movies.show', ['movie' => $movie->id])}}"><img
                                            alt="{{$movie->title}}" src="{{$movie->poster}}">
                                    </a>
                                    @if(Carbon\Carbon::parse($movie->created_at)->diffInDays(now()) > 3)
                                        <span class="product-new">NEW</span>
                                    @endif
                                </div>
                                <div class="product-description">
                                    <div class="product-category">|
                                        @foreach($movie->genres as $genre)
                                            {{$genre->title}} |
                                        @endforeach
                                    </div>
                                    <div class="product-title">
                                        <h3>
                                            <a href="{{route('movies.show', ['movie' => $movie->id])}}">{{$movie->title}}</a>
                                        </h3>
                                    </div>
                                </div>
                                <a href="{{route('movies.show', ['movie' => $movie->id])}}" class="btn btn-outline btn-dark">Bye Ticket</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                {!! $movies->appends(Request::all())->links() !!}
                <!-- end: Pagination -->
            </div>
            <!--End: Product list-->
        </div>
    </section>
    <!-- end: Shop products -->
@endsection
