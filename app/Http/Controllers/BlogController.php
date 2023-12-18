<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Jobs\FileUploadJob;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Blog\CreateBlogRequest;
use App\Services\BlogService;

class BlogController extends Controller
{
    private $blogService;

	/**
	 * UserController constructor.
	 *
	 * @param BlogService $service
	 */
	public function __construct(BlogService $blogService) {
		$this->blogService = $blogService;
	}

    /**
     * Display a listing of the blogs.
     * @return response
     */
    public function index()
    {
        $perpage = config('custom.perpage');
        $blogs = Blog::where('published_status',1)->latest()->paginate($perpage);
        return view('blogs.list',compact('blogs'));
    }

    /**
     * Show the form for creating a new blog.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('blogs.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBlogRequest $request)
    {
        
        
        // Create blog by service
        $blogResponse = $this->blogService->createBlog($request);
        
        // Upload blog media by service
        if($request->has('image_video_file') && $blogResponse){
            $blogMediaResponse = $this->blogService->uploadMediaFile($blogResponse->id,$request);
            
        }
        
        if($blogResponse){
            return redirect()->route('blogs')->with('success',__('Blog created successfully'));
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }



    
}
