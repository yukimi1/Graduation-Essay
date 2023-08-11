<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    private $category;
    private $post;

    public function __construct(Category $category, Post $post)
    {
        $this->category = $category;
        $this->post = $post;
    }

    public function index()
    {
        $all_categories = $this->category->orderBy('name', 'asc')->get();

        $all_posts = $this->post->all();
        $uncategorized_count = 0;
        foreach($all_posts as $post){
            if($post->categoryPosts->count() == 0){
                $uncategorized_count++;
            }
        }

        return view('admin.categories.index')->with('all_categories', $all_categories)
                                            ->with('uncategorized_count', $uncategorized_count);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50|unique:categories,name'
        ]);

        $this->category->name = $request->name;
        $this->category->save();

        return redirect()->back();
    }

    public function update(Request $request, $category_id)
    {
        $request->validate([
            'category_name'.$category_id => 'required|max:50|unique:categories,name,' .$category_id
        ]);

        $category = $this->category->findOrFail($category_id);
        $category->name = $request->input('category_name'.$category_id);
        $category->save();       

        return redirect()->back();
    }

    public function delete($category_id)
    {
        $this->category->destroy($category_id);

        return redirect()->back();
    }
}
