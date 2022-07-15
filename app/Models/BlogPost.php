<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogPost extends Model
{
    protected $fillable = ['title', 'content'];

    use HasFactory;

    public function comments(): HasMany
    {
        return $this->hasMany('App\Models\Comment');
    }
}
