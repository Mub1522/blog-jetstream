<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /* Relaciones */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /* Polimorficas */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'tagable');
    }

   public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
