<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Tag;

class News extends Model
{
    protected $table = 'news';
    protected $fillable = [
    'title',
    'body',
    'image',
    'data'
];
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }
}
