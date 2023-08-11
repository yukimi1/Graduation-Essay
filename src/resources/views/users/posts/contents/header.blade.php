<div class="card-header bg-white py-1">
    <div class="row align-items-center">
        <div class="col-auto">
            <a href="{{ route('profile.show', $post->user->id) }}">
                @if($post->user->avatar)
                    <img src="https://graduationessay.s3-ap-northeast-1.amazonaws.com/{{ $post->user->avatar }}" alt="" class="rounded-circle avatar-sm">
                @else
                    <i class="fa-solid fa-circle-user icon-sm text-secondary"></i>
                @endif
            </a>
        </div>
        <div class="col ps-0">
            <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none text-dark">
                {{ $post->user->name }}
            </a>
        </div>
        <div class="col-auto">
            <div class="dropdown">
                <button class="btn btn-sm" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-ellipsis"></i>
                </button>

                <div class="dropdown-menu">
                    <!-- edir and delete -->
                    @if($post->user_id == Auth::user()->id)
                        <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                            <i class="fa-regular fa-pen-to-square"></i> Edit
                        </a>
                        <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#delete-post{{ $post->id }}">
                            <i class="fa-regular fa-trash-can"></i> Delete
                        </button>
                    @endif
                    <button class="btn dropdown-item" data-bs-toggle="modal" data-bs-target="#comments{{ $post->id }}">
                        <i class="fa-regular fa-comment"></i> Comment
                    </button>
                </div>
                @include('users.posts.contents.modals.delete')
                @include('users.posts.contents.modals.comment')
            </div>
        </div>
    </div>
</div>