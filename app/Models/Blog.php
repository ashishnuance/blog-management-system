<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{BlogMedia,Like,Comments};

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','description','sechedule_post_on_date','tags','category','sechedule_post_on_time'];

    public function media(){
        return $this->hasMany(BlogMedia::class,'blog_id','id');
    }

    public function blogLike(){
        return $this->hasMany(Like::class,'blog_id','id');
    }

    public function blogComment(){
        return $this->hasMany(Comments::class,'blog_id','id');
    }
}
