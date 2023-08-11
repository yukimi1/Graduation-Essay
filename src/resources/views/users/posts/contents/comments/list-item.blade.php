<div class="mb-2">
    <a href="{{ route('profile.show', $comment->user->id) }}" class="text-decoration-none text-dark fw-bold">
        {{ $comment->user->name }}
    </a>
    &nbsp;
    <span class="fw-light">{{ $comment->body }}</span>
    <br>
    <span class="text-muted small">{{ date('D, M d, Y', strtotime($comment->created_at)) }}</span>
    @if($comment->user_id == Auth::user()->id)
    &middot;
        <form action="{{ route('comment.delete', $comment->id) }}" method="post" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-danger small bg-transparent border-0 p-0">Delete</button>
        </form>
    @endif
</div>