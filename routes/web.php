<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\http\Controllers\CommentsController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::middleware('auth')->group(function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    Route::controller(BlogController::class)->group(function(){
        
        Route::get('/','index')->name('blogs');
        Route::get('blog/{slug}','show')->name('blog-detail');
        Route::get('blog-create','create')->name('blog-create');
        Route::post('blog-store','store')->name('blog');
        
    });

    Route::controller(CommentsController::class)->group(function(){
        
        
        Route::post('comment-store','store')->name('comment');
        
    });

});
