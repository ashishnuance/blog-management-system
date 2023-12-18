<?php 

namespace App\Services;
use App\Models\Comments;

class CommentService {

    /**
     * Create Comments
	 * @param $request
	 *
	 * @return mixed
	 */
	public function createComment($request) {

        // create array
        $requestData = [
            'blog_id'=>$request['blog_id'],
            'user_id'=>auth()->user()->id,
            'message'=>$request['message'],
            'parent_id'=>$request['parent_id']
        ];

        // creatimg new comment and return response 
		return Comments::create($requestData);
	}


}