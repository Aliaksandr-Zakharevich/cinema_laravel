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
            <div class="row m-b-20">
                <div class="col-lg-6 p-t-10 m-b-20">
                    <h3 class="m-b-20">A Monochromatic Spring ’15</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, sit, exercitationem,
                        consequuntur, assumenda iusto eos commodi alias.</p>
                </div>
                <div class="col-lg-3">
                    <div class="order-select">
                        <h6>Sort by</h6>
                        <p>Showing 1&ndash;12 of 25 results</p>
                        <form method="get">
                            <select class="form-control">
                                <option value="order" selected="selected">Default sorting</option>
                                <option value="popularity">Sort by popularity</option>
                                <option value="rating">Sort by average rating</option>
                                <option value="date">Sort by newness</option>
                                <option value="price">Sort by price: low to high</option>
                                <option value="price-desc">Sort by price: high to low</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="order-select">
                        <h6>Sort by Price</h6>
                        <p>From 0 - 190$</p>
                        <form method="get">
                            <select class="form-control">
                                <option value="" selected="selected">0$ - 50$</option>
                                <option value="">51$ - 90$</option>
                                <option value="">91$ - 120$</option>
                                <option value="">121$ - 200$</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
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
