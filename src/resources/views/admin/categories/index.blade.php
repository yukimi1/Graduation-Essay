@extends('layouts.app')

@section('title', 'Admin: Categories')

@section('content')
    <form action="{{ route('admin.categories.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-4">
                <input type="text" name="name" class="form-control" placeholder="Add a category">
            </div>
            <div class="col-2 ps-0">
                <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</button>
            </div>
        </div>
    </form>
    <table class="table table-sm border table-hover align-middle text-secondary mt-5">
        <thead class="table-warning small text-muted text-uppercase">
            <th>#</th>
            <th>NAME</th>
            <th>COUNT</th>
            <th>LASTUPDATED</th>
            <th></th>
        </thead>
        <tbody>
            @forelse($all_categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->categoryPosts->count() }}</td>
                    <td>{{ $category->updated_at }}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-warning me-2" data-bs-toggle="modal" data-bs-target="#edit-category{{ $category->id }}"><i class="fa-solid fa-pen"></i></button>
                        <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#delete-category{{ $category->id }}"><i class="fa-solid fa-trash-can"></i></button>
                        @include('admin.categories.modals')
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No categories yet.</td>
                </tr>
            @endforelse
            <tr>
                <td>0</td>
                <td>Uncategorized</td>
                <td>{{ $uncategorized_count }}</td>
            </tr>
        </tbody>
    </table>
@endsection