@extends('layouts.default')


@section('title')
    Register
@endsection

@section('meta_description')
    <meta name="title" content="Register">
    <meta name="description" content="Register Page">
    <meta name="keywords" content="Register, Register Page">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center py-5">
            <div class="col-md-6 d-flex justify-content-center align-items-center">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Register</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="login" class="form-label">Login</label>
                                <input type="text" class="form-control @error('login') is-invalid @enderror" id="login"
                                       name="login" value="{{ old('login') }}" required autocomplete="login">
                                @error('login')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password" required autocomplete="password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="confirmed_password" class="form-label">Confirmed Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                       id="confirmed_password" name="password_confirmation" required autocomplete="confirmed_password">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
                            <a href="{{ route('login') }}">Login</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
