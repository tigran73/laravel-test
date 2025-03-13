@extends('layouts.default')

@section('title')
    Users - Admin Panel
@endsection

@section('meta_desc')
    <meta name="title" content="Users - Admin Panel">
    <meta name="description" content="Users - Admin Panel">
    <meta name="keywords" content="Users - Admin Panel">
@endsection

@section('content')
    <div class="container py-5">
        <a href="{{ url()->previous() }}">&larr;Back</a>
        <h1>@if($edit)Edit Users @else Create Users @endif</h1>

        <div class="row">
            <div class="col-4">
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
                <form action="@if($edit){{ route('users.update', $user) }}@else{{ route('users.store') }}@endif" method="POST">
                    @csrf
                    @if($edit)
                    @method('PUT')
                    @endif
                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" class="form-control" id="login" value="{{ $user->login }}" @if($edit) disabled @else name="login" @endif>
                    </div>
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
                               id="confirmed_password" name="password_confirmation" required autocomplete="confirmed_password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">@if($edit) Save @else Create @endif</button>
                </form>
            </div>
        </div>

    </div>

@endsection
