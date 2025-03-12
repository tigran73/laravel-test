@extends('layouts.default')

@section('title')
    {{ $post->name }}
@endsection

@section('meta_desc')
    <meta name="title" content="{{ $post->name }}">
    <meta name="description" content="{{ $post->description }}">
    <meta name="keywords" content="{{ $post->description }}">
@endsection

@section('content')
    <div class="container py-5">
        <a href="{{ url()->previous() }}">&larr;Back</a>
        <div class="row pt-5">
            <div class="col-12">
                <img src="{{ asset('img/' . $post->image) }}" alt="{{ $post->name }}" class="img-fluid mb-3">
                <h1 class="mb-2">{{ $post->name }}</h1>
                <h4 class="mb-3">{{ $post->authorUser->login }}</h4>
                <p class="border-top pt-3">
                    {{ $post->description }}
                </p>
                <div class="text-end">{{ $post->updated_at ?? $post->created_at }}</div>
            </div>
        </div>

    </div>

@endsection
