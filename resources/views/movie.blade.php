@extends('layout')

@section('content')
    <!-- Content -->
    <section id="page-content" class="p-b-0">
        <div class="container">
            <div class="row m-b-40">
                <div class="sidebar sticky-sidebar col-lg-4">
                    <h2 class="m-b-30">{{$movie->title}}</h2>
                    <div class="project-description">
                        <h3>{{$movie->description}}</h3>
                    </div>
                    <div class="portfolio-attributes style2">
                        <div class="attribute"><strong>Genres:</strong>
                            |
                            @foreach($movie->genres as $genre)
                                {{$genre->title}} |
                            @endforeach

                        </div>
                        <div class="attribute"><strong>Director:</strong> {{$movie->film_director}}</div>
                        <div class="attribute"><strong>Release Year:</strong> {{$movie->release_year}} </div>
                        <div class="attribute"><strong>Duration:</strong> {{$movie->duration}} minutes</div>
                        <div class="attribute"><strong>Age Limit:</strong> {{$movie->age_limit}}+</div>
                    </div>

                    @foreach ($halls as $hall)
                        <div class="movie-seances__hall">
                            <h3 class="movie-seances__hall-title">{{ $hall->title }}</h3>
                            <ul class="movie-seances__list">
                                @foreach ($movie->sessions as $seance)
                                    @if ($seance->hall_id === $hall->id)
                                        <div class="col-lg-3">
                                            <button type="button" class="btn btn-outline btn-dark"><a
                                                    href="{{route('seance', ['session' => $seance->id])}}"
                                                    class="movie-seances__time">
                                                    {{ date_format(date_create($seance->start_date), 'd-M-Y') }}
                                                    <br>
                                                    {{ date_format(date_create($seance->start_date), 'H:i') }}
                                                </a></button>
                                        </div>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @endforeach

                </div>
                <div class="col-lg-7 offset-1">
                    <div class="portfolio-content" data-lightbox="gallery">
                        <br>
                        <div class="video-wrap">
                            <iframe src="{{$movie->trailer}}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                        </div>
                        <br>
                        <a title="{{$movie->title}}" data-lightbox="gallery-image" href="#">
                            <img src="{{$movie->poster}}" data-animate="fadeInUp">
                        </a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- end: Content -->
@endsection
