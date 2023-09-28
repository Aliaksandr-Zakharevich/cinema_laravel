@extends('layout')
@section('content')
    <div id="slider" class="inspiro-slider slider-fullscreen dots-creative" data-fade="true">
        @foreach($promotions as $promotion)
            <div class="slide kenburns" data-bg-image="{{ $promotion->image }}">
                <div class="bg-overlay"></div>
                <div class="container">
                    <div class="slide-captions text-center text-light">
                        <h1>{{ $promotion->title }}</h1>
                        <p>{{ $promotion->description }}</p>
                        <div><a href="{{ route('movies.afisha') }}" class="btn scroll-to">Show afisha</a></div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
