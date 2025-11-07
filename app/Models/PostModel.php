<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostModel extends Model
{
   use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'category_id', 'title', 'excerpt', 'body',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category()
    {
        return $this->belongsTo(CategoryModel::class);
    }

    public function comments()
    {
        return $this->morphMany(CommentModel::class, 'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(TagsModel::class, 'taggable');
    }
}
