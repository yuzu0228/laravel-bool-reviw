<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Review extends Model
{
    protected $fillable = ['title','body','image', 'url', 'kind', 'likes_count'];
    
    
    
    
    /*----------------------------------------------------*/
    public function favorite_users()
    {
      return $this->belongsToMany(User::class,'favorites','review_id','user_id')->withTimestamps();
    }
}
