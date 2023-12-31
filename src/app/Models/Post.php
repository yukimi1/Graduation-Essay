<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    public function categoryPosts() 
    {
        return $this->hasMany(CategoryPost::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLiked()
    {
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }

    public function userIsLiked($id)
    {
        return $this->likes()->where('user_id', $id)->exists();
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function inFavouriteList()
    {
        return $this->favourites()->where('user_id', Auth::user()->id)->exists();
    }
}
