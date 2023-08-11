<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;

class ProfileController extends Controller
{
    private $user;
    private $post;

    public function __construct(User $user, Post $post)
    {
        $this->user = $user;
        $this->post = $post;
    }

    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        $posts = [];
        foreach($user->posts as $post){
            if($user->id == Auth::user()->id){
                $posts[] = $post;
            }else{
                if($post->publish_status == 1){
                    $posts[] = $post;
                }
            }
        }

        // for like
        $all_posts = $this->post->latest()->get();

        $posts_for_like = [];
        foreach($all_posts as $post){
            if($user->id == Auth::user()->id){
                $posts_for_like[] = $post;
            }else{
                if($post->publish_status == 1){
                    $posts_for_like[] = $post;
                }
            }
        }

        $like_posts = [];
        foreach($posts_for_like as $post){
            if($post->userIsLiked($user->id)){
                $like_posts[] = $post;
            }
        }

        return view('users.profile.show')->with('user', $user)
                                        ->with('posts', $posts)
                                        ->with('like_posts', $like_posts);
    }

    public function edit()
    {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profile.edit')->with('user', $user);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:50|unique:users,email,'.Auth::user()->id,
            'essay_title' => 'max:100',
            'avatar' => 'max:2000|mimes:jpeg,jpg,png,gif'
        ]);

        $user = $this->user->findOrFail(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->essay_title = $request->essay_title;

        if($request->avatar){
            if($user->avatar){
                if(Storage::disk('s3')->exists($user->avatar))
                {
                    Storage::disk('s3')->delete($user->avatar);
                }
            }

            $path = Storage::disk('s3')->putFile('/images', $request->avatar, 'public');

            $user->avatar = $path;
        }
        $user->save();

        return redirect()->route('profile.show', Auth::user()->id);
    }

    public function changePassword(Request $request)
    {
        $user_a = $this->user->findOrFail(Auth::user()->id);
        // check if old password is correct
        if(!Hash::check($request->old_password, $user_a->password)){
            // validation error
            return redirect()->back()->with('old_password_error', 'Wrong password. Try again.');
        }
        // check if new password is not the same as old
        if($request->old_password == $request->new_password){
            // validation error
            return redirect()->back()->with('same_password_error', 'New password cannot be the same as old password.');
        }
        // confirm new password (same as passwords)
        $request->validate([
            'new_password' => 'required|string|confirmed'
            // string - input is in letters and numbers
            // confirmed - for confirming passwords / you need two input field if you want to 
        ]);

        $user_a->password = Hash::make($request->new_password);
        $user_a->save();

        return redirect()->back()->with('success_message', 'Password changed successfully!');
    }
}
