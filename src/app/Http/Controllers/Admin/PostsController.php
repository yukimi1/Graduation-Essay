<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function index(Request $request)
    {
        // if($request->search){
        //     $all_posts = $this->post->where('title', 'LIKE', '%'.$request->search.'%')->withTrashed()->latest()->paginate(10);
        // }else{
        //     $all_posts = $this->post->withTrashed()->latest()->paginate(10);
        // }

        if($request->search)
        {
            $all_posts = $this->post->where('description', 'LIKE', '%'.$request->search.'%')->withTrashed()->latest()->paginate(10);
        }else{
            $all_posts = $this->post->withTrashed()->latest()->paginate(10);
        }

        return view('admin.posts.index')->with('all_posts', $all_posts)
                                        ->with('search', $request->search);
    }

    public function status($post_id)
    {
        $post = $this->post->findOrFail($post_id);

        return view('admin.posts.status')->with('post',$post);
    }

    public function hide($post_id)
    {
        $this->post->destroy($post_id);

        return redirect()->back();
    }

    public function unhide($post_id)
    {
        $this->post->onlyTrashed()->findOrFail($post_id)->restore();

        return redirect()->back();
    }
}
