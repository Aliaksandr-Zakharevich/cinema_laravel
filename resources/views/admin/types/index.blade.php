@extends('layout')
@section('content')
    <!-- Page title -->
    <section id="page-title">
        <div class="container">
            <div class="page-title">
                <h1>Seat Types</h1>
                <span>Information about seat types</span>
            </div>
        </div>
    </section>
    <!-- end: Page title -->

    <section id="page-content" class="no-sidebar">
        <div class="container">
            <div class="row mb-3">
                <div class="col-lg-6">
                    <a href="{{ route('admin.types.create.view') }}" class="btn btn-light"><i class="icon-plus"></i>Add
                        Seat Type</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table id="datatable" class="table table-bordered table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($seatTypes as $seatType)
                            <tr>
                                <td>{{ $seatType->title }}</td>
                                <td>{{ $seatType->price }}</td>
                                <td><a class="ml-2"
                                       href="{{ route('admin.types.update.view', ['type' => $seatType->id]) }}"
                                       data-toggle="tooltip" data-original-title="Edit">edit</a>
                                    <a class="ml-2" href="{{ route('admin.types.delete', ['type' => $seatType->id]) }}"
                                       data-toggle="tooltip" data-original-title="Delete">delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $seatTypes->appends(Request::all())->links() !!}
                </div>
            </div>
        </div>
    </section>
@endsection
