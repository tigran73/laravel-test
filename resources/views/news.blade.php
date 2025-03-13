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

        <div class="row mt-5 news-block">
            @foreach($news as $item)
                <div class="col-12 mb-5 p-3 border rounded news-item">
                    <a href="{{ route('news.detail', ['id' => $item->id]) }}">
                        <h2 class="mb-2">{{ $item->name }}</h2>

                        @if (Str::startsWith($item->image, 'newsImage/'))
                            <img src="{{ asset($item->image) }}" alt="{{ $item->name }}">
                        @else
                            <img src="{{ asset('img/'.$item->image) }}" alt="{{ $item->name }}" class="img-fluid mb-2">
                        @endif

                        <div class="text-end">{{ $item->updated_at->format('d.m.Y H:i') ?? $item->created_at('d.m.Y H:i') }}</div>
                    </a>
                </div>
            @endforeach
        </div>

            @if($news->total() > $news->perPage())
                <nav>
                    <ul class="pagination justify-content-center">
                        @for($i=1;$i <= $news->lastPage(); $i++)

                            @if($i == $news->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" data-page="{{ $i }}">{{ $i }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="#" data-page="{{ $i }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor
                    </ul>
                </nav>
            @endif
    </div>
@endsection


@section('scripts')
    <script>
        let app_url = '{{ url('/') }}';
    </script>
    <script src="{{ asset('js/news.js') }}?v=<?php echo filemtime(public_path('js/news.js'))?>"></script>
@endsection
