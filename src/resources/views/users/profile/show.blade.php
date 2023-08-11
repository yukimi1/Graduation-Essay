@extends('layouts.app')

@section('title', 'Profile Show')

@section('content')
    <a href="{{ route('home') }}" class="text-decoration-none">Graduation essay</a> / {{ $user->name }} / Book List
    @include('users.profile.header')
    <!-- books -->
    <div class="row justify-content-center">
        <div class="col-11">
            @forelse($posts as $post)
                <div class="card mb-4">
                    <!-- card-header -->
                    @include('users.posts.contents.header')
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <!-- image or icon -->
                                <a href="{{ route('post.show', $post->id) }}">
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
                            <div class="col-sm">
                                @include('users.posts.contents.body')
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                @if($user->id == Auth::user()->id)
                    <div class="text-center mb-4">
                        <h2 class="text-primary">Share Books</h2>
                        <p class="text-muted">When you share books, they will appear on your page.</p>
                        <a href="{{ route('post.create') }}" class="text-decoration-none">Share your book</a>
                    </div>
                @endif
            @endforelse
        </div>
    </div>
@endsection