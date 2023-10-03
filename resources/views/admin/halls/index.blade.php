@extends('layout')
@section('content')
    <!-- Page title -->
    <section id="page-title">
        <div class="container">
            <div class="page-title">
                <h1>Halls</h1>
                <span>Information about halls</span>
            </div>
        </div>
    </section>
    <!-- end: Page title -->

@if(count($halls) !== 0)
    <section id="page-content" class="no-sidebar">
        <div class="container">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <a href="{{ route('admin.halls.create') }}" class="btn btn-light"><i class="icon-plus"></i>Add Hall</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table id="datatable" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Rows count</th>
                            <th>Seats in row</th>
                            <th>Capacity</th>
                            <th>Opening Time</th>
                            <th>Closing Time</th>
                            <th>Cleaning Time</th>
                            <th>Status</th>
                            <th class="noExport">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($halls as $hall)
                            <tr>
                                <td>{{ $hall->title }}</td>
                                <td>{{ $hall->rows_count }}</td>
                                <td>{{ $hall->seats_in_row }}</td>
                                <td>{{ $hall->rows_count * $hall->seats_in_row }}</td>
                                <td>{{ $hall->opening_time }}</td>
                                <td>{{ $hall->closing_time }}</td>
                                <td>{{ $hall->cleaning_time }} min</td>
                                @if($hall->is_active)
                                    <td><span class="badge badge-pill badge-primary">Active</span></td>
                                @else
                                    <td><span class="badge badge-pill badge-danger">Not active</span></td>
                                @endif
                                <td><a class="ml-2" href="{{ route('admin.halls.update.view', ['hall' => $hall->id]) }}"
                                       data-toggle="tooltip" data-original-title="Edit">edit</a>
                                    <a class="ml-2" href="{{ route('admin.halls.delete', ['hall' => $hall->id]) }}"
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
@else
    <section id=id="page-content" class="no-sidebar">
        <div class="container">
            <div class="p-t-10 m-b-20 text-center">
                <div class="heading-text heading-line text-center">
                    <h4>Halls is currently empty.</h4>
                </div>
                <a class="btn icon-left" href="{{ route('admin.halls.create') }}"><span>Add Hall</span></a>
            </div>
        </div>
    </section>
@endif
@endsection
