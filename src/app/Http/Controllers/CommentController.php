<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function store(Request $request, $post_id)
    {
        $request->validate([
            'comment_body'.$post_id => 'required|max:200'
        ],[
            'comment_body'.$post_id.".required" => 'Cannot post an empty comment',
            'comment_body'.$post_id.".max" => 'Maximum of 200 characters only'
        ]);

        $this->comment->user_id = Auth::user()->id;
        $this->comment->user_id = Auth::user()->id;
        $this->comment->post_id = $post_id;
        $this->comment->body = $request->input('comment_body'.$post_id);
        $this->comment->save();

        return redirect()->back();
    }

    public function delete($comment_id)
    {
        $this->comment->destroy($comment_id);

        return redirect()->back();
    }
}
