<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppliedUsers extends Model
{
    protected $table = 'applied_users';

    protected $fillable = ['job_id','user_id'];
 
	
    public $timestamps = false;


	public static function getAppliedUsersInfo($id,$field_name) 
    { 
		$info = AppliedUsers::where('id',$id)->first();
		
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
