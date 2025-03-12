@extends('layouts.default')

@section('title')
    News
@endsection

@section('meta_desc')
    <meta name="title" content="News">
    <meta name="description" content="News Page">
    <meta name="keywords" content="news, global news">
@endsection

@section('content')
    <div class="container py-5">
        <h1>News</h1>

        <div class="row mt-5">
            @foreach($news as $item)
                <div class="col-12 mb-5 p-3 border rounded news-item">
                    <a href="{{ route('news.detail', ['id' => $item->id]) }}">
                    <h2 class="mb-2">{{ $item->name }}</h2>
                    <img src="{{ asset('img/'.$item->image) }}" alt="{{ $item->name }}" class="img-fluid mb-2">
                    <div class="text-end">{{ $item->updated_at ?? $item->created_at }}</div>
                    </a>
                </div>
            @endforeach

            @if($news->total() > $news->perPage())
                <nav>
                    <ul class="pagination justify-content-center">
                        @for($i=1;$i < $news->lastPage(); $i++)

                            @if($i == $news->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $i }}</span>
                            </li>
                            @else
                                <li class="page-item"><a class="page-link" href="#">{{ $i }}</a></li>
                            @endif
                        @endfor
                    </ul>
                </nav>
            @endif
        </div>
    </div>
@endsection
