<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Category;
use App\Location;
use App\Jobs;
use App\SubscriptionPlan;
use App\Favourite;
use App\PostRatings;
use App\Reports;
use App\PostViewsDownload;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str; 

class JobsController extends MainAdminController
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

        if(Auth::User()->usertype =="Company")
        {
            $user_id= Auth::User()->id;

            if(isset($_GET['s']))
            {
                $keyword = $_GET['s'];  
                $list = Jobs::where("user_id", $user_id)->where("title", "LIKE","%$keyword%")->orderBy('title')->paginate(12);

                $list->appends(\Request::only('s'))->links();
            }
            else if(isset($_GET['filter_type']) AND $_GET['filter_type']!="")
            {
                
                $filter_type = explode (",", $_GET['filter_type']);             
            
                $list = Jobs::where("user_id", $user_id)->where(function($query) use($filter_type) {
                    foreach($filter_type as $type) {
                        $query->orWhere('type', "$type");
                    };
                })->orderBy('title')->paginate(12);            
                

                $list->appends(\Request::only('filter_type'))->links();
            }                 
            else
            {
                $list = Jobs::where("user_id", $user_id)->orderBy('id','DESC')->paginate(12);

            }
        }
        else
        {
            if(isset($_GET['s']))
            {
                $keyword = $_GET['s'];  
                $list = Jobs::where("title", "LIKE","%$keyword%")->orderBy('title')->paginate(12);

                $list->appends(\Request::only('s'))->links();
            }
            else if(isset($_GET['filter_type']) AND $_GET['filter_type']!="")
            {
                
                $filter_type = explode (",", $_GET['filter_type']);             
            
                $list = Jobs::where(function($query) use($filter_type) {
                    foreach($filter_type as $type) {
                        $query->orWhere('type', "$type");
                    };
                })->orderBy('title')->paginate(12);            
                

                $list->appends(\Request::only('filter_type'))->links();
            }                 
            else
            {
                $list = Jobs::orderBy('id','DESC')->paginate(12);

            }
        }
        

        $page_title=trans('words.jobs_text');

          
        return view('admin.pages.jobs.list',compact('page_title','list'));
    }

    public function add()    
    {     
          if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin" AND Auth::User()->usertype!="Company")
            {

                \Session::flash('flash_message', trans('words.access_denied'));

                return redirect('dashboard');
                
             }  
        
            //If company  
            if(Auth::User()->usertype=="Company")
            {
                //Check Plan Exp
                if(Auth::User()->usertype =="Company")
                {   
                    $user_id=Auth::User()->id;

                    $user_info = User::findOrFail($user_id);
                    $user_plan_id=$user_info->plan_id;
                    $user_plan_exp_date=$user_info->exp_date;

                    if($user_plan_id==0 OR strtotime(date('m/d/Y'))>$user_plan_exp_date)
                    {      
                        \Session::flash('error_flash_message', trans('words.subscription_plan_exp'));

                        return redirect('admin/jobs');
                    }
                } 

                //Check Limit
                $user_id = Auth::User()->id;
                $user_plan_id = Auth::User()->plan_id;

                $plan_info = SubscriptionPlan::findOrFail($user_plan_id);
                $plan_job_limit=$plan_info->plan_job_limit;

                $total_jobs = Jobs::where('user_id',$user_id)->count();
        
                if($total_jobs >= $plan_job_limit)
                {
                    \Session::flash('error_flash_message', trans('words.job_limit_reached'));

                    return redirect('admin/jobs');
                }

            }     
             
          $page_title=trans('words.add_job');

          $cat_list = Category::orderBy('category_name')->get();
          $location_list = Location::orderBy('name')->get();
 
          return view('admin.pages.jobs.addedit',compact('page_title','cat_list','location_list'));
        
    }

    public function edit($page_id)    
    {     
          if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin" AND Auth::User()->usertype!="Company")
            {

                \Session::flash('flash_message', trans('words.access_denied'));

                return redirect('dashboard');
                
             }  

           //If company  
           if(Auth::User()->usertype=="Company")
           {
               //Check Plan Exp
               if(Auth::User()->usertype =="Company")
               {   
                   $user_id=Auth::User()->id;

                   $user_info = User::findOrFail($user_id);
                   $user_plan_id=$user_info->plan_id;
                   $user_plan_exp_date=$user_info->exp_date;

                   if($user_plan_id==0 OR strtotime(date('m/d/Y'))>$user_plan_exp_date)
                   {      
                       \Session::flash('error_flash_message', trans('words.subscription_plan_exp'));

                       return redirect('admin/jobs');
                   }
               } 
 
           }  


          $page_title=trans('words.edit_job');
          
        if(Auth::User()->usertype =="Company")
        {
            $user_id= Auth::User()->id;

            $info = Jobs::where('user_id',$user_id)->where('id',$page_id)->first();

            if(empty($info)) //If not found job
            {
                \Session::flash('flash_message', trans('words.access_denied'));

                return redirect('admin/dashboard');
            }
        }
        else
        {
            $info = Jobs::findOrFail($page_id);

        }
 
          $cat_list = Category::orderBy('category_name')->get();
          $location_list = Location::orderBy('name')->get();
         
          return view('admin.pages.jobs.addedit',compact('page_title','info','cat_list','location_list'));
        
    }

    public function addnew(Request $request)
    {  
       
       $data =  \Request::except(array('_token')) ;
       
       if(!empty($inputs['id'])){
                
            $rule=array(            
                'category' => 'required',
                'location' => 'required',
                'job_title' => 'required',
                'description' => 'required',
                'job_type' => 'required',
                'designation' => 'required',
                'salary' => 'required',
                'company_name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'qualification' => 'required',
                 );
        }
        else
        {
            $rule=array(                
                'category' => 'required',
                'location' => 'required',
                'job_title' => 'required',
                'description' => 'required',
                'job_type' => 'required',
                'designation' => 'required',
                'salary' => 'required',
                'company_name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'qualification' => 'required',
                'job_image' => 'required'                                 
                );
        }

        
        $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();

        if(!empty($inputs['id'])){
           
            $data_obj = Jobs::findOrFail($inputs['id']);

        }else{

            $data_obj = new Jobs;

            $data_obj->user_id = Auth::User()->id;
        }         
         
        $data_obj->cat_id = $inputs['category'];
        $data_obj->location_id = $inputs['location'];
        $data_obj->title = addslashes($inputs['job_title']);
        $data_obj->description = addslashes($inputs['description']);
        $data_obj->job_type = $inputs['job_type'];
        $data_obj->designation = $inputs['designation'];
        $data_obj->salary = $inputs['salary'];
        $data_obj->company_name = addslashes($inputs['company_name']);
        $data_obj->phone = addslashes($inputs['phone']);
        $data_obj->email = addslashes($inputs['email']);
        $data_obj->website = addslashes($inputs['website']);
        $data_obj->job_work_days = addslashes($inputs['job_work_days']);
        $data_obj->job_work_time = addslashes($inputs['job_work_time']);
        $data_obj->vacancy = addslashes($inputs['vacancy']);
        $data_obj->address = addslashes($inputs['address']);
        $data_obj->experience = addslashes($inputs['experience']);
        $data_obj->qualification = $inputs['qualification'];
        $data_obj->skills = addslashes($inputs['skills']);
        $data_obj->date = strtotime($inputs['date']);

        
        if(Auth::User()->usertype =="Company")
        {
            $job_image = $request->file('job_image');        
                 
            if($job_image){

                $tmpFilePath = public_path('/upload/');

                $hardPath =  Auth::User()->id.'-'.md5(time());

                $job_img = Image::make($job_image);

                $job_img->save($tmpFilePath.$hardPath.'.jpg');
    
                $data_obj->image = 'upload/'.$hardPath.'.jpg';
            }
        }
        else
        {
            $data_obj->image = $inputs['job_image'];  

        }
         
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
