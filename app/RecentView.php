<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecentView extends Model
{
    protected $table = 'recent_view';

    protected $fillable = ['user_id', 'post_id'];


	public $timestamps = false;  
 
}
