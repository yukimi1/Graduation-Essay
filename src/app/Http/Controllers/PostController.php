<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    private $post;
    private $category;

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function create()
    {
        $all_categories = $this->category->all();

        return view('users.posts.create')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:60',
            'author' => 'required|max:50',
            'description' => 'max:1000',
            'memo' => 'max:1000',
            'category' => 'array|between:1,3',
            'reading_status' => 'required',
            'book_status' => 'required',
            'image' => 'max:2000|mimes:jpeg,jpg,png,gif'
        ]);

        $this->post->title = $request->title;
        $this->post->author = $request->author;
        $this->post->description = $request->description;
        $this->post->memo = $request->memo;
        $this->post->reading_status = $request->reading_status;
        $this->post->book_status = $request->book_status;
        $this->post->publish_status = $request->publish_status;
        $this->post->user_id = Auth::user()->id;
        if($request->image)
        {
            $path = Storage::disk('s3')->putFile('/images', $request->image, 'public');

            $this->post->image = $path;
        }
        $this->post->save();

        if($request->category)
        {
            $category_posts = [];
            foreach($request->category as $category_id)
            {
                $category_posts[] = ['category_id' => $category_id];
            }

            $this->post->categoryPosts()->createMany($category_posts);
        }

        return redirect()->route('home');
    }

    public function delete($post_id)
    {
        $post = $this->post->findOrFail($post_id);
        
        if(Storage::disk('s3')->exists($post->image))
        {
            Storage::disk('s3')->delete($post->image);
        }

        $post->forceDelete();

        return redirect()->route('home');
    }

    public function show($post_id)
    {
        $post = $this->post->findOrFail($post_id);

        return view('users.posts.show')->with('post', $post);
    }

    public function edit($post_id)
    {
        $post = $this->post->findOrFail($post_id);

        if($post->user_id != Auth::user()->id)
        {
            return redirect()->route('home');
        }

        $all_categories = $this->category->all();

        $selected_categories = [];
        foreach($post->categoryPosts as $category_post)
        {
            $selected_categories[] = $category_post->category_id;
        }

        return view('users.posts.edit')->with('post', $post)
                                    ->with('all_categories', $all_categories)
                                    ->with('selected_categories', $selected_categories);
    }

    public function update(Request $request, $post_id)
    {
        $request->validate([
            'title' => 'required|max:60',
            'author' => 'required|max:50',
            'description' => 'max:1000',
            'memo' => 'max:1000',
            'category' => 'array|between:1,3',
            'reading_status' => 'required',
            'book_status' => 'required',
            'image' => 'max:2000|mimes:jpeg,jpg,png,gif'
        ]);

        $post = $this->post->findOrFail($post_id);
        $post->title = $request->title;
        $post->author = $request->author;
        $post->description = $request->description;
        $post->memo = $request->memo;
        $post->reading_status = $request->reading_status;
        $post->book_status = $request->book_status;
        $post->publish_status = $request->publish_status;
        
        if($request->image){
            if($post->image){
                if(Storage::disk('s3')->exists($post->image))
                {
                    Storage::disk('s3')->delete($post->image);
                }
            }

            $path = Storage::disk('s3')->putFile('/images', $request->image, 'public');

            $post->image = $path;
        }
        $post->save();

        $post->categoryPosts()->delete();

        if($request->category){
            $category_posts = [];
            foreach($request->category as $category_id){
                $category_posts[] = ['category_id' => $category_id];
            }
            $post->categoryPosts()->createMany($category_posts);
        }

        return redirect()->route('post.show', $post_id);
    }

    public function updateMemo(Request $request, $post_id)
    {
        $request->validate([
            'memo' => 'max:1000'
        ]);

        $post = $this->post->findOrFail($post_id);
        $post->memo = $request->memo;
        $post->save();

        return redirect()->back();
    }
}
