<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    use SoftDeletes;

    protected $table = 'blog_posts';

    protected $fillable = ['title', 'slug', 'content', 'author_id', 'status'];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}