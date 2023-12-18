<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(BlogController::class)->group(function(){

    Route::get('/','index')->name('blogs');
    Route::get('blog/{slug}','show')->name('blog');
    Route::get('blog-create','create')->name('blog-create');
    Route::post('blog-store','store')->name('blog');

});
