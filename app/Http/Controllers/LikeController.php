<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LikeService;

class LikeController extends Controller
{
    private $likeService;
    private $commentService;

	/**
	 * BlogController constructor.
	 *
	 * @param LikeService $service
	 */
	public function __construct(LikeService $likeService) {
		$this->likeService = $likeService;
	}

    /**
     * Store a blog like count by user.
     */
    public function store(Request $request){
        
        $likeCount = $this->likeService->blogLike($request->all());
        return response()->json(['like_count'=>$likeCount,'status'=>true],200);
    }
}
