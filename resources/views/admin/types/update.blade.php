@extends('layout')
@section('content')
    <section id="page-content">
        <div class="container">
            <div class="row">
                <div class="content col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="h4">Updated {{ $seatType->title }}</span>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.types.update', ['type' => $seatType->id])}}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" value="{{ $seatType->title }}"
                                               name="title" placeholder="Title">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="price">Price</label>
                                        <input type="number" class="form-control" value="{{ $seatType->price }}"
                                               step="0.01" name="price" placeholder="Enter price">
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
