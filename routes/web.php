<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\http\Controllers\CommentsController;
use App\http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('storage/{filename}',[HomeController::class, 'displayImage'])->name('media-files');

Route::middleware('auth')->group(function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::controller(BlogController::class)->group(function(){
        
        Route::get('/','index')->name('blogs');
        Route::get('blog/{slug}','show')->name('blog-detail');
        Route::get('blog-create','create')->name('blog-create');
        Route::post('blog-store','store')->name('blog');
        
    });

    Route::controller(LikeController::class)->group(function(){
        Route::post('like-blog','store')->name('like-blog');
    });

    Route::controller(CommentsController::class)->group(function(){
        
        
        Route::post('comment-store','store')->name('comment');
        Route::post('comment-store-replies','storeReplies')->name('comment-replies');
        
    });

});
