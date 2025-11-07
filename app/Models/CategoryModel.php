<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategoryModel extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['name'];

    public function posts()
    {
        return $this->hasMany(PostModel::class);
    }
}
