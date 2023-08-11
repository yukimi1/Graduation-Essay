<div class="container card mt-5 mb-4">
    <div class="row justify-content-center">
        <div class="col-sm-auto text-center">
            <button class="border-0 bg-white" data-bs-toggle="modal" data-bs-target="#recent-comments">
                @if($user->avatar)
                    <img src="https://graduationessay.s3-ap-northeast-1.amazonaws.com/{{ $user->avatar }}" alt="" class="rounded-circle d-block mx-auto mt-4 img-lg">
                @else
                    <i class="fa-solid fa-circle-user text-secondary icon-lg d-block mt-4"></i>
                @endif
            </button>
            @include('users.posts.contents.modals.recent-comments')
        </div>
        <div class="col-sm">
            <div class="row justify-content-center mb-3">
                <div class="col-sm-auto text-center">
                    <h2 class="display-6 mb-0">{{ $user->name }}</h2>
                </div>
                <div class="col-sm-auto text-center p-2">
                    @if($user->id == Auth::user()->id)
                    <!-- edit profile -->
                        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-secondary fw-bold">Edit Profile</a>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-auto">
                    @if($user->essay_title)
                        <h3 class="text-center fw-bold">Essay Title </h3>
                        <h4 class="text-center">{{ $user->essay_title }}</h4>
                    @else
                        @if($user->id == Auth::user()->id)
                            <a href="{{ route('profile.edit') }}" class="text-decoration-none d-block text-center">Share your essay title to make other members know it.</a>
                        @endif
                    @endif
                </div>
            </div>
            <div class="row justify-content-center mb-3">
                <div class="col-auto">
                    @if($user->id == Auth::user()->id)
                        <span class="fw-bold">{{$user->posts->count()}}</span> {{ $user->posts->count() == 1 ? 'book' : 'books' }}
                    @else
                        <span class="fw-bold">{{count($posts)}}</span> {{ count($posts) == 1 ? 'book' : 'books' }}
                    @endif
                </div>
                <div class="col-auto">
                    @if($user->id == Auth::user()->id)
                        <span class="fw-bold">{{$user->likes->count()}}</span> {{ $user->likes->count() == 1 ? 'like' : 'likes' }}
                    @else
                        <span class="fw-bold">{{count($like_posts)}}</span> {{ count($like_posts) == 1 ? 'book' : 'likes' }}
                    @endif
                </div>
                @if($user->id == Auth::user()->id)
                    <div class="col-auto">
                        <span class="fw-bold">{{$user->favourites->count()}}</span> {{ $user->favourites->count() == 1 ? 'favourite' : 'favourites' }}
                    </div>
                @endif
            </div>
            <div class="row">
                @if($user->id == Auth::user()->id)
                    <div class="col-4">
                        <a href="{{ route('profile.show', $user->id) }}" class="btn btn-outline-success w-100">Book List</a>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('like.index', $user->id) }}" class="btn btn-outline-success w-100">Like List</a>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('favourite.index', $user->id) }}" class="btn btn-outline-success w-100">Favourite List</a>
                    </div>
                @else
                    <div class="col-6">
                        <a href="{{ route('profile.show', $user->id) }}" class="btn btn-outline-success w-100">Book List</a>
                    </div>
                    <div class="col-6">
                        <a href="{{ route('like.index', $user->id) }}" class="btn btn-outline-success w-100">Like List</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>