<?php

namespace App\Http\Controllers;

use Auth;
 
use App\Pages;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str; 

class PagesController extends Controller
{
	 
 
    public function page_details($page_id,$page_slug)    
    {      
          $page_info = Pages::findOrFail($page_id);
        
          return view('.pages.page',compact('page_info'));
        
    }

    
}
