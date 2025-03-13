@extends('layouts.default')

@section('title')
    {{ $news->name }} - Admin Panel
@endsection

@section('meta_desc')
    <meta name="title" content="{{ $news->name }} - Admin Panel">
    <meta name="description" content="{{ $news->name }} - Admin Panel">
    <meta name="keywords" content="{{ $news->name }} - Admin Panel">
@endsection

@section('content')
    <div class="container py-5">
        <a href="{{ url()->previous() }}">&larr;Back</a>
        <div class="row">
            <div class="col-4">
                    <div class="mb-3">
                        <div>Name:</div>
                        <h1>{{ $news->name }}</h1>
                    </div>
                    <div class="mb-3">
                        <div>Description:</div>
                        <p>{{ $news->description }}</p>
                    </div>
                    <div class="mb-3">
                        <div>Author:</div>
                        <p>{{ $news->authorUser->login }}</p>
                    </div>
                    <div class="mb-3">
                        Image:
                        @if (Str::startsWith($news->image, 'newsImage/'))
                            <img id="image" src="{{ asset('storage/'.$news->image) }}" alt="{{ $news->name }}" class="img-fluid mb-2">
                        @else
                            <img id="image" src="{{ asset('img/'.$news->image) }}" alt="{{ $news->name }}" class="img-fluid mb-2">
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
