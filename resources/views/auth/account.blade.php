@extends('layout')
@section('content')
    <!-- Page title -->
    <section id="page-title">
        <div class="container">
            <div class="page-title">
                <h1>Profile</h1>
                <span>Change your account information</span>
            </div>
        </div>
    </section>
    <!-- end: Page title -->

    <section id="page-content">
        <div class="container">
            <div class="row">
                <div class="content col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <span class="h4">Profile</span>
                            <p class="text-muted">Change your account information</p>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('account.update') }}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                                               placeholder="Enter your name">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="first_name">Email</label>
                                        <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                                               placeholder="Enter your email">
                                    </div>
                                </div>
                                @foreach($errors->all() as $key => $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{$error}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span></button>
                                    </div>
                                @endforeach
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-sm">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
