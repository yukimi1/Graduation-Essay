@if(!$post->trashed())
    <div class="modal fade" id="invisible-post{{ $post->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom border-danger">
                    <h5 class="text-danger">
                        <i class="fa-solid fa-eye-slash"></i> Hide Post {{ $post->id }}
                    </h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to hide this post?
                    <div class="mt-1">
                        <img src="https://graduationessay.s3-ap-northeast-1.amazonaws.com/{{ $post->image }}" alt="" class="img-lg">
                    </div>
                    {{ $post->description }}
                </div>
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.posts.hide', $post->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-danger">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger">Hide</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="modal fade" id="invisible-post{{ $post->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom border-primary">
                    <h5 class="text-primary">
                        <i class="fa-solid fa-eye"></i> Unhide Post {{ $post->id }}
                    </h5>
                </div>
                <div class="modal-body">
                    Are you sure you want to unhide this post?
                    <div class="mt-1">
                        <img src="https://graduationessay.s3-ap-northeast-1.amazonaws.com/{{ $post->image }}" alt="" class="img-lg">
                    </div>
                    {{ $post->description }}
                </div>
                <div class="modal-footer border-0">
                    <form action="{{ route('admin.posts.unhide', $post->id) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-primary">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary">Unhide</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
