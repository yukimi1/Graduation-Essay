<div class="modal fade" id="delete-post{{ $post->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h5 class="text-danger"><i class="fa-regular fa-trash-can"></i> Delete Book</h5>
            </div>
            <div class="modal-body">
                <p class="text-dark">Are you sure you want to delete this book?</p>
                <h4 class="text-dark">{{ $post->title }}</h4>
                <p class="text-dark">{{ $post->author }}</p>
            </div>
            <div class="modal-footer border-0">
                <form action="{{ route('post.delete', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-danger">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>