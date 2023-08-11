<style>
    .modal-body{
        height: 300px;
        overflow-y: scroll;
    }
</style>
<div class="modal fade" id="recent-comments">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom">
                <h5 class="text-secondary">Recent Comments</h5>
            </div>
            <div class="modal-body">
                @foreach($user->comments->take(5) as $comment)
                    <div class="row border border-primary mb-2 py-3">
                        <div class="text-secondary border-bottom fw-bold">
                            {{ $comment->body }}
                        </div>
                        <div class="text-secondary fw-bold">
                            Replied to <a href="{{ route('profile.show', $comment->post->user->id) }}" class="text-decoration-none fw-bold">{{ $comment->post->user->name }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer border-0">
                <button class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>