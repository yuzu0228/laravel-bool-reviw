<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Comment extends Model
{
    protected $table = 'comments';
    
    protected $fillable = ['description', 'user_id', 'review_id'];
}
