<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;

class LikeController extends Controller
{
    private $like;
    private $post;
    private $user;

    public function __construct(Like $like, Post $post, User $user)
    {
        $this->like = $like;
        $this->post = $post;
        $this->user = $user;
    }

    public function store($post_id)
    {
        $this->like->user_id = Auth::user()->id;
        $this->like->post_id = $post_id;
        $this->like->save();

        return redirect()->back();
    }

    public function delete($post_id)
    {
        $this->like
            ->where('user_id', Auth::user()->id)
            ->where('post_id', $post_id)
            ->delete();

            return redirect()->back();
    }

    public function index($id)
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

        return view('users.profile.like')->with('user', $user)
                                        ->with('posts', $posts)
                                        ->with('like_posts', $like_posts);
    }
}
