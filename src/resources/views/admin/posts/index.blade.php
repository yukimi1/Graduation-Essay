@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
<div class="col-2 ms-auto mb-4">
    <form action="{{ route('admin.posts') }}" method="get">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search for posts..." class="form-control form-control-sm">
    </form>
</div>
<table class="table border table-hover align-middle text-secondary">
    <thead class="table-primary small text-muted text-uppercase">
        <th></th>
        <th></th>
        <th>TITLE</th>
        <th>OWNER</th>
        <th>CREATED AT</th>
        <th>STATUS</th>
        <th></th>
    </thead>
    <tbody>
        @forelse($all_posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>
                    @if($post->image)
                        <img src="https://graduationessay.s3-ap-northeast-1.amazonaws.com/{{ $post->image }}" alt="" class="img-lg d-block mx-auto">
                    @else
                        <i class="fa-solid fa-book-open icon-lg text-primary text-opacity-50"></i>
                    @endif
                </td>
                <td>
                    <a href="" class="text-decoration-none text-dark">{{ $post->title }}</a>
                </td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->created_at }}</td>
                <td>
                    @if($post->trashed())
                        <i class="fa-solid fa-circle-minus"></i> Hidden 
                    @else
                        <i class="fa-solid fa-circle text-primary"></i> Visible
                    @endif
                </td>
                <td>
                    <div class="dropdown">
                        <button class="btn btn-sm" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-ellipsis"></i>
                        </button>
                        <div class="dropdown-menu">
                            @if($post->trashed())
                                <button class="dropdown-item text-primary" data-bs-toggle="modal" data-bs-target="#invisible-post{{ $post->id }}">
                                    <i class="fa-solid fa-eye"></i> Unhide Post {{ $post->id }}
                                </button>
                            @else
                                <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#invisible-post{{ $post->id }}">
                                    <i class="fa-solid fa-eye-slash"></i> Hide Post
                                </button>
                            @endif
                        </div>
                    </div>
                    @include('admin.posts.status')
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">No posts yet.</td>
            </tr>
        @endforelse
    </tbody>
</table>
{{ $all_posts->links() }}
@endsection







