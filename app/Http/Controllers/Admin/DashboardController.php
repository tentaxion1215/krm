<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Category;
use App\Location;
use App\Jobs;
use App\Reports;
use App\PostViewsDownload;
use App\AppliedUsers;
use App\Transactions;
 
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
 
class DashboardController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
          
         parent::__construct();
          
    }
    public function index()
    { 
            if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin" AND Auth::User()->usertype!="Company")
            {

                \Session::flash('flash_message', 'Access denied!');

                return redirect('dashboard');
                
            }
            
            if(Auth::User()->usertype=="Company")
            {
                $page_title = trans('words.dashboard_text')?trans('words.dashboard_text'):'Dashboard';

                $user_id= Auth::User()->id;

                $jobs = Jobs::where('user_id',$user_id)->count();

                $applied_users = AppliedUsers::select('applied_users.*','jobs.user_id as company_id')
                        ->join('jobs', 'applied_users.post_id', '=', 'jobs.id')
                        ->join('users', 'applied_users.user_id', '=', 'users.id')
                        ->where("jobs.user_id", "$user_id")                          
                         ->count();

                return view('admin.pages.dashboard_company',compact('page_title','jobs','applied_users'));
            }
            else
            {
                $category = Category::count();
                $location = Location::count();
                $jobs = Jobs::count();

                $applied_users = AppliedUsers::count();
                
                $job_seekers = User::where('usertype','User')->count(); 
                $job_providers = User::where('usertype','Company')->count(); 
                $reports = Reports::count();
                $transactions = Transactions::count();


                //Latest Jobs
                $latest_jobs = Jobs::where('status',1)->orderby('id','DESC')->take(10)->get();

                //Trending
                $trending_start_date = date('Y-m-d', strtotime('today - 30 days'));
                $trending_end_date = date('Y-m-d');

                $trending_now = PostViewsDownload::select("post_id","post_type")->whereBetween('date', array(strtotime($trending_start_date), strtotime($trending_end_date)))->selectRaw('SUM(post_views) as total_views')->groupBy('post_id','post_type')->orderby('total_views','DESC')->take(10)->get();
                

                $start_date = date('Y-m-d', strtotime('today - 300 days'));
                $end_date = date('Y-m-d');  

                //Top Country
                $top_country= DB::table("analytics")->select("country",DB::raw("COUNT(1) as count_row"))->where('country','!=','')->whereBetween('date', array(strtotime($start_date), strtotime($end_date)))->groupBy(DB::raw("(country)"))->orderby('count_row','DESC')->take(10)->get();

                //dd($top_country);exit;
                
                //Applied Users
                $applied_users_list = AppliedUsers::orderBy('id','DESC')->take(10)->get();

                //Latest Reports
                $reports_list = Reports::orderby('id','DESC')->take(10)->get();

                
                $page_title = trans('words.dashboard_text')?trans('words.dashboard_text'):'Dashboard';
                    
                return view('admin.pages.dashboard',compact('page_title','category','location','jobs','applied_users','job_seekers','job_providers','reports','transactions','latest_jobs','trending_now','top_country','applied_users_list','reports_list'));                  
            }
 
        
    }
	
	 
    	
}
