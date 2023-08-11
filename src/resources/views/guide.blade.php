<div class="modal fade" id="guide">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border">
                <h4>How to use</h4>
                <button data-bs-dismiss="modal" class="ms-auto border-0 p-0 text-primary">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <div class="modal-body">
                <span class="h5 border-bottom">Create an account and login</span>
                <p>Click <a href="{{ route('register') }}" class="text-decoration-none">Register</a> or <a href="{{ route('register') }}" class="text-decoration-none">Get Staarted</a> to create an account and then you can log in by clicking <a href="{{ route('login') }}" class="text-decoration-none">Login</a>.</p>
                <span class="h5 border-bottom">Record a book</span>
                <p>Click the book icon <i class="fa-solid fa-book text-success"></i> at the top of screen. You can record a book. 
                    <br> <span class="text-muted">* Title and Author fields are required.</span>
                </p>
                <span class="h5 border-bottom">Edit book information</span>
                <p>Click this icon <i class="fa-solid fa-ellipsis text-success"></i>. You can find <span class="text-primary">Edit</span>.</p>
            </div>
        </div>
    </div>
</div>