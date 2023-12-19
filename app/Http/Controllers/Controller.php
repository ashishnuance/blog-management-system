<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $html;

    /**
     * Create comments view for a blog with reply and form for comments.
     *
     * @param array $comments The array of comments.
     * @param mixed $blogId   The variable for the blog ID.
     *
     * @return string         The rendered HTML for comments and replies.
     */
    function comments_replies($comments,$blogId){
        foreach($comments as $c_key => $comment_value){ 
            // Include the 'partials.comment-reply-form' view and render it, passing the $comment_value and blogId variable.
            $this->html .= view('partials.comment-reply-form',compact('comment_value','blogId'))->render();
            
            if($comment_value->replies->count()>0){
                $this->comments_replies($comment_value->replies,$blogId);
            }
        }
        // Return the accumulated HTML.
        return $this->html;
    }
}
