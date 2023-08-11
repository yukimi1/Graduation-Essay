<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->search){
            $all_posts = $this->post
                                ->where('title', 'LIKE', '%'.$request->search.'%')
                                ->latest()->get();
        }else{
            $all_posts = $this->post->latest()->get();
        }

        $home_posts = [];
        foreach($all_posts as $post){
            if($post->publish_status == 1){
                $home_posts[] = $post;
            }
        }
        

        return view('users.home')->with('all_posts', $home_posts)
                                ->with('search', $request->search);
    }
}
