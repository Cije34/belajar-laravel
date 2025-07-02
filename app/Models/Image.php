<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'url',
        'imageable_id',
        'imageable_type',
    ];

    public $timestamps = false; // Disable timestamps if not needed

    public function imageable(){
        return $this->morphTo();
    }
}
