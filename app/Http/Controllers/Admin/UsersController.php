<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Favourite;
use App\PostRatings;
use App\PostViewsDownload;
use App\Reports; 
use App\SubscriptionPlan;
use App\Transactions;

use Carbon\Carbon;
use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Facades\DB;

use App\Exports\UsersExport;
use App\Exports\CompanyExport;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str; 
use Illuminate\Support\Facades\File;


class UsersController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');	
		
		 parent::__construct();
          
    }
    public function list()    { 
         
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');
            
        } 

        $page_title=trans('words.job_seeker');

        if(isset($_GET['s']))
        {
            $keyword = $_GET['s'];  
            $user_list = User::where("usertype", "=","User")->where(function($query) use ($keyword){
                $query->where('name', "LIKE","%$keyword%");
                $query->orwhere('email', "LIKE","%$keyword%");
            })->orderBy('id','DESC')->paginate(10);

            $user_list->appends(\Request::only('s'))->links();
        }         
        else
        {
          
            $user_list = User::where('usertype', '=', 'User')->orderBy('id','DESC')->paginate(10);
        }
         
        return view('admin.pages.users.list',compact('page_title','user_list'));
    } 
     
    public function add()    { 
        
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');
            
        }

        $page_title=trans('words.add_user');

        $plan_list = SubscriptionPlan::where('status','1')->where('plan_type','Seeker')->orderby('id')->get();
           
        return view('admin.pages.users.addedit',compact('page_title','plan_list'));
    }
    
    public function addnew(Request $request)
    { 
    	 
    	$data =  \Request::except(array('_token')) ;
	    
	    $inputs = $request->all();
	    
	    if(!empty($inputs['id']))
	    {
			$rule=array(
		        'name' => 'required',
		        'email' => 'required|email|max:255|unique:users,email,'.$inputs['id'],
                'user_image' => 'mimes:jpg,jpeg,gif,png' 
		   		 );
			
		}
		else
		{
			$rule=array(
		        'name' => 'required',
		        'email' => 'required|email|max:255|unique:users,email',
		        'password' => 'required|min:8|max:15',
                'user_image' => 'mimes:jpg,jpeg,gif,png'
		   		 );
		}
	    
	    
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	      
		if(!empty($inputs['id'])){
           
            $user = User::findOrFail($inputs['id']);

        }else{

            $user = new User;

        }
		
        $icon = $request->file('user_image');        
                 
        if($icon){
            //$tmpFilePath = 'upload/';
            $tmpFilePath = public_path('/upload/');

            $hardPath =  Str::slug($inputs['name'], '-').'-'.md5(time());

            $img = Image::make($icon);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
 
            $user->user_image = $hardPath.'-b.jpg';
        }  

        //Resume
        $resume = $request->file('resume');        
                 
        if($resume){
            
            $fileName = time().'_'.$resume->getClientOriginalName();
            
             $resume->move(public_path('upload/resume/'), $fileName);  
             
             $user->resume = 'upload/resume/'.$fileName;
        }
		
        
		$user->name = $inputs['name'];		 
		$user->email = $inputs['email'];
        
        if($inputs['password'])
        {
            $user->password= bcrypt($inputs['password']); 
        }        
        $user->phone = $inputs['phone'];

        $user->city = $inputs['city'];
        $user->address = addslashes($inputs['address']);
        $user->date_of_birth = strtotime($inputs['date_of_birth']);
        $user->gender = $inputs['gender'];
        $user->current_company = $inputs['current_company'];
        $user->skills = $inputs['skills'];
        $user->experience = $inputs['experience'];
        
        //Get Plan info 
        $plan_id=$inputs['subscription_plan'];
        $plan_info = SubscriptionPlan::where('id',$plan_id)->where('status','1')->first();        
        $plan_days=$plan_info->plan_days;

        if(empty($inputs['id']))
        {
            if($inputs['subscription_plan']!="")
            {
                $user->exp_date = strtotime(date('m/d/Y', strtotime("+$plan_days days")));

            }
            else
            {
                if($inputs['exp_date']!="")
                {
                    $user->exp_date = strtotime($inputs['exp_date']);
                }
                else
                {
                    $user->exp_date = null;
                }
            }
        }
        else
        {   
            if($inputs['exp_date']!="")
            {
                $user->exp_date = strtotime($inputs['exp_date']);
            }
            else
            {
                $user->exp_date = null;
            }
        }
         

        $user->plan_id = $plan_id;
         
        $user->status = $inputs['status'];
	    $user->save(); 
		
		if(!empty($inputs['id'])){

            \Session::flash('flash_message', trans('words.successfully_updated'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', trans('words.added'));

            return \Redirect::back();

        }		     
        
         
    }     
    
    public function edit($id)    
    {     
    	if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');
            
        }		
    	  $page_title=trans('words.edit_user');

          $user = User::findOrFail($id);
          
          $plan_list = SubscriptionPlan::where('status','1')->where('plan_type','Seeker')->orderby('id')->get();
            
          return view('admin.pages.users.addedit',compact('page_title','user','plan_list'));
        
    }	 
    
    public function delete($id)
    {
    	
    	if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');
            
        }
        
        $fav_obj = Favourite::where('user_id',$id)->delete();
        $rate_obj = PostRatings::where('user_id',$id)->delete();
        $rep_obj = Reports::where('user_id',$id)->delete();

        $user = User::findOrFail($id);         
		$user->delete();
		
        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();

    }    

     
    public function user_export()    
    {
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }

          return Excel::download(new UsersExport, 'users.xlsx');

    }

    public function users_history($id)    
    {     
          if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }       
          $page_title=trans('words.user_history');

          $user = User::findOrFail($id);

          $user_id=$user->id;

          $transactions_list = Transactions::where('user_id',$user_id)->orderBy('id','DESC')->paginate(10);
                      
          return view('admin.pages.users.user_history',compact('page_title','user','transactions_list'));
        
    }

    //Company

    public function company_list()    { 
         
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');
            
        } 

        $page_title=trans('words.job_provider');

        if(isset($_GET['s']))
        {
            $keyword = $_GET['s'];  

            //$user_list = User::where("usertype", "=","Company")->where("name", "LIKE","%$keyword%")->orwhere("email", "LIKE","%$keyword%")->orderBy('id','DESC')->paginate(10);

            $user_list = User::where("usertype", "=","Company")->where(function($query) use ($keyword){
                $query->where('name', "LIKE","%$keyword%");
                $query->orwhere('email', "LIKE","%$keyword%");
            })->orderBy('id','DESC')->paginate(10);

            $user_list->appends(\Request::only('s'))->links();
        }         
        else
        {
          
            $user_list = User::where('usertype', '=', 'Company')->orderBy('id','DESC')->paginate(10);
        }
         
        return view('admin.pages.users.company_list',compact('page_title','user_list'));
    } 
     
    public function company_add(){ 
        
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        { 

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');
            
        }

        $page_title=trans('words.add_provider');

        $plan_list = SubscriptionPlan::where('status','1')->where('plan_type','Provider')->orderby('id')->get();
           
        return view('admin.pages.users.addedit_company',compact('page_title','plan_list'));
    }
    
    public function company_addnew(Request $request)
    { 
    	 
    	$data =  \Request::except(array('_token')) ;
	    
	    $inputs = $request->all();
	    
	    if(!empty($inputs['id']))
	    {
			$rule=array(
		        'name' => 'required',
		        'email' => 'required|email|max:255|unique:users,email,'.$inputs['id'],
                'company_logo' => 'mimes:jpg,jpeg,gif,png' 
		   		 );
			
		}
		else
		{
			$rule=array(
		        'name' => 'required',
		        'email' => 'required|email|max:255|unique:users,email',
		        'password' => 'required|min:8|max:15',
                'company_logo' => 'mimes:jpg,jpeg,gif,png'
		   		 );
		}
	    
	    
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	      
		if(!empty($inputs['id'])){
           
            $user = User::findOrFail($inputs['id']);

        }else{

            $user = new User;

        }
		
        $company_logo = $request->file('company_logo');        
                 
        if($company_logo){

            $tmpFilePath = public_path('/upload/');

            $hardPath =  Str::slug($inputs['name'], '-').'-'.md5(time());

            $img = Image::make($company_logo);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
 
            $user->user_image = $hardPath.'-b.jpg';
        }  

        $user->usertype = "Company";
		$user->name = $inputs['name'];		 
		$user->email = $inputs['email'];
        
        if($inputs['password'])
        {
            $user->password= bcrypt($inputs['password']); 
        }        

        $user->phone = $inputs['phone'];

        $user->city = $inputs['city'];
        $user->address = addslashes($inputs['address']);        
        $user->company_website = $inputs['company_website'];
        $user->company_working_day = $inputs['company_working_day'];
        $user->company_working_time = $inputs['company_working_time'];
        $user->company_info = addslashes($inputs['company_info']);  

        //Get Plan info 
        $plan_id=$inputs['subscription_plan'];
        $plan_info = SubscriptionPlan::where('id',$plan_id)->where('status','1')->first();        
        $plan_days=$plan_info->plan_days;

        if(empty($inputs['id']))
        {
            if($inputs['subscription_plan']!="")
            {
                $user->exp_date = strtotime(date('m/d/Y', strtotime("+$plan_days days")));

            }
            else
            {
                if($inputs['exp_date']!="")
                {
                    $user->exp_date = strtotime($inputs['exp_date']);
                }
                else
                {
                    $user->exp_date = null;
                }
            }
        }
        else
        {   
            if($inputs['exp_date']!="")
            {
                $user->exp_date = strtotime($inputs['exp_date']);
            }
            else
            {
                $user->exp_date = null;
            }
        }
         

        $user->plan_id = $plan_id;
         
        $user->status = isset($inputs['status'])?$inputs['status']:1;
	    $user->save(); 
		
		if(!empty($inputs['id'])){

            \Session::flash('flash_message', trans('words.successfully_updated'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', trans('words.added'));

            return \Redirect::back();

        }		     
        
         
    }     
    
    public function company_edit($id)    
    {     
    	if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');
            
        }		
    	  $page_title=trans('words.edit_provider');

          $user = User::findOrFail($id);

          $plan_list = SubscriptionPlan::where('status','1')->where('plan_type','Provider')->orderby('id')->get();
            
          return view('admin.pages.users.addedit_company',compact('page_title','user','plan_list'));
        
    }

    public function company_export()    
    {
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }

          return Excel::download(new CompanyExport, 'company.xlsx');

    }

    public function company_history($id)    
    {     
          if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }       
          $page_title=trans('words.user_history');

          $user = User::findOrFail($id);

          $user_id=$user->id;

          $transactions_list = Transactions::where('user_id',$user_id)->orderBy('id','DESC')->paginate(10);
                      
          return view('admin.pages.users.history',compact('page_title','user','transactions_list'));
        
    }

    public function company_profile_edit(Request $request)
    { 
    	 
    	$data =  \Request::except(array('_token')) ;
	    
	    $inputs = $request->all();
	    
	    if(!empty($inputs['id']))
	    {
			$rule=array(
		        'name' => 'required',
		        'email' => 'required|email|max:255|unique:users,email,'.$inputs['id'],
                'company_logo' => 'mimes:jpg,jpeg,gif,png' 
		   		 );
			
		}
		else
		{
			$rule=array(
		        'name' => 'required',
		        'email' => 'required|email|max:255|unique:users,email',
		        'password' => 'required|min:8|max:15',
                'company_logo' => 'mimes:jpg,jpeg,gif,png'
		   		 );
		}
	    
	    
	    
	   	 $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
	      
		if(!empty($inputs['id'])){
           
            $user = User::findOrFail($inputs['id']);

        }else{

            $user = new User;

        }
		
        $company_logo = $request->file('company_logo');        
                 
        if($company_logo){

            $tmpFilePath = public_path('/upload/');

            $hardPath =  Str::slug($inputs['name'], '-').'-'.md5(time());

            $img = Image::make($company_logo);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
 
            $user->user_image = $hardPath.'-b.jpg';
        }  

        $user->usertype = "Company";
		$user->name = $inputs['name'];		 
		$user->email = $inputs['email'];
        
        if($inputs['password'])
        {
            $user->password= bcrypt($inputs['password']); 
        }        

        $user->phone = $inputs['phone'];

        $user->city = $inputs['city'];
        $user->address = addslashes($inputs['address']);        
        $user->company_website = $inputs['company_website'];
        $user->company_working_day = $inputs['company_working_day'];
        $user->company_working_time = $inputs['company_working_time'];
        $user->company_info = addslashes($inputs['company_info']);  
 
 	    $user->save(); 
		
		if(!empty($inputs['id'])){

            \Session::flash('flash_message', trans('words.successfully_updated'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', trans('words.added'));

            return \Redirect::back();

        }		     
        
         
    }

      
    public function company_subscription()    
    {     
                
          $page_title=trans('words.subscription');
          
          $user_id= Auth::User()->id;

          $user = User::findOrFail($user_id);
 
          $transactions_list = Transactions::where('user_id',$user_id)->orderBy('id','DESC')->paginate(10);
          
           
          return view('admin.pages.users.company_subscription',compact('page_title','user','transactions_list'));
        
    }
    
    //Sub Admin

    public function admin_list()    { 
         
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        } 

        $page_title=trans('words.admin_list');

        if(isset($_GET['s']))
        {
            $keyword = $_GET['s'];  
            $user_list = User::where("usertype", "!=","User")->where("usertype", "!=","Company")->where('id', '!=', 1)->where(function($query) use ($keyword){
                $query->where('name', "LIKE","%$keyword%");
                $query->orwhere('email', "LIKE","%$keyword%");
            })->orderBy('id','DESC')->paginate(10);

            $user_list->appends(\Request::only('s'))->links();
        }        
        else
        {
          
            $user_list = User::where('usertype', '!=', 'User')->where("usertype", "!=","Company")->where('id', '!=', 1)->orderBy('id','DESC')->paginate(10);
        }
         
        return view('admin.pages.users.admin_list',compact('page_title','user_list'));
    } 

    public function admin_add(){ 
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }

        $page_title=trans('words.add_admin');
           
        return view('admin.pages.users.addedit_admin',compact('page_title'));
    }
    
    public function admin_addnew(Request $request)
    { 
         
        $data =  \Request::except(array('_token')) ;
        
        $inputs = $request->all();
        
        if(!empty($inputs['id']))
        {
            $rule=array(
                'name' => 'required',
                'email' => 'required|email|max:255|unique:users,email,'.$inputs['id'],
                'user_image' => 'mimes:jpg,jpeg,gif,png' 
                 );
            
        }
        else
        {
            $rule=array(
                'name' => 'required',
                'email' => 'required|email|max:255|unique:users,email',
                'password' => 'required|min:8|max:15',
                'user_image' => 'mimes:jpg,jpeg,gif,png'
                 );
        }
        
        
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
          
        if(!empty($inputs['id'])){
           
            $user = User::findOrFail($inputs['id']);

        }else{

            $user = new User;

        }
        
        $icon = $request->file('user_image');        
                 
        if($icon){
            $tmpFilePath = public_path('/upload/');

            $hardPath =  Str::slug($inputs['name'], '-').'-'.md5(time());

            $img = Image::make($icon);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
            //$img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');

            $user->user_image = $hardPath.'-b.jpg';
        }          
         

        $user->usertype = $inputs['usertype'];
        $user->name = $inputs['name'];       
        $user->email = $inputs['email'];
        
        if($inputs['password'])
        {
            $user->password= bcrypt($inputs['password']); 
        }        
        $user->phone = $inputs['phone'];
        $user->status = $inputs['status'];
        $user->save(); 
        
        if(!empty($inputs['id'])){

            \Session::flash('flash_message', trans('words.successfully_updated'));

            return \Redirect::back();
        }else{

            \Session::flash('flash_message', trans('words.added'));

            return \Redirect::back();

        }            
        
         
    }

    public function admin_edit($id)    
    {     
          if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }       
          $page_title=trans('words.edit_admin');

          $user = User::findOrFail($id);
            
          return view('admin.pages.users.addedit_admin',compact('page_title','user'));
        
    }

    public function admin_delete($id)
    {
        
        if(Auth::User()->usertype!="Admin"){

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('admin/dashboard');
            
        }
        
        if($id!=1)
        {
            $fav_obj = Favourite::where('user_id',$id)->delete();
            $rate_obj = PostRatings::where('user_id',$id)->delete();
            $rep_obj = Reports::where('user_id',$id)->delete();

            $user = User::findOrFail($id);         
            $user->delete();
        } 
          
        \Session::flash('flash_message', trans('words.deleted'));

        return redirect()->back();

    }  
   
    	
}
