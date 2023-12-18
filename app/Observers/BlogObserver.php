<?php

namespace App\Observers;

use App\Models\Blog;
class BlogObserver
{
    /**
    * Handle the Blog "created" event.
    *
    * @param  \App\Models\Blog  $product
    * @return void
    */
    public function creating(Blog $blog)
    {
        $blog->sechedule_post_on = $blog->sechedule_post_on_date.' '.$blog->sechedule_post_on_time;
        $blog->category = implode(',',$blog->category);
        $blog->slug = \Str::slug($blog->title);
        $blog->published_status = ($blog->sechedule_post_on > now()) ? 0 : 1;
        
        unset($blog->sechedule_post_on_date);
        unset($blog->sechedule_post_on_time);
    }
}
