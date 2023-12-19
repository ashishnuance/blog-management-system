<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Requests\CreateCommentRequest;

class CommentsController extends Controller
{
    private $commentService;

	/**
	 *  CommentController constructor.
	 *
	 * @param commentService $service
	 */
	public function __construct(CommentService $commentService) {
		$this->commentService = $commentService;
	}

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCommentRequest $request)
    {
        // Create comment on blog
        $commentResponse = $this->commentService->createComment($request->all());
        
        if($commentResponse){
            return redirect()->back()->with('success',__('Comment posted successfully'));
        }else{
            return redirect()->back()->with('error',__('Try again'));
        }

    }

    /**
     * Store replies on blog.
     */
    function storeReplies(CreateCommentRequest $request){

        // Create comment on blog
        $commentResponse = $this->commentService->createComment($request->all());
        
        if($commentResponse){
            $comments = $this->commentService->getCommentsReplies($request->blog_id);

            $comments_html = $this->comments_replies($comments,$request->blog_id);
        
            return response()->json(['status'=>true,'message'=>__('Comment posted successfully'),'data'=>$comments_html],200);
        }else{
            return response()->json(['status'=>false,'message'=>__('Try again')],200);
        }
    }
}
