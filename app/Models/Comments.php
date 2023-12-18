<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Users,Comments};

class Comments extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id','user_id','message','parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comments::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comments::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comments::class, 'parent_id')->with('replies');
    }
}
