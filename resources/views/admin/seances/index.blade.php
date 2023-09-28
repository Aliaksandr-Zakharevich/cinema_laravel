@extends('layout')
@section('content')
    <!-- Page title -->
    <section id="page-title">
        <div class="container">
            <div class="page-title">
                <h1>Seances</h1>
                <span>Information about sessions</span>
            </div>
        </div>
    </section>
    <!-- end: Page title -->

    <section id="page-content" class="no-sidebar">
        <div class="container">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <a href="{{ route('admin.seances.create') }}" class="btn btn-light"><i class="icon-plus"></i>Add
                        Seance</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table id="datatable" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Movie</th>
                            <th>Hall</th>
                            <th>Start Date</th>
                            <th>Start Time</th>
                            <th>Duration</th>
                            <th class="noExport">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($seances as $seance)
                            <tr>
                                <td>{{ $seance->movie->title }}</td>
                                <td>{{ $seance->hall->title }}</td>
                                <td>{{ date_format(date_create($seance->start_date), 'd-M-Y') }}</td>
                                <td>{{ date_format(date_create($seance->start_date), 'H:i') }}</td>
                                <td>{{ $seance->movie->duration }}</td>
                                <td><a class="ml-2"
                                       href="{{ route('admin.seances.update.view', ['seance' => $seance->id]) }}"
                                       data-toggle="tooltip" data-original-title="Edit">edit</a>
                                    <a class="ml-2"
                                       href="{{ route('admin.seances.delete', ['seance' => $seance->id]) }}"
                                       data-toggle="tooltip" data-original-title="Delete">delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
