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
        <a href="{{ route('admin') }}">&larr;Back</a>
        <div class="d-flex align-items-center justify-content-between">
            <h1>Users</h1>
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create</a>
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
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->login}}</td>
                            <td>
                                <div class="d-flex">
                                <a class="btn btn-info me-2" href="{{ route('users.show', $user) }}">Show</a>
                                <a class="btn btn-warning me-2" href="{{ route('users.edit', $user) }}">Edit</a>
                                @if(Auth::user()->id !== $user->id)
                                    <form action="{{ route('users.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection
