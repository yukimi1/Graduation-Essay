<div class="modal fade" id="delete-category{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom border-danger">
                <h5 class="text-dark">
                    <i class="fa-solid fa-trash-can"></i> Delete Category
                </h5>
                <div class="modal-body">
                    Are you sure you want to delete <strong>{{ $category->name }}</strong> category?
                    <br>
                    <br>
                    This action will affect all the posts under this category. Posts without a category will fail under Uncategorized.
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.categories.delete', $category->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-danger">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-category{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom border-danger">
                <h5 class="text-dark">
                    <i class="fa-regular fa-pen-to-square"></i> Edit Category
                </h5>
            </div>
            <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                <div class="modal-body">
                    
                    <input type="text" name="category_name{{ $category->id }}" value="{{ $category->name }}" class="form-control">
                    @error('category_name'.$category->id)
                    <p>{{ $message }}</p>
                    @enderror
                </div>
                <div class="modal-footer">
                    @csrf
                    @method('PATCH')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-warning">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-warning">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>