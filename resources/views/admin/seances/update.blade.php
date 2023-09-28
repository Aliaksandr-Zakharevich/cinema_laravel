@extends('layout')
@section('content')
    <section id="page-content">
        <div class="container">
            <div class="row">
                <div class="content col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="h4">Update Seance</span>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data"
                                  action="{{ route('admin.seances.update', ['seance' => $seance->id]) }}"
                                  class="form-validate" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="movie_id">Movie</label>
                                            <select name="movie_id" class="form-control">
                                                @foreach($movies as $movie)
                                                    <option value="{{$movie->id}}"
                                                            @if($seance->movie_id == $movie->id) selected @endif>{{$movie->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="hall">Hall</label>
                                            <select name="hall_id" class="form-control">
                                                @foreach($halls as $hall)
                                                    <option value="{{$hall->id}}"
                                                            @if($seance->hall_id == $hall->id) selected @endif>{{$hall->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="start_date">Start Date</label>
                                            <input class="form-control" type="datetime-local"
                                                   value="{{ $seance->start_date }}" name="start_date">
                                        </div>
                                    </div>
                                    @if($errors->any())
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                     role="alert">
                                                    @foreach($errors->all() as $key => $error)
                                                        {{$error}} <br>
                                                    @endforeach
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close"><span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <button type="submit" class="btn m-t-30 mt-3">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
