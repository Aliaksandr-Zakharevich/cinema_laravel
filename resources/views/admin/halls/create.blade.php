@extends('layout')
@section('content')
    <section id="page-content">
        <div class="container">
            <div class="row">
                <div class="content col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="h4">Create Hall</span>
                        </div>
                        <div class="card-body">
                            <form enctype="multipart/form-data" action="{{ route('admin.halls.create') }}"
                                  class="form-validate" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" value="{{ old('title') }}" name="title"
                                               placeholder="Title">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="rows_count">Row count</label>
                                        <input type="number" class="form-control" value="{{ old('rows_count') }}"
                                               min="1" max="10" name="rows_count" placeholder="Enter count of row">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="seats_in_row">Count seats in row</label>
                                        <input type="number" class="form-control" value="{{ old('seats_in_row') }}"
                                               min="1" max="10" name="seats_in_row"
                                               placeholder="Enter count seats in row">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="opening_time">Opening Time</label>
                                        <input type="time" class="form-control" value="{{ old('opening_time') }}"
                                               name="opening_time" placeholder="Enter opening time">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="closing_time">Closing Time</label>
                                        <input type="time" class="form-control" value="{{ old('closing_time') }}"
                                               name="closing_time" placeholder="Enter closing time">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="cleaning_time">Time to cleaning</label>
                                        <input type="number" class="form-control" value="{{ old('cleaning_time') }}"
                                               min="10" max="30" name="cleaning_time"
                                               placeholder="Enter time to cleaning">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="is_active">Status</label>
                                            <select name="is_active" class="form-control">
                                                <option value="1" @if(old('is_active') == 1) selected @endif>Active
                                                </option>
                                                <option value="0" @if(old('is_active') == 0) selected @endif>Not
                                                    active
                                                </option>
                                            </select>
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
