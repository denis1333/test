<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;

class Film extends Model
{
    protected $table = "film";
    public function tags()
    {
    	return $this->belongsToMany('App\Tag', 'tagtofilm', 'film_id', 'tag_id');
    }
}
