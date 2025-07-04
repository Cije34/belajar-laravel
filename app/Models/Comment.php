<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [
        'body',
        'commentable_id',
        'commentable_type',
    ];
    public function article(){
        return $this->belongsTo(Article::class);
    }

    public function commentable(){
        return $this->morphTo();
    }
}
