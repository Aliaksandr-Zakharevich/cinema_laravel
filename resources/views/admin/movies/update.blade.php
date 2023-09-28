@extends('layout')
@section('content')
    <section id="page-content">
        <div class="container">
            <div class="row">
                <div class="content col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="h4">Updated {{ $movie->title }}</span>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data"
                                  action="{{ route('admin.movies.update', ['movie' => $movie->id]) }}"
                                  class="form-validate" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="username">Title</label>
                                        <input type="text" class="form-control" value="{{ $movie->title }}" name="title"
                                               placeholder="Title">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control" value="{{ $movie->description }}"
                                               name="short_description" placeholder="Enter your short description">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="price">Duration</label>
                                        <input type="number" class="form-control" value="{{ $movie->duration }}"
                                               name="duration" placeholder="Enter duration">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="sale_price">Age Limit</label>
                                        <input type="text" class="form-control" value="{{ $movie->age_limit }}"
                                               name="age_limit" placeholder="Enter age limit">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="sale_price">Release Year</label>
                                        <input type="text" class="form-control" value="{{ $movie->release_year }}"
                                               name="release_year" placeholder="Enter release year">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="sale_price">Movie Director</label>
                                        <input type="text" class="form-control" value="{{ $movie->film_director }}"
                                               name="film_director" placeholder="Enter movie director">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="category">Genre</label>
                                            <select name="genre_id" class="form-control">
                                                <option value="">None</option>
                                                @foreach($movie->genres as $genre)
                                                    <option value="{{ $genre->id }}"
                                                            @if($movie->$genre == $genre->id) selected @endif>{{ $genre->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="is_active">Status</label>
                                            <select name="is_active" class="form-control">
                                                <option value="1" @if($movie->is_active == 1) selected @endif>Active
                                                </option>
                                                <option value="0" @if($movie->is_active == 0) selected @endif>Not
                                                    active
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label>Description</label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="description"
                                                      rows="10">{{ $movie->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="file">File</label>
                                            <input type="file" name="files[]" multiple class="form-control-file"
                                                   id="file">
                                        </div>
                                    </div>
                                </div>
                                @if($errors->any())
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                @foreach($errors->all() as $key => $error)
                                                    {{$error}} <br>
                                                @endforeach
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <button type="submit" class="btn m-t-30 mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
