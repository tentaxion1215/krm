<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\AppliedUsers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str; 

class AppliedUsersController extends MainAdminController
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

        
        if(Auth::User()->usertype=="Company")
        {
            //For Company

            $job_provider_id=Auth::User()->id;

            if(isset($_GET['s']))
            {
                $keyword = $_GET['s'];               

                $list = AppliedUsers::select('applied_users.*','jobs.title','jobs.user_id as company_id','users.name','users.email','users.phone')
                        ->join('jobs', 'applied_users.post_id', '=', 'jobs.id')
                        ->join('users', 'applied_users.user_id', '=', 'users.id')
                        ->where("jobs.user_id", "$job_provider_id")
                        ->where("jobs.title", "LIKE","%$keyword%")                                            
                        ->orwhere(function($query) use($keyword) {
                            $query->where("users.name", "LIKE","%$keyword%")
                                ->orwhere("users.email", "LIKE","%$keyword%")
                                ->orwhere("users.phone", "LIKE","%$keyword%");
                        })
                        ->where("jobs.user_id", "$job_provider_id")
                        ->orderBy('applied_users.id','DESC')
                        ->paginate(10);

                $list->appends(\Request::only('s'))->links();
            }         
            else
            { 
                //$list = AppliedUsers::orderBy('id','DESC')->paginate(10);

                $list = AppliedUsers::select('applied_users.*','jobs.user_id as company_id')
                        ->join('jobs', 'applied_users.post_id', '=', 'jobs.id')
                        ->join('users', 'applied_users.user_id', '=', 'users.id')
                        ->where("jobs.user_id", "$job_provider_id")                          
                        ->orderBy('applied_users.id','DESC')
                        ->paginate(10);

            }
        }
        else
        {
            //For Admin / Sub Admin

            if(isset($_GET['s']))
            {
                $keyword = $_GET['s'];               

                $list = AppliedUsers::select('applied_users.*','jobs.title','users.name','users.email','users.phone')
                        ->join('jobs', 'applied_users.post_id', '=', 'jobs.id')
                        ->join('users', 'applied_users.user_id', '=', 'users.id')
                        ->where("jobs.title", "LIKE","%$keyword%")
                        ->orwhere(function($query) use($keyword) {
                            $query->where("users.name", "LIKE","%$keyword%")
                                ->orwhere("users.email", "LIKE","%$keyword%")
                                ->orwhere("users.phone", "LIKE","%$keyword%");
                        })                    
                        ->orderBy('applied_users.id','DESC')
                        ->paginate(10);

                $list->appends(\Request::only('s'))->links();
            }         
            else
            { 
                $list = AppliedUsers::orderBy('id','DESC')->paginate(10);
            }
        }   

         
        $page_title=trans('words.applied_users');
         
        return view('admin.pages.applied.list',compact('page_title','list'));
    }

     
    public function delete($post_id)
    {
        if(Auth::User()->usertype=="Admin" OR Auth::User()->usertype=="Sub_Admin")
        {
            
             $data_obj = Reports::findOrFail($post_id);
             $data_obj->delete();

             \Session::flash('flash_message', trans('words.deleted'));
             return redirect()->back();
             
            
        }
        else
        {
            \Session::flash('flash_message', trans('words.access_denied'));
            return redirect('admin/dashboard');            
        
        }
    }
 
}
