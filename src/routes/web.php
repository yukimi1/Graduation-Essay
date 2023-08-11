<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\UsersController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'home'])->name('welcome');

Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');

    Route::post('/post/store', [PostController::class, 'store'])->name('post.store');

    Route::get('/post/{post_id}/edit', [PostController::class, 'edit'])->name('post.edit');

    Route::patch('/post/{post_id}/update', [PostController::class, 'update'])->name('post.update');

    Route::patch('/post/{post_id}/updateMemo', [PostController::class, 'updateMemo'])->name('post.updateMemo');

    Route::delete('/post/{post_id}/delete', [PostController::class, 'delete'])->name('post.delete');

    Route::get('/post/{post_id}/show', [PostController::class, 'show'])->name('post.show');

    Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::patch('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');

    Route::post('/comment/{post_id}/store', [CommentController::class, 'store'])->name('comment.store');

    Route::delete('/comment/{comment_id}/delete', [CommentController::class, 'delete'])->name('comment.delete');

    Route::post('/like/{post_id}/store', [LikeController::class, 'store'])->name('like.store');

    Route::delete('/like/{post_id}/delete', [LikeController::class, 'delete'])->name('like.delete');

    Route::get('/like/{id}/index', [LikeController::class, 'index'])->name('like.index');

    Route::get('/favourites/{id}/index', [FavouriteController::class, 'index'])->name('favourite.index');

    Route::post('/favourites/{post_id}/store', [FavouriteController::class, 'store'])->name('favourite.store');

    Route::delete('/favourites/{post_id}/delete', [FavouriteController::class, 'delete'])->name('favourite.delete');

    // admin
    Route::group(['middleware' => 'can:admin'], function() {

        Route::get('/admin/categories', [CategoriesController::class, 'index'])->name('admin.categories');

        Route::post('/admin/categories/store', [CategoriesController::class, 'store'])->name('admin.categories.store');

        Route::patch('/admin/categories/{category_id}/update', [CategoriesController::class, 'update'])->name('admin.categories.update');

        Route::delete('/admin/categories/{category_id}/store', [CategoriesController::class, 'delete'])->name('admin.categories.delete');

        Route::get('/admin/posts', [PostsController::class, 'index'])->name('admin.posts');

        Route::get('/admin/posts/{post_id}/status', [PostsController::class, 'status'])->name('admin.posts.status');

        Route::delete('/admin/posts/{post_id}/hide', [PostsController::class, 'hide'])->name('admin.posts.hide');

        Route::patch('/admin/posts/{post_id}/unhide', [PostsController::class, 'unhide'])->name('admin.posts.unhide');

        Route::get('/admin/users/', [UsersController::class, 'index'])->name('admin.users');

        Route::delete('/admin/users/{id}/deactivate', [UsersController::class, 'deactivate'])->name('admin.users.deactivate');

        Route::patch('/admin/users/{id}/activate', [UsersController::class, 'activate'])->name('admin.users.activate');
    });
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
