@extends('layouts.default')

@section('title')
    News - Admin Panel
@endsection

@section('meta_desc')
    <meta name="title" content="News - Admin Panel">
    <meta name="description" content="News - Admin Panel">
    <meta name="keywords" content="News - Admin Panel">
@endsection

@section('content')
    <div class="container py-5">
        <a href="{{ route('admin') }}">&larr;Back</a>
        <div class="d-flex align-items-center justify-content-between">
            <h1>News</h1>
            <a href="{{ route('news.create') }}" class="btn btn-primary">Create</a>
        </div>
        <div class="row">
            <div class="col-12">
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
                <table class="table table-bordered news-table">
                    <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($news as $item)
                        <tr class="news-rows">
                            <th scope="row">{{$item->id}}</th>
                            <td>{{$item->name}}</td>
                            <td>
                                <div class="d-flex">
                                    <a class="btn btn-info me-2" href="{{ route('news.show', $item) }}">Show</a>
                                    <a class="btn btn-warning me-2" href="{{ route('news.edit', $item) }}">Edit</a>

                                    <form action="{{ route('news.destroy', $item) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12">
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
        </div>

    </div>

@endsection

@section('scripts')
    <script>
        let app_url = '{{ url('/') }}';
        let pagination_type = 'news';
    </script>
    <script src="{{ asset('admin/js/admin.js') }}?v=<?php echo filemtime(public_path('admin/js/admin.js'))?>"></script>
@endsection
