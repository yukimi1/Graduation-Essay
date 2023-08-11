<div class="mt-1">
    <form action="{{ route('comment.store', $post->id) }}" method="post">
        @csrf
        <div class="input-group">
            <textarea name="comment_body{{ $post->id }}" rows="1" class="form-control" placeholder="Add a comment..."></textarea>
            <button type="submit" class="btn btn-sm btn-outline-secondary">Post</button>
        </div>
        @error('comment_body'.$post->id)
            <p class="text-danger small">{{ $message }}</p>
        @enderror
    </form>
</div>