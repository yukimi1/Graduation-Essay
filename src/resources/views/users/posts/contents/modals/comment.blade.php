<style>
    .modal-body{
        height: 300px;
        overflow-y: scroll;
    }
</style>
<div class="modal fade" id="comments{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="text-secondary">Comments</h5>
                <button class="border-0" data-bs-dismiss="modal"><i class="fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body">
                @foreach($post->comments as $comment)
                    @include('users.posts.contents.comments.list-item')
                @endforeach
            </div>
            <div class="modal-footer">
                @include('users.posts.contents.comments.create')
            </div>
        </div>
    </div>
</div>