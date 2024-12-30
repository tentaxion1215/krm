<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Location;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str; 

class LocationController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
          
    }

    public function list()
    { 
 
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');
            
        }

        if(isset($_GET['s']))
        {
            $keyword = $_GET['s'];  
            $list = Location::where("name", "LIKE","%$keyword%")->orderBy('name')->paginate(10);

            $list->appends(\Request::only('s'))->links();
        }         
        else
        {
            $list = Location::orderBy('id','DESC')->paginate(10);

        }

        $page_title=trans('words.locations');
         
        return view('admin.pages.location.list',compact('page_title','list'));
    }

    public function add()    
    {     
          if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
            {

                \Session::flash('flash_message', trans('words.access_denied'));

                return redirect('dashboard');
                
             }  

          $page_title=trans('words.add_location');
         
          return view('admin.pages.location.addedit',compact('page_title'));
        
    }

    public function edit($post_id)    
    {     
          if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
            {

                \Session::flash('flash_message', trans('words.access_denied'));

                return redirect('dashboard');
                
             }  

          $page_title=trans('words.edit_location');

          $info = Location::findOrFail($post_id);
        
          return view('admin.pages.location.addedit',compact('page_title','info'));
        
    }

    public function addnew(Request $request)
    {  
       
       $data =  \Request::except(array('_token')) ;
        
        if(!empty($inputs['id'])){
                
                $rule=array(
                'name' => 'required'
                  );
        }else
        {
            $rule=array(
                'name' => 'required'
                  );
        }

        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();
        
        if(!empty($inputs['id'])){
           
            $data_obj = Location::findOrFail($inputs['id']);

        }else{

            $data_obj = new Location;

        }
         
 
         $data_obj->name = addslashes($inputs['name']);          
         $data_obj->status = $inputs['status']; 
         
         $data_obj->save();
         
        
        if(!empty($inputs['id'])){

            \Session::flash('flash_message', trans('words.successfully_updated'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', trans('words.added'));

            return \Redirect::back();

        }               
        
        
    }
 
}
