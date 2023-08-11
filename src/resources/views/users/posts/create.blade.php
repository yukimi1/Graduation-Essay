@extends('layouts.app')

@section('title', 'Create Book')

@section('content')
    <form action="{{ route('post.store') }}" method="post" class="shadow rounded-3 px-0 pt-5 bg-white mt-5" enctype="multipart/form-data">
        @csrf

        <div class="container">
            <div class="row justify-content-center">
                <!-- left side -->
                <div class="col-sm-5">
                    <label for="title" class="form-label fw-bold">Title</label>
                    <input type="text" name="title" id="title" class="form-control">
                    @error('title')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <label for="author" class="form-label fw-bold mt-3">Author</label>
                    <input type="text" name="author" id="author" class="form-control">
                    @error('author')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <label for="description" class="form-label fw-bold mt-3">Description</label>
                    <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                    @error('description')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <label for="memo" class="form-label fw-bold mt-3">Memo</label>
                    <textarea name="memo" id="memo" rows="3" class="form-control"></textarea>
                    @error('memo')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <label for="image" class="form-label fw-bold mt-3">Image</label>
                    <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
                    <p class="form-text" id="image-info">
                        Acceptable formats: jpeg, jpg, png, gif only<br>
                        Max size is 2000 kb
                    </p>
                    @error('image')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <!-- right side -->
                <div class="col-sm-4">
                    <p class="fw-bold">Category <span class="fw-normal text-muted">(uo to 3)</span></p>
                    <div>
                        @foreach($all_categories as $category)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="category[]" value="{{$category->id}}" id="{{$category->name}}" class="form-check-input">
                                <label for="{{$category->name}}" class="form-check-label">{{ $category->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    @error('category')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <label for="reading_status" class="form-label fw-bold mt-4">Reading Status</label>
                    <select name="reading_status" id="reading_status" class="form-select">
                        <option value="0" hidden>Select reading status</option>
                        <option value="1">Done</option>
                        <option value="2">Almost</option>
                        <option value="3">Reading</option>
                    </select>
                    @error('reading_status')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <label for="book_status" class="form-label fw-bold mt-4">Book Owner</label>
                    <select name="book_status" id="book_status" class="form-select">
                        <option value="0" hidden>Select </option>
                        <option value="1">Local library</option>
                        <option value="2">Komazawa library</option>
                        <option value="3">Yours</option>
                    </select>
                    @error('book_status')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                    <div class="form-check form-check-inline mt-4">
                        <input type="radio" name="publish_status" value="1" class="form-check-input" id="publish_status1" checked>
                        <label for="publish_status1" class="form-check-label">Publish</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" name="publish_status" value="2" class="form-check-input" id="publish_status2">
                        <label for="publish_status2" class="form-check-label">Unpublish</label>
                    </div>

                    <button type="submit" class="btn btn-primary px-4 mt-5 w-100">Post</button>
                </div>
            </div>
        </div>
    </form>
@endsection