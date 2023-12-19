<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Image;
use Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Display image/video file
     */
    public function displayImage($filename)
    {
        $path = storage_path('app/'.$filename);
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);

        $type = File::mimeType($path);

        $response = Response::make($file,200);

        $response->header("Content-Type", $type);

        return $response;

    }
}
