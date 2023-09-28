@extends('layout')
@section('content')
    <!-- Page title -->
    <section id="page-title">
        <div class="container">
            <div class="page-title">
                <h1>Movies</h1>
                <span>Information about movies</span>
            </div>
        </div>
    </section>
    <!-- end: Page title -->


    <section id="page-content" class="no-sidebar">
        <div class="container">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <a href="{{ route('admin.movies.create') }}" class="btn btn-light"><i class="icon-plus"></i>Add
                        Movie</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table id="datatable" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Duration</th>
                            <th>Age Limit</th>
                            <th>Genre</th>
                            <th>Release Year</th>
                            <th>Film Director</th>
                            <th>Created at</th>
                            <th>Status</th>
                            <th class="noExport">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($movies as $movie)
                            <tr>
                                <td>{{ $movie->title }}</td>
                                <td>{{ $movie->description }}</td>
                                <td>{{ $movie->duration }}</td>
                                <td>{{ $movie->age_limit }}</td>
                                <td>@foreach($movie->genres as $genre)
                                        {{$genre->title}} <br>
                                    @endforeach</td>
                                <td>{{ $movie->release_year }}</td>
                                <td>{{ $movie->film_director }}</td>
                                <td>{{ $movie->created_at }}</td>
                                @if($movie->is_active)
                                    <td><span class="badge badge-pill badge-primary">Active</span></td>
                                @else
                                    <td><span class="badge badge-pill badge-danger">Not active</span></td>
                                @endif
                                <td><a class="ml-2"
                                       href="{{ route('admin.movies.update.view', ['movie' => $movie->id]) }}"
                                       data-toggle="tooltip" data-original-title="Edit">edit</a>
                                    <a class="ml-2" href="{{ route('admin.movies.delete', ['movie' => $movie->id]) }}"
                                       data-toggle="tooltip" data-original-title="Delete">delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $movies->appends(Request::all())->links() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
