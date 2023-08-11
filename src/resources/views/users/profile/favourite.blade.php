@extends('layouts.app')

@section('title', 'Profile Favourite')

@section('content')
    <a href="{{ route('home') }}" class="text-decoration-none">Graduation essay</a> / {{ $user->name }} / Favourite List
    @include('users.profile.header')
    <!-- favourite -->
    <div class="row justify-content-center">
        <div class="col-11">
            @forelse($all_posts as $post)
                @if($post->inFavouriteList())
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
                @endif
            @empty
            @endforelse
        </div>
    </div>
@endsection