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
        <a href="{{ url()->previous() }}">&larr;Back</a>
        <h1>@if($edit)Edit news @else Create news @endif</h1>

        <div class="row">
            <div class="col-4">
                <form method="POST" action="@if($edit){{ route('news.update', $news) }}@else{{ route('news.store') }}@endif" enctype='multipart/form-data'>
                    @csrf
                    @if($edit)
                    @method('PUT')
                    @endif
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
                               id="name" name="name" required autocomplete="name" value="{{ old('name') ?? $news->name }}">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror"
                                  id="description" rows="3" required name="description">{{ old('description') ?? $news->description }}</textarea>
                        @error('description')
                        <span class="invalid-feedback mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <select id="author" class="form-select @error('description') is-invalid @enderror" name="author" aria-label="Default select example">
                            <option selected disabled>Select author</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" @if($user->id == $news->author) selected @endif>{{ $user->login }}</option>
                            @endforeach
                        </select>
                        @error('author')
                        <span class="invalid-feedback mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" type="file" id="formFile" name="image"
                        @if(!$edit) required @endif>
                        <small>*jpg,png,webp (max size: 5mb)</small>

                        @if (Str::startsWith($news->image, 'newsImage/'))
                            <img id="image" src="{{ asset('storage/'.$news->image) }}" alt="{{ $news->name }}" class="img-fluid mb-2">
                        @else
                            <img id="image" src="{{ asset('img/'.$news->image) }}" alt="{{ $news->name }}" class="img-fluid mb-2">
                        @endif
                        @error('image')
                        <span class="invalid-feedback mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">@if($edit) Save @else Create @endif</button>
                </form>
            </div>
        </div>

    </div>

@endsection

@section('scripts')
    <script>
        $('#formFile').on('change', function (event) {
            let input = event.target;

            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function (e) {
                    $('#image').attr('src', e.target.result).show();
                };

                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection
