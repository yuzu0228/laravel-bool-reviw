<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\User;

class Review extends Model
{
    protected $fillable = ['title','body','image', 'url', 'kind', 'likes_count'];
    
    
    
    
    /*----------------------------------------------------*/
    public function favorite_users()
    {
      return $this->belongsToMany(User::class,'favorites','review_id','user_id')->withTimestamps();
    }
    
    public function favorite_counter()
    {
      return $this->favorite_users()->count();
    }
    
    /*----------------------------------------------------*/
    
    public function comment_users()
    {
      return $this->belongsToMany(User::class,'comments','review_id','user_id');
    }
    
    public function comment_counter()
    {
      return $this->comment_users()->count();
    }
    
    /*----------------------------------------------------*/
    
    public function user()
    {
      return $this->belongsTo('App\User');
    }
    
    public function user_name()
    {
      return $this->user->name;
    }
}
