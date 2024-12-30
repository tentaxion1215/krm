<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $table = 'jobs';

    protected $fillable = ['type','title','image','url'];
 
	
    public $timestamps = false;

	public static function getJobsInfo($id,$field_name) 
    { 
		$info = Jobs::where('id',$id)->first();
		
		if($info)
		{
			return  $info->$field_name;
		}
		else
		{
			return  '';
		}
	}	 
 
}
