@extends('layouts.default')

@section('title')
    Change password - Account
@endsection

@section('meta_desc')
    <meta name="title" content="Change password - Account">
    <meta name="description" content="Change password - Account">
    <meta name="keywords" content="Change password - Account">
@endsection

@section('content')
    <div class="container py-5">
        <h1>Change password</h1>


        <div class="row">
            <div class="col-4">
                <form method="POST" action="{{ route('changePassword') }}">
                    @csrf
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label for="password" class="form-label">New password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               id="password" name="password" required autocomplete="password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="confirmed_password" class="form-label">Confirmed new password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                               id="confirmed_password" name="password_confirmation" required
                               autocomplete="confirmed_password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection
