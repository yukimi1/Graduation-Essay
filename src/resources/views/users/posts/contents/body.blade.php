<div class="row">
    <div class="col">
        <div class="row">
            <div class="col">
                <span>Title: <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none h3 fw-bold">{{ $post->title }}</a></span>
                <br>
                <p class="m-0 p-0">Author: <span class="text-dark h5">{{ $post->author }}</span></p>
                @if($post->description)
                    <div>Description: {{ $post->description }}</div>
                @endif
                <span>Owner: 
                    @if($post->book_status == 1)
                        Local Library   
                    @elseif($post->book_status == 2)
                        Komazawa Library  
                    @elseif($post->book_status == 3)
                        It belongs to {{ $post->user->name }}.
                    @else
                        Undefined
                    @endif
                </span>
                <br>
                <span>Reading Status: 
                    @if($post->reading_status == 1)
                        {{ $post->user->name }} already has read it!
                    @elseif($post->reading_status == 2)
                        {{ $post->user->name }} is almost done.
                    @elseif($post->reading_status == 3)
                        {{ $post->user->name }} is reading it.
                    @else
                        Undisclosed
                    @endif
                </span>
                <br>
                @forelse($post->categoryPosts as $category_post)
                    <div class="badge bg-primary bg-opacity-50 mb-3">{{ $category_post->category->name }}</div>
                @empty
                    <div class="badge bg-secondary bg-opacity-50 mb-3">Uncategorized</div>
                @endforelse
            </div>
            <!-- like button -->
            <div class="col-auto px-0 mt-1">
                <div class="mb-1">
                    @if($post->isLiked())
                        <form action="{{ route('like.delete', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="border-0 shadow-none bg-transparent p-0 text-danger">
                                <i class="fa-solid fa-heart"></i>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('like.store', $post->id) }}" method="post">
                            @csrf
                            <button type="submit" class="border-0 shadow-none bg-transparent p-0">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </form>  
                    @endif
                </div>
                <div>
                    @if($post->inFavouriteList())
                        <form action="{{ route('favourite.delete', $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="border-0 shadow-none bg-transparent p-0 text-warning">
                                <i class="fa-solid fa-star"></i>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('favourite.store', $post->id) }}" method="post">
                            @csrf
                            <button type="submit" class="border-0 shadow-none bg-transparent p-0">
                                <i class="fa-regular fa-star"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            <!-- the number of likes -->
            <div class="col-auto me-2 mt-1">
                @if($post->likes()->count() == 0)
                    <span>0</span>
                @else
                    <button class="btn border-0 p-0" data-bs-toggle="modal" data-bs-target="#like-post{{ $post->id }}">
                        {{ $post->likes()->count() }}
                    </button>
                    @include('users.posts.contents.modals.likes')
                @endif
            </div>
        </div>
    </div>
</div>