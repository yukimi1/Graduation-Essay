<div class="modal fade" id="like-post{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button data-bs-dismiss="modal" class="ms-auto border-0 p-0 text-primary">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-8">
                        @foreach($post->likes as $like)
                            <div class="row align-items-center mb-2">
                                <div class="col-auto">
                                    <a href="{{ route('profile.show', $like->user->id) }}" class="text-decoration-none text-dark">
                                        @if($like->user->avatar)
                                            <img src="{{ asset('/storage/avatars/'.$like->user->avatar) }}" alt="" class="rounded-circle avatar-sm">
                                        @else
                                            <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                                        @endif
                                    </a>
                                </div>
                                <div class="col ps-0 text-truncate">
                                    <a href="{{ route('profile.show', $like->user->id) }}" class="text-decoration-none text-dark">
                                        {{ $like->user->name }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>