@extends('layouts.default')

@section('title')
    Login
@endsection

@section('meta_desc')
    <meta name="title" content="Login">
    <meta name="description" content="Login Page">
    <meta name="keywords" content="Login Page">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Login</h2>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="login" class="form-label">Login</label>
                                <input type="login" class="form-control @error('email') is-invalid @enderror" id="login"
                                       name="login" value="{{ old('email') }}" required autocomplete="login" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password" required autocomplete="current-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
