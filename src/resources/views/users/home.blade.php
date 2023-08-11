@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row gx-5 justify-content-center mt-5">
    <div class="col-11">
        <div class="row mb-4">
            <div class="col">
                @if($search)
                    <h3 class="h5 text-muted">Search results for '<strong>{{ $search }}</strong>'</h3>
                @endif
            </div>
            <div class="col-auto">
                <form action="{{ route('home') }}" method="get" class="bg-white">
                    @csrf

                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search for title...">
                        <button type="submit" class="btn btn-outline-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
            </div>
        </div>
        @forelse($all_posts as $post)
            @if(!$post->user->trashed())
                <div class="card mb-4">
                    <!-- card-header -->
                    @include('users.posts.contents.header')
                    <!-- card-body -->
                    <div class="container card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <!-- image or icon -->
                                <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none">
                                    @if($post->image)
                                        <img src="https://graduationessay.s3-ap-northeast-1.amazonaws.com/{{ $post->image }}" alt="" class="img-home shadow rounded-1">
                                    @else
                                        <div class="text-center">
                                        <i class="fa-solid fa-book-open icon-lg text-primary text-opacity-50"></i>
                                        </div>
                                        <div class="text-center text-dark">No image</div>
                                    @endif
                                </a>
                            </div>
                            <div class="col-md">
                                @include('users.posts.contents.body')
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center">
                <h2 class="text-primary">Share Books</h2>
                <p class="text-muted">When you share books, they will appear on your page.</p>
                <a href="{{ route('post.create') }}" class="text-decoration-none">Share your book</a>
            </div>
        @endforelse
    </div>
</div>
@endsection