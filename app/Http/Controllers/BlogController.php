<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Blog,Category,Comments};
use App\Jobs\FileUploadJob;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Blog\CreateBlogRequest;
use App\Services\{BlogService,CommentService};

class BlogController extends Controller
{
    private $blogService;
    private $commentService;

	/**
	 * BlogController constructor.
	 *
	 * @param BlogService,CommentService $service 
	 */
	public function __construct(BlogService $blogService,CommentService $commentService) {
		$this->blogService = $blogService;
		$this->commentService = $commentService;
	}

    /**
     * Display a listing of the blogs.
     * @return response
     */
    public function index()
    {
        $perpage = config('custom.perpage');
        $blogs = Blog::select('id','category','title','slug','sechedule_post_on','tags')->with(['media','blogLike'])->where('published_status',1)->latest()->paginate($perpage);      
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
    public function store(CreateBlogRequest $request) // 
    {
        // Create blog by service
        $blogResponse = $this->blogService->createBlog($request);
        
        // Upload blog media by service
        if($request->has('image_video_file') && $blogResponse){

            $blogMediaResponse = $this->blogService->uploadMediaFile($blogResponse->id,$request);
            
        }
        
        if($blogResponse){
            return redirect()->route('blogs')->with('success',__('Blog created successfully'));
        }else{
            return redirect()->back()->with('error',__('Try again'));
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        // Get blog detail by slug
        $blogResponse = $this->blogService->getBlogDetail($slug);

        // Get all comment and replies
        $comments = $this->commentService->getCommentsReplies($blogResponse->id);
        
        // Generate comment and replies html
        $comments_html = $this->comments_replies($comments,$blogResponse->id);
        
        return view('blogs.show',compact('blogResponse','comments','comments_html'));
    }

    
    
}
