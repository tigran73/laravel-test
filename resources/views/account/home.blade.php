@extends('layouts.default')

@section('title')
    Account
@endsection

@section('meta_desc')
    <meta name="title" content="Account">
    <meta name="description" content="Account Page">
    <meta name="keywords" content="Account, Account page">
@endsection

@section('content')
    <div class="container py-5">
        <h1>{{ \Auth::user()->login }}</h1>

        <h4>Actions:</h4>
        <ul class="list-unstyled">
            <li><a href="">Change password</a></li>
            <li><a href="">Add news</a></li>
            <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </div>

@endsection
