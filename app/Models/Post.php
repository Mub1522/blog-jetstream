<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'excerpt', 'body', 'published','category_id'];

    protected function image() : Attribute
    {
        return Attribute::make(
            get: fn () => $this->image_path ?? 'https://static.vecteezy.com/system/resources/previews/004/141/669/original/no-photo-or-blank-image-icon-loading-images-or-missing-image-mark-image-not-available-or-image-coming-soon-sign-simple-nature-silhouette-in-frame-isolated-illustration-vector.jpg' 
        );
    }

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
