@extends('layouts.default')

@section('title')
    {{ $user->login }} - Admin Panel
@endsection

@section('meta_desc')
    <meta name="title" content="{{ $user->login }} - Admin Panel">
    <meta name="description" content="{{ $user->login }} - Admin Panel">
    <meta name="keywords" content="{{ $user->login }} - Admin Panel">
@endsection

@section('content')
    <div class="container py-5">
        <div class="d-flex align-items-center justify-content-between">
            <h1> Login: {{ $user->login }}</h1>
        </div>
    </div>
@endsection
