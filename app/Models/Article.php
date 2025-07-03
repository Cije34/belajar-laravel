<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = "articles";
    protected $fillable = [
        "judul",
        "content",
        "author_id", // Menambahkan author_id
    ];

    public function comments (){
        return $this->morphMany(Comment::class, 'commentable');
    }


    public function tags(){
        return $this->belongsToMany(Tag::class, 'article_tag', 'article_id', 'tag_id');
    }

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function author(){
        return $this->belongsTo(User::class, 'author_id');
    }
}
