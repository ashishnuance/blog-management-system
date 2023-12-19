<?php 

namespace App\Services;
use App\Models\Like;

class LikeService {

    /**
     * Create like
	 * @param $request
	 *
	 * @return mixed
	 */
	public function blogLike($request) {
        // create array
        if($this->getUserBlogLikeStatus($request['blog_id'])==0){
            $requestData = [
                'blog_id'=>$request['blog_id'],
                'user_id'=>auth()->user()->id
            ];
            Like::create($requestData);
        }else{
            $this->deleteUserLike($request['blog_id']);
        }
        
        // creatimg new comment and return response 
        return $this->getBlogLikeCount($request['blog_id']);
		
	}

    /**
     * Check blog like status for auth user
     * @param $blogId
     */
    public function getUserBlogLikeStatus($blogId){
        $userLikeBlogStatus = Like::where('blog_id',$blogId)->where('user_id',auth()->user()->id)->count();
        return $userLikeBlogStatus;
    }

    /**
     * Get like count by blogId
     * @param $blogId
     */
    public function getBlogLikeCount($blogId){
        $blogLikeCount = Like::where('blog_id',$blogId)->count();
        return $blogLikeCount;
    }

    /**
     * Delete like for auth user on perticluar blogif user already like
     * @param $blogId
     */
    public function deleteUserLike($blogId){
        Like::where('blog_id',$blogId)->where('user_id',auth()->user()->id)->delete();
        return true;
    }


}