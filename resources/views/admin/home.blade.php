@extends('layouts.default')

@section('title')
    Admin Panel
@endsection

@section('meta_desc')
    <meta name="title" content="Admin Panel">
    <meta name="description" content="Admin Panel">
    <meta name="keywords" content="Admin Panel">
@endsection

@section('content')
    <div class="container py-5">
        <h1>Admin Panel</h1>

        <h4>Dashboard:</h4>

        <div class="row mb-5">
            <div class="col-6">
                <h5>Top News</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Views</th>
                        <th scope="col">Author</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topNews as $key=>$item)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>
                                <a href="{{ route('news.detail', ['id' => $item->id]) }}"
                                   target="_blank">{{$item->name}}</a>
                            </td>
                            <td>{{$item->views}}</td>
                            <td>{{ $item->authorUser->login  }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-6">
                <h5>Top Authors</h5>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($topAuthors as $key=>$item)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>
                                {{$item->authorUser->login}}
                            </td>
                            <td>{{ $item->news_count  }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <h4>Actions:</h4>
        <ul class="list-unstyled">
            @if(Auth::user()->hasRole('content-manager'))
                <li><a href="{{ route('addNews') }}">Add news</a></li>
            @endif
            @if(Auth::user()->hasRole('content-manager'))
                <li><a href="{{ route('addNews') }}">Add news</a></li>
            @endif
            <li><a href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </div>

@endsection
