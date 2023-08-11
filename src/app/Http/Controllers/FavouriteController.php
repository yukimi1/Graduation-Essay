<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favourite;
use App\Models\Post;
use App\Models\User;

class FavouriteController extends Controller
{
    private $favourite;
    private $post;
    private $user;

    public function __construct(Favourite $favourite, Post $post, User $user)
    {
        $this->favourite = $favourite;
        $this->post = $post;
        $this->user = $user;
    }

    public function store($post_id)
    {
        $this->favourite->user_id = Auth::user()->id;
        $this->favourite->post_id = $post_id;
        $this->favourite->save();

        return redirect()->back();
    }

    public function delete($post_id)
    {
        $this->favourite
            ->where('user_id', Auth::user()->id)
            ->where('post_id', $post_id)
            ->delete();

            return redirect()->back();
    }

    public function index($id)
    {
        $user = $this->user->findOrFail($id);

        $all_posts = $this->post->latest()->get();

        return view('users.profile.favourite')->with('user', $user)
                                        ->with('all_posts', $all_posts);
    }
}
