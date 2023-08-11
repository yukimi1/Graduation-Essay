@extends('layouts.app')

@section('title', 'Profile Edit')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-sm-9">
                <form action="{{ route('profile.update') }}" method="post" class="shadow rounded-3 p-5 bg-white mb-5 w-100" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <h2 class="h3 fw-light mb-3 text-muted">Update Profile</h2>

                    <div class="row mb-3">
                        <div class="col-sm-auto mb-3">
                            @if(Auth::user()->avatar)
                                <img src="https://graduationessay.s3-ap-northeast-1.amazonaws.com/{{ $user->avatar }}" alt="" class="rounded-circle img-lg d-block mx-auto">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-lg d-block text-center"></i>
                            @endif
                        </div>
                        <div class="col-sm align-self-end mb-3">
                            <input type="file" name="avatar" id="" class="form-control form-control-sm" aria-describedby="avatar-info">
                            <div class="form-text" id="avatar-info">
                                Acceptable formats: jpeg, jpg, png, gif only <br>
                                Max file size: 2000 KB
                            </div>
                            @error('avatar')
                                <p class="text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <label for="name" class="form-label fw-bold">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" id="name" class="form-control">
                    @error('name')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror

                    <label for="email" class="form-label fw-bold mt-3">Email</label>
                    <input type="text" name="email" value="{{ old('email', $user->email) }}" id="email" class="form-control">
                    @error('email')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror

                    <label for="essay_title" class="form-label fw-bold mt-3">Essay Title</label>
                    <textarea name="essay_title" id="essay_title" rows="3" class="form-control">{{ old('introduction', $user->essay_title) }}</textarea>
                    @error('essay_title')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="btn btn-warning px-4 mt-4">Save</button>
                </form>

                <!-- update password -->
                <form action="{{ route('profile.change-password') }}" method="post" class="shadow bg-white rounded-3 p-5 my-4">
                    @csrf
                    @method('PATCH')

                    @if(session('success_message'))
                        <p class="text-success fw-bold">{{ session('success_message') }}</p>
                    @endif

                    <h2 class="h3 text-muted fw-light mb-3">Update Password</h2>

                    <label for="old-password" class="form-label fw-bold">Old Password</label>
                    <input type="password" name="old_password" id="old-password" class="form-control">
                    @if(session('old_password_error'))
                        <p class="text-danger small">{{ session('old_password_error') }}</p>
                    @endif

                    <label for="new-password" class="form-label fw-bold mt-3">New Password</label>
                    <input type="password" name="new_password" id="new-password" class="form-control">
                    @if(session('same_password_error'))
                        <p class="text-danger small">{{ session('same_password_error') }}</p>
                    @endif

                    <label for="new-password-confirmation" class="form-label fw-bold mt-3">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" id="new-password-confirmation" class="form-control">
                    @error('new_password')
                        <p class="text-danger small">{{ $message }}</p>
                    @enderror

                    <button type="submit" class="btn btn-warning mt-4 px-4">Update Password</button>
                </form>
            </div>
        </div>
    </div>
@endsection