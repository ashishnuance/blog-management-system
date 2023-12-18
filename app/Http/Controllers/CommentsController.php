<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommentService;
use App\Http\Requests\CreateCommentRequest;

class CommentsController extends Controller
{
    private $CommentService;

	/**
	 *  CommentController constructor.
	 *
	 * @param commentService $service
	 */
	public function __construct(CommentService $CommentService) {
		$this->commentService = $CommentService;
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
}
