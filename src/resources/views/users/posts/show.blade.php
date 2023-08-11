@extends('layouts.app')

@section('title', 'Show Book')

@section('content')
    <a href="{{ route('home') }}" class="text-decoration-none">Graduation essay</a> / {{ $post->title }}
    <div class="container">
        <div class="row border shadow bg-white mt-5">  
            <div class="col p-1 text-center">
                <!-- image or icon -->
                @if($post->image)
                    <img src="https://graduationessay.s3-ap-northeast-1.amazonaws.com/{{ $post->image }}" alt="" class="img-home shadow rounded-1">
                @else
                    <i class="fa-solid fa-book-open icon-md text-primary text-opacity-50"></i>
                    <div class="text-center text-dark">No image</div>
                @endif
            </div>
            <div class="col-sm-6 p-0 ps-1 border-end">
                @include('users.posts.contents.body')
            </div>             
            <div class="comment col-sm-4 px-0 bg-white">
                <!-- Book Info -->
                <div class="card border-0">
                    @include('users.posts.contents.header')
                    <!-- comment -->
                    <div class="comment-body card-body">
                        @include('users.posts.contents.comments.create')
                        <div class="comment mt-3">
                            @foreach($post->comments as $comment)
                                @if(!$comment->user->trashed())
                                    @include('users.posts.contents.comments.list-item')
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($post->user->id == Auth::user()->id)
    <div class="row mt-3">
        <div class="col-11">
            <h4 class="fw-bold">Memo</h4>

            <form action="{{ route('post.updateMemo', $post->id) }}" method="post">
                @csrf
                @method('PATCH')

                <textarea name="memo" cols="30" rows="10" class="form-control mb-4 shadow">{{ $post->memo }}</textarea>
                <div class="text-center">
                    <button class="btn btn-primary">Save memo</button>
                </div>
            </form>
        </div>
    </div>
    @endif
@endsection


