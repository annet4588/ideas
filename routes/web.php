<?php
/**
 * dashboard
 * feed
 * profiles
 * users
 */

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FollowerController;
use Illuminate\Support\Facades\Route;

Route::get('', [DashboardController::class, 'index'])->name('dashboard');

//Refactoring Routes:
// ideas/{idea}
Route::resource('ideas', IdeaController::class)->except(['index', 'create', 'show'])->middleware('auth');

Route::resource('ideas', IdeaController::class)->only(['show']);

// ideas/{idea}/comments/{comment}
Route::resource('ideas.comments', CommentController::class)->only(['store'])->middleware('auth');
// Above line is same as below:
// Route::post('{idea}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

Route::resource('users', UserController::class)->only('show', 'edit', 'update')->middleware('auth');

Route::get('profile',[UserController::class, 'profile'])->middleware('auth')->name('profile');

Route::post('users/{user}/follow',[FollowerController::class, 'follow'])->middleware('auth')->name('users.follow');

Route::post('users/{user}/unfollow',[FollowerController::class,'unfollow'])->middleware('auth')->name('users.unfollow');

Route::get('/terms', function(){
    return view('terms');
})->name('terms');


// Route::group(['prefix'=>'ideas/', 'as' =>'ideas.'], function(){

//     Route::get('{idea}', [IdeaController::class, 'show'])->name('show');

//     Route::group(['middleware'=>['auth']], function(){
        // Route::post('', [IdeaController::class, 'store'])->name('store');
        // Route::get('{idea}/edit', [IdeaController::class, 'edit'])->name('edit');

        // Route::put('{idea}', [IdeaController::class, 'update'])->name('update');

        // Route::delete('{idea}', [IdeaController::class, 'destroy'])->name('destroy');

        // Route::post('{idea}/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');
//     });
// });


// Route::get('/profile', [ProfileController::class, 'index']);
// Route::get('/feed', function () {
//     return view('feed');
// });

// Route::get('/profile', function () {
//     return view('users.profile');
// });

// Route::get('/dashboard', function () {
//     return view('users.dashboard');
// });
