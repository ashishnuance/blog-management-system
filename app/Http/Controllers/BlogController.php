<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Blog,Category,Comments};
use App\Jobs\FileUploadJob;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Blog\CreateBlogRequest;
use App\Services\BlogService;

class BlogController extends Controller
{
    private $blogService;

    protected $html;

	/**
	 * BlogController constructor.
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
        }else{
            return redirect()->back()->with('error',__('Try again'));
        }

        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $blogResponse = Blog::select('id','category','title','slug','sechedule_post_on','tags','description')->with(['media','blogLike','blogComment'])->where('published_status',1)->where('slug',$slug)->first();
        
        $blogResponse->category = Category::select('id','name')->whereIn('id',explode(',',$blogResponse->category))->get();
        
        $comments = Comments::with(['user','replies'])->where('blog_id',$blogResponse->id)->whereNull('parent_id')->get();
        // $commentsArray = [];
        // foreach($comments as $comment){
        //     echo $comment->id.'<br>';
        //     $commentsArray[$comment->id] = $comment;
        //     $commentsArray[$comment->id]['reply'] = Comments::with('user')->where('parent_id',$comment->id)->get();
        // }
        $comments_html = $this->comment_replay($comments);
        // dd($comments_html);
        return view('blogs.show',compact('blogResponse','comments','comments_html'));
    }

    function comment_replay($comments){
        foreach($comments as $c => $comment_value){ 
            
            $this->html .= view('partials.comment-reply-form',compact('comment_value'))->render();
            
            if($comment_value->replies->count()>0){
                $this->comment_replay($comment_value->replies);
            }
        }
        return $this->html;
    }
    
}
