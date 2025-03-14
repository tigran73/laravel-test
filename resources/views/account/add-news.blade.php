@extends('layouts.default')

@section('title')
    Add news - Account
@endsection

@section('meta_desc')
    <meta name="title" content="Add news - Account">
    <meta name="description" content="Add news - Account">
    <meta name="keywords" content="Add news - Account">
@endsection

@section('content')
    <div class="container py-5">
        <h1>Add news</h1>


        <div class="row">
            <div class="col-4">
                <form method="POST" action="{{ route('storeNews') }}" enctype='multipart/form-data'>
                    @csrf
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
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                               id="name" name="name" required autocomplete="name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" rows="3" name="description"></textarea>
                        @error('description')
                        <span class="invalid-feedback mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="formFile" name="image">
                        <small>*jpg,png,webp (max size: 5mb)</small>
                        @error('image')
                        <span class="invalid-feedback mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Save</button>
                </form>
            </div>
        </div>
    </div>

@endsection
