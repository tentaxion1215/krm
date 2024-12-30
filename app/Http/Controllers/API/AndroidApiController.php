<?php

namespace App\Http\Controllers\API;

use Auth;
use App\User; 
use App\AppAds;
use App\Category;
use App\Location;
use App\Jobs; 
use App\Pages;
use App\Reports;
use App\Settings;
use App\PostViewsDownload;
use App\PostRatings;
use App\Favourite;
use App\PasswordReset;
use App\PaymentGateway;
use App\SubscriptionPlan;
use App\Transactions;
use App\AppliedUsers;
use App\RecentView;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Session;
use URL;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\File;

require(base_path() . '/public/stripe-php/init.php'); 

require(base_path() . '/public/paytm/PaytmChecksum.php');

require(base_path() . '/public/razorpay/vendor/autoload.php');
 
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class AndroidApiController extends MainAPIController
{
    public function __construct()
    {
        $this->pagination_limit=getcong('pagination_limit')?getcong('pagination_limit'):10;
    }
      
    public function index()
    {   
          $response = array(); 
        
        return \Response::json(array(            
            'JOBS_APP' => $response,
            'status_code' => 200,
            'msg' => "API",
            'success' => 1
        ));   
         
    }
    public function app_details()
    {   
        
        $get_data=checkSignSalt($_POST['data']);

        if(isset($get_data['user_id']) && $get_data['user_id']!='')
        {
            $user_id=$get_data['user_id'];        
            $user_info = User::getUserInfo($user_id);

           if(!empty($user_info))
           {
                if($user_info!='' AND $user_info->status==1)
                {
                    $user_status=true;
                }
                else
                {
                    $user_status=false;
                }
            }
            else
            {
               $user_status=false; 
            }
        }
        else
        {
            $user_status=false;
        }
 
        $settings = Settings::findOrFail('1'); 

        $default_language=$settings->default_language;
        $currency_code=$settings->currency_code;
        $currency_symbol=html_entity_decode(getCurrencySymbols($settings->currency_code));
        $app_name=$settings->app_name;
        $app_email=$settings->app_email;
        $app_logo=\URL::to('/'.$settings->app_logo);
        $app_company=$settings->app_company?$settings->app_company:'';
        $app_website=$settings->app_website?$settings->app_website:'';
        $app_contact=$settings->app_contact?$settings->app_contact:'';
        $app_version=$settings->app_version?$settings->app_version:'';

        $facebook_link=$settings->facebook_link?$settings->facebook_link:'';
        $twitter_link=$settings->twitter_link?$settings->twitter_link:'';
        $instagram_link=$settings->instagram_link?$settings->instagram_link:'';
        $youtube_link=$settings->youtube_link?$settings->youtube_link:'';
        $google_play_link=$settings->google_play_link?$settings->google_play_link:'';
        $apple_store_link=$settings->apple_store_link?$settings->apple_store_link:'';
         

        $app_update_hide_show=$settings->app_update_hide_show;
        $app_update_version_code=$settings->app_update_version_code?$settings->app_update_version_code:'1';
        $app_update_desc=stripslashes($settings->app_update_desc);
        $app_update_link=$settings->app_update_link;
        $app_update_cancel_option=$settings->app_update_cancel_option;

        $live_wallpaper_on_off=$settings->live_wallpaper_on_off;

         
         
        $app_package_name=$settings->app_package_name?$settings->app_package_name:"com.example.jobs";

        //Ad List
        $ads_list = AppAds::where('status','1')->orderby('id')->get();  
        
        if(count($ads_list) > 0)
        {
            foreach($ads_list as $ad_data)
            {
                    $ad_id= $ad_data->id;
                    $ads_name= $ad_data->ads_name; 
                    $ads_info= json_decode($ad_data->ads_info);                  
                    $status= $ad_data->status?"true":"false";;                 
                     
                    $ads_obj[]=array("ad_id"=>$ad_id,"ads_name"=>$ads_name,"ads_info"=>$ads_info,"status"=>$status);   
            }
        }
        else
        {
            $ads_obj= array();
        }

        //Page List
        $page_list = Pages::where('status','1')->orderby('page_order')->get();  
  
        foreach($page_list as $page_data)
        {
                $page_id= $page_data->id;
                $page_title= stripslashes($page_data->page_title); 
                $page_content= stripslashes($page_data->page_content);                  
                  
                $pages_obj[]=array("page_id"=>$page_id,"page_title"=>$page_title,"page_content"=>$page_content);   
        }

        /***********Save visitor user info start************/
        $user_ip=\Request::ip();                
        $os_name = isset($get_data['os_name'])?$get_data['os_name']:"";   
        $browser_name = '';    
 
        save_visitor_analytics_info($user_ip,$os_name,$browser_name);

        /***********Save visitor user info end************/

        $response = array('app_package_name'=>$app_package_name,'default_language' => $default_language,'currency_code' => $currency_code,'currency_symbol' => $currency_symbol,'app_name' => $app_name,'app_email' => $app_email,'app_logo' => $app_logo,'app_company' => $app_company,'app_website' => $app_website,'app_contact' => $app_contact,'facebook_link' => $facebook_link,'twitter_link' => $twitter_link,'instagram_link' => $instagram_link,'youtube_link' => $youtube_link,'google_play_link' => $google_play_link,'apple_store_link' => $apple_store_link,'app_version' => $app_version,'app_update_hide_show' => $app_update_hide_show,'app_update_version_code' => $app_update_version_code,'app_update_desc' => $app_update_desc,'app_update_link' => $app_update_link,'app_update_cancel_option' => $app_update_cancel_option,'live_wallpaper_on_off' => $live_wallpaper_on_off,'ads_list'=>$ads_obj,'page_list'=>$pages_obj);

        return \Response::json(array(            
            'JOBS_APP' => $response,
             'status_code' => 200,
             'user_status' => $user_status,
             'success' => 1
        )); 

    }

    public function payment_settings()
    {
        $get_data=checkSignSalt($_POST['data']);

        $settings = Settings::findOrFail('1'); 
        
        $gateway_list = PaymentGateway::where('status','1')->orderby('id')->get(); 

        $settings = Settings::findOrFail('1'); 

        $currency_code=$settings->currency_code;
        
        if(count($gateway_list))
        {
            foreach($gateway_list as $gateway_data)
            {
                    $gateway_id= $gateway_data->id;
                    $gateway_name= $gateway_data->gateway_name; 
                    $gateway_logo= \URL::to('/admin_assets/images/gateway/'.$gateway_data->id.'.png');
                    $gateway_info= json_decode($gateway_data->gateway_info);                  
                    $status= $gateway_data->status?"true":"false";;                 
                    
                    $response[]=array("gateway_id"=>$gateway_id,"gateway_name"=>$gateway_name,"gateway_logo"=>$gateway_logo,"gateway_info"=>$gateway_info,"status"=>$status);   
            }    
        }
        else
        {
            $response=array();    
        }
        

        return \Response::json(array(            
            'JOBS_APP' => $response,
            'currency_code' => $currency_code,
            'status_code' => 200,
            'success' => 1
        ));
 
    }
    
    public function home()
    {   

        $get_data=checkSignSalt($_POST['data']);

        $user_id= isset($get_data['user_id'])?$get_data['user_id']:"";
        
        //Recommend Job
        if($user_id!="")
        { 
            $user_info = User::where('id',$user_id)->first();

            $user_skill=$user_info['skills']; 
            $skills = str_replace(',', '|', $user_skill); 
            //$skills = explode(',', $user_skill);                
                    
              
            //$recommend_jobs= Jobs::where('status',1)->whereIn('skills',$skills)->take(5)->get();
            $recommend_jobs= Jobs::where('status',1)->where('skills','REGEXP','('.$skills.')')->take(5)->get();

            if(count($recommend_jobs) > 0)
            {
                foreach($recommend_jobs as $recommend_data)
                {   
                    $post_id=$recommend_data->id;
                    $post_title=stripslashes($recommend_data->title);
                    $post_image = \URL::to('/'.$recommend_data->image);
                    $address=stripslashes($recommend_data->address);

                    $location= Location::getLocationInfo($recommend_data->location_id,'name');
                    $designation=$recommend_data->designation;
                    $salary=$recommend_data->salary;
                    $skills=stripslashes($recommend_data->skills);
                    

                    $favourite=check_favourite("Jobs",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                    $recommend_jobs_list[]=array('post_id'=>$post_id,'post_title'=>$post_title,'post_image'=>$post_image,'location'=>$location,'address'=>$address,'designation'=>$designation,'salary'=>$salary,'skills'=>$skills,'favourite'=>$favourite);
                }
            }
            else
            {
                $recommend_jobs_list=array();
            }

        }
        else
        {
            $recommend_jobs_list=array();
        }

        //Category
        $category= Category::where('status',1)->orderby('category_name')->take(4)->get();

        if(count($category) > 0)
        {
            foreach($category as $category_data)
            {   
                $post_id=$category_data->id;
                $post_title=stripslashes($category_data->category_name);
                $post_image = \URL::to('/'.$category_data->category_image);

                $total_jobs= Jobs::where('status',1)->where('cat_id',$post_id)->count();
 
                $category_list[]=array('post_id'=>$post_id,'post_title'=>$post_title,'post_image'=>$post_image,'total_jobs'=>$total_jobs);
            }
        }
        else
        {
            $category_list=array();
        }
        

        //Latest Jobs
        $latest_jobs= Jobs::where('status',1)->orderby('id','DESC')->take(5)->get();

        if(count($latest_jobs) > 0)
        {
            foreach($latest_jobs as $latest_data)
            {   
                $post_id=$latest_data->id;
                $post_title=stripslashes($latest_data->title);
                $post_image = \URL::to('/'.$latest_data->image);
                $address=stripslashes($latest_data->address);

                $location= Location::getLocationInfo($latest_data->location_id,'name');
                $designation=$latest_data->designation;
                $salary=$latest_data->salary;
                $skills=stripslashes($latest_data->skills);
                

                $favourite=check_favourite("Jobs",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                $latest_jobs_list[]=array('post_id'=>$post_id,'post_title'=>$post_title,'post_image'=>$post_image,'location'=>$location,'address'=>$address,'designation'=>$designation,'salary'=>$salary,'skills'=>$skills,'favourite'=>$favourite);
            }
        }
        else
        {
            $latest_jobs_list=array();
        }

        //Recently Watched
        if(isset($get_data['user_id']))
        {   
            $current_user_id=$get_data['user_id'];
            //exit;

            $recently_view = RecentView::where('user_id',$current_user_id)->orderby('id','DESC')->take(5)->get();

            if(count($recently_view) > 0)
            {
         
                foreach($recently_view as $data)
                {   
                    $post_id=$data->post_id;

                    if(Jobs::getJobsInfo($post_id,'status')==1)
                    {
                        
                        $post_title= Jobs::getJobsInfo($post_id,'title');
                        $post_image= \URL::to('/'.Jobs::getJobsInfo($post_id,'image'));
                        $address=stripslashes(Jobs::getJobsInfo($post_id,'address'));

                        $location_id=Jobs::getJobsInfo($post_id,'location_id');

                        $location= Location::getLocationInfo($location_id,'name');
                        $designation=Jobs::getJobsInfo($post_id,'designation');
                        $salary=Jobs::getJobsInfo($post_id,'salary');
                        $skills=stripslashes(Jobs::getJobsInfo($post_id,'skills'));

                        $favourite=check_favourite("Jobs",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                        $recently_list[]=array('post_id'=>$post_id,'post_title'=>$post_title,'post_image'=>$post_image,'location'=>$location,'address'=>$address,'designation'=>$designation,'salary'=>$salary,'skills'=>$skills,'favourite'=>$favourite);
                    }
                    
                }
            }
            else
            {
                $recently_list=array();
            }    

        }

        //Compnay
        $company_data_list = User::whereHas('jobs')->where('status',1)->where('usertype','Company')->inRandomOrder()->take(5)->get();

        if(count($company_data_list) > 0)
        {
            $company_list=array();

            foreach($company_data_list as $company_data)
            {   
                
                    $post_id=$company_data->id;
                    $post_title=stripslashes($company_data->name);
                    $city=$company_data->city;
                    $address=stripslashes($company_data->address);
                    $phone=$company_data->phone;
                    $company_website=$company_data->company_website;
                    $company_working_day=$company_data->company_working_day;
                    $company_working_time=$company_data->company_working_time;
                    $company_info=stripslashes($company_data->company_info);
                    $post_image = \URL::to('upload/'.$company_data->user_image);

                    $company_list[]=array('post_id'=>$post_id,'post_title'=>$post_title,'city'=>$city,'address'=>$address,'phone'=>$phone,'company_website'=>$company_website,'company_working_day'=>$company_working_day,'company_working_time'=>$company_working_time,'company_info'=>$company_info,'post_image'=>$post_image);
 
            }
        }
        else
        {
            $company_list=array();
        }
                        
 
        return \Response::json(array(           
            'recommend_jobs_list' => $recommend_jobs_list,
            'category_list' => $category_list,
            'latest_jobs_list' => $latest_jobs_list,
            'recently_list' => $recently_list,
            'company_list' => $company_list,
            'status_code' => 200 
        ));
    }

    public function company_list()
    {    

        $get_data=checkSignSalt($_POST['data']);
 
        $data_list = User::whereHas('jobs')->where('usertype','Company')->orderby('id')->paginate($this->pagination_limit);
        
         
       if($data_list->currentPage() == $data_list->lastPage())
       {
            $load_more=false;  
       }
       else
       {
            $load_more=true;  
       }

        if(!empty($data_list))
        {
            $response=array();
            
            foreach($data_list as $obj_data)
            {  
                 
                    $post_id=$obj_data->id;
                    $post_title=stripslashes($obj_data->name);
                    $city=$obj_data->city;
                    $address=stripslashes($obj_data->address);
                    $phone=$obj_data->phone;
                    $company_website=$obj_data->company_website;
                    $company_working_day=$obj_data->company_working_day;
                    $company_working_time=$obj_data->company_working_time;
                    $company_info=stripslashes($obj_data->company_info);
                    $post_image = \URL::to('upload/'.$obj_data->user_image);

                    $response[]=array('post_id'=>$post_id,'post_title'=>$post_title,'city'=>$city,'address'=>$address,'phone'=>$phone,'company_website'=>$company_website,'company_working_day'=>$company_working_day,'company_working_time'=>$company_working_time,'company_info'=>$company_info,'post_image'=>$post_image);
 
            }
        }
        else
        {
            $response = array();
        }


         return \Response::json(array(            
            'JOBS_APP' => $response,
            'load_more' => $load_more,
            'status_code' => 200 
        ));

    }

    public function recently_view()
    {
        $get_data=checkSignSalt($_POST['data']);

        $current_user_id=$get_data['user_id'];
             
        $data_list = RecentView::where('user_id',$current_user_id)->orderby('id','DESC')->paginate($this->pagination_limit);

        $total_records=RecentView::where('user_id',$current_user_id)->count();

       if($data_list->currentPage() == $data_list->lastPage())
       {
            $load_more=false;  
       }
       else
       {
            $load_more=true;  
       }

        if($total_records > 0)
        {
        
            foreach($data_list as $data)
            {   
                $post_id=$data->post_id;

                if(Jobs::getJobsInfo($post_id,'status')==1)
                {
                
                    $post_title= Jobs::getJobsInfo($post_id,'title');
                    $post_image= \URL::to('/'.Jobs::getJobsInfo($post_id,'image'));
                    $address=stripslashes(Jobs::getJobsInfo($post_id,'address'));

                    $location_id=Jobs::getJobsInfo($post_id,'location_id');

                    $location= Location::getLocationInfo($location_id,'name');
                    $designation=Jobs::getJobsInfo($post_id,'designation');
                    $salary=Jobs::getJobsInfo($post_id,'salary');
                    $skills=stripslashes(Jobs::getJobsInfo($post_id,'skills'));

                    $favourite=check_favourite("Jobs",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                    $response[]=array('post_id'=>$post_id,'post_title'=>$post_title,'post_image'=>$post_image,'location'=>$location,'address'=>$address,'designation'=>$designation,'salary'=>$salary,'skills'=>$skills,'favourite'=>$favourite);
                }
            }
        }
        else
        {
            $response=array();
        }   
        
        return \Response::json(array(            
            'JOBS_APP' => $response,
            'total_records' => $total_records,
            'load_more' => $load_more,
            'status_code' => 200 
        ));
    }

    public function latest_jobs()
    {
        $get_data=checkSignSalt($_POST['data']);
         
        $jobs_list= Jobs::where('status',1)->orderby('id','DESC')->take(10)->get();
 
        if(count($jobs_list) > 0)
        {
            foreach($jobs_list as $data)
            {   
                $post_id=$data->id;
                $post_title=stripslashes($data->title);
                $post_image = \URL::to('/'.$data->image);
                $address=stripslashes($data->address);
                $location= Location::getLocationInfo($data->location_id,'name');
                $designation=$data->designation;
                $salary=$data->salary;
                $skills=stripslashes($data->skills);

                $favourite=check_favourite("Jobs",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                $response[]=array('post_id'=>$post_id,'post_title'=>$post_title,'post_image'=>$post_image,'location'=>$location,'address'=>$address,'designation'=>$designation,'salary'=>$salary,'skills'=>$skills,'favourite'=>$favourite);
            }
        }
        else
        {
            $response=array();
        }

        return \Response::json(array(            
            'JOBS_APP' => $response,
            'status_code' => 200 
        ));
    }

    public function recommend_jobs()
    {
        $get_data=checkSignSalt($_POST['data']);

        $user_id= isset($get_data['user_id'])?$get_data['user_id']:"";
                
        $user_info = User::where('id',$user_id)->first();

        $user_skill=$user_info['skills']; 
        $skills = str_replace(',', '|', $user_skill); 
            
        
        $jobs_list= Jobs::where('status',1)->where('skills','REGEXP','('.$skills.')')->paginate($this->pagination_limit);

        $total_records=Jobs::where('status',1)->where('skills','REGEXP','('.$skills.')')->count();

       if($jobs_list->currentPage() == $jobs_list->lastPage())
       {
            $load_more=false;  
       }
       else
       {
            $load_more=true;  
       }

        if($total_records > 0)
        {
          
                foreach($jobs_list as $data)
                {   
                    $post_id=$data->id;
                    $post_title=stripslashes($data->title);
                    $post_image = \URL::to('/'.$data->image);
                    $address=stripslashes($data->address);
                    $location= Location::getLocationInfo($data->location_id,'name');
                    $designation=$data->designation;
                    $salary=$data->salary;
                    $skills=stripslashes($data->skills);

                    $favourite=check_favourite("Jobs",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                    $response[]=array('post_id'=>$post_id,'post_title'=>$post_title,'post_image'=>$post_image,'location'=>$location,'address'=>$address,'designation'=>$designation,'salary'=>$salary,'skills'=>$skills,'favourite'=>$favourite);
                } 
        }
        else
        {
                $response=array();
        }

        return \Response::json(array(            
            'JOBS_APP' => $response,
            'total_records' => $total_records,
            'load_more' => $load_more,
            'status_code' => 200 
        ));
    }
     
 
    public function category()
    {    

        $get_data=checkSignSalt($_POST['data']);

        $data_list= Category::where('status',1)->orderby('category_name')->paginate($this->pagination_limit);
        
        $total_records=Category::where('status',1)->count();

       if($data_list->currentPage() == $data_list->lastPage())
       {
            $load_more=false;  
       }
       else
       {
            $load_more=true;  
       }

        if($total_records > 0)
        {
            foreach($data_list as $obj_data)
            {  
                $cat_id= $obj_data->id;

                $total_jobs= Jobs::where('status',1)->where('cat_id',$cat_id)->count();

                $response[]=array("post_id"=>$cat_id,"post_title"=>stripslashes($obj_data->category_name),"post_image"=>\URL::to('/'.$obj_data->category_image),"total_jobs"=>$total_jobs);
            }
        }
        else
        {
            $response = array();
        }


         return \Response::json(array(            
            'JOBS_APP' => $response,
            'total_records' => $total_records,
            'load_more' => $load_more,
            'status_code' => 200 
        ));

    }

    public function jobs_by_cat()
    {
        $get_data=checkSignSalt($_POST['data']);

        $cat_id = $get_data['cat_id'];
         
        $jobs_list= Jobs::where('status',1)->where('cat_id',$cat_id)->paginate($this->pagination_limit);

        $total_records=Jobs::where('status',1)->where('cat_id',$cat_id)->count();

       if($jobs_list->currentPage() == $jobs_list->lastPage())
       {
            $load_more=false;  
       }
       else
       {
            $load_more=true;  
       }

        if($total_records > 0)
        {
            foreach($jobs_list as $data)
            {   
                $post_id=$data->id;
                $post_title=stripslashes($data->title);
                $post_image = \URL::to('/'.$data->image);
                $address=stripslashes($data->address);
                $location= Location::getLocationInfo($data->location_id,'name');
                $designation=$data->designation;
                $salary=$data->salary;
                $skills=stripslashes($data->skills);

                $favourite=check_favourite("Jobs",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                $response[]=array('post_id'=>$post_id,'post_title'=>$post_title,'post_image'=>$post_image,'location'=>$location,'address'=>$address,'designation'=>$designation,'salary'=>$salary,'skills'=>$skills,'favourite'=>$favourite);
            }
        }
        else
        {
            $response=array();
        }

        return \Response::json(array(            
            'JOBS_APP' => $response,
            'total_records' => $total_records,
            'load_more' => $load_more,
            'status_code' => 200 
        ));
    }
     
    public function jobs_details()
    {
        $get_data=checkSignSalt($_POST['data']);

        $job_id = $get_data['job_id'];
         
        $jobs_info= Jobs::where('status',1)->where('id',$job_id)->first();
        
        $cat_id=$jobs_info->cat_id;
        $location_id=$jobs_info->location_id;
        $location= Location::getLocationInfo($jobs_info->location_id,'name');
        $post_id=$jobs_info->id;
        $post_title=stripslashes($jobs_info->title);
        $description=stripslashes($jobs_info->description);
        $job_type=$jobs_info->job_type;
        $designation=stripslashes($jobs_info->designation);
        $salary=$jobs_info->salary;
        $company_name=stripslashes($jobs_info->company_name);
        $phone=$jobs_info->phone;
        $email=$jobs_info->email;
        $website=stripslashes($jobs_info->website);
        $job_work_days=$jobs_info->job_work_days;
        $job_work_time=$jobs_info->job_work_time;
        $vacancy=$jobs_info->vacancy;
        $address=stripslashes($jobs_info->address);
        $experience=stripslashes($jobs_info->experience);
        $qualification=$jobs_info->qualification;
        $skills=stripslashes($jobs_info->skills);
        $date= date('M d, Y',$jobs_info->date); 

        $post_image = \URL::to('/'.$jobs_info->image);

        $favourite=check_favourite("Jobs",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

        //Recently View
        if(isset($get_data['user_id']) && $get_data['user_id']!="")
        {
            $user_id=$get_data['user_id'];
            $post_id=$post_id;
            
            $recently_view_count = RecentView::where('user_id',$user_id)->where('post_id',$post_id)->count();

            if($recently_view_count == 0)
            {
                $recent_obj = new RecentView;
                $recent_obj->user_id = $user_id;
                $recent_obj->post_id = $post_id;
                $recent_obj->save();
            }
        }

        //Similar Jobs
        $similar_jobs_list= Jobs::where('status',1)->where('id','!=',$post_id)->where('cat_id',$cat_id)->take(10)->get();

        if(count($similar_jobs_list) > 0)
        {
            foreach($similar_jobs_list as $similar_data)
            {   
                $s_post_id=$similar_data->id;
                $s_post_title=stripslashes($similar_data->title);
                $s_post_image = \URL::to('/'.$similar_data->image);
                $s_address=stripslashes($similar_data->address);
                $s_location= Location::getLocationInfo($similar_data->location_id,'name');
                $s_designation=$similar_data->designation;
                $s_salary=$similar_data->salary;
                $s_skills=stripslashes($similar_data->skills);

                $s_favourite=check_favourite("Jobs",$s_post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                $similar_jobs[]=array('post_id'=>$s_post_id,'post_title'=>$s_post_title,'post_image'=>$s_post_image,'location'=>$s_location,'address'=>$s_address,'designation'=>$s_designation,'salary'=>$s_salary,'skills'=>$s_skills,'favourite'=>$s_favourite);
            }
        }
        else
        {
            $similar_jobs=array();
        }

        //View Update
        post_views_save($post_id,'Jobs');

        $response=array('cat_id'=>$cat_id,'location_id'=>$location_id,'location'=>$location,'post_id'=>$post_id,'post_title'=>$post_title,'description'=>$description,'job_type'=>$job_type,'designation'=>$designation,'salary'=>$salary,'company_name'=>$company_name,'phone'=>$phone,'email'=>$email, 'website'=>$website,'job_work_days'=>$job_work_days,'job_work_time'=>$job_work_time,'vacancy'=>$vacancy,'address'=>$address,'experience'=>$experience,'qualification'=>$qualification,'skills'=>$skills,'date'=>$date,'post_image'=>$post_image,'favourite'=>$favourite,'similar_jobs'=>$similar_jobs);
        
        return \Response::json(array(            
            'JOBS_APP' => $response,
            'status_code' => 200,
            'success' => 1
        ));
    } 

    public function jobs_search()
    {
        $get_data=checkSignSalt($_POST['data']);

        $search_text = $get_data['search_text'];

        $jobs_list= Jobs::where('status',1)->where('title','LIKE',"%".$search_text."%")->paginate($this->pagination_limit);

        $total_records=Jobs::where('status',1)->where('title','LIKE',"%".$search_text."%")->count();

       if($jobs_list->currentPage() == $jobs_list->lastPage())
       {
            $load_more=false;  
       }
       else
       {
            $load_more=true;  
       }

        if($total_records > 0)
        {
            foreach($jobs_list as $data)
            {   
                $post_id=$data->id;
                $post_title=stripslashes($data->title);
                $post_image = \URL::to('/'.$data->image);
                $address=stripslashes($data->address);
                $location= Location::getLocationInfo($data->location_id,'name');
                $designation=$data->designation;
                $salary=$data->salary;
                $skills=stripslashes($data->skills);

                $favourite=check_favourite("Jobs",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                $response[]=array('post_id'=>$post_id,'post_title'=>$post_title,'post_image'=>$post_image,'location'=>$location,'address'=>$address,'designation'=>$designation,'salary'=>$salary,'skills'=>$skills,'favourite'=>$favourite);
            }
        }
        else
        {
            $response=array();
        }

        return \Response::json(array(            
            'JOBS_APP' => $response,
            'total_records' => $total_records,
            'load_more' => $load_more,
            'status_code' => 200 
        ));
    }

    public function jobs_filter()
    {
        $get_data=checkSignSalt($_POST['data']);

        $search_text = $get_data['search_text'];

         $data_list= Jobs::where('status',1)->where('title','LIKE',"%".$search_text."%")->where(function($query) use($get_data) {
            
            if(isset($get_data['cat_ids']) AND $get_data['cat_ids'])
            {   
                $cat_ids=$get_data['cat_ids'];
                $category_id = json_decode("[$cat_ids]", true);

                $query->whereIn('cat_id',$category_id);
            }

            if(isset($get_data['location_ids']) AND $get_data['location_ids'])
            {
                $location_ids=$get_data['location_ids'];
                $locations = json_decode("[$location_ids]", true);

                $query->whereIn('location_id',$locations);
            }

            if(isset($get_data['company_ids']) AND $get_data['company_ids'])
            {
                $company_ids=$get_data['company_ids'];
                $company = json_decode("[$company_ids]", true);

                $query->whereIn('user_id',$company);
            }
            
            if(isset($get_data['salary_start']) AND $get_data['salary_start'] AND $get_data['salary_end'])
            {
                $query->whereBetween('salary', [$get_data['salary_start'], $get_data['salary_end']]);
            } 

            if(isset($get_data['job_type']) AND $get_data['job_type'])
            {
                //$job_type=$get_data['job_type']; 
                //$query->where('job_type',$job_type); 

                $job_type=$get_data['job_type'];
                $types = explode(',', $job_type);                
                 
                $query->whereIn('job_type',$types);                
            }

            if(isset($get_data['qualification']) AND $get_data['qualification'])
            {
                //$qualification=$get_data['qualification']; 
                //$query->where('qualification',$qualification);
                
                $qualification=$get_data['qualification'];
                $qualifications = explode(',', $qualification);

                $query->whereIn('qualification',$qualifications);         
            }

        })->orderby('id','DESC')->paginate($this->pagination_limit); 

           // $data_list= Property::where('status',1)->orderby('id','DESC')->take(getcong('latest_limit'))->get();
        
        if($data_list->currentPage() == $data_list->lastPage())
        {
            $load_more=false;  
        }
        else
        {
            $load_more=true;  
        } 

        if(count($data_list) > 0)
        {
            foreach($data_list as $data)
            {   
                $post_id=$data->id;
                $post_title=stripslashes($data->title);
                $post_image = \URL::to('/'.$data->image);
                $address=stripslashes($data->address);
                $location= Location::getLocationInfo($data->location_id,'name');
                $designation=$data->designation;
                $salary=$data->salary;
                $skills=stripslashes($data->skills);

                $favourite=check_favourite("Jobs",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                $response[]=array('post_id'=>$post_id,'post_title'=>$post_title,'post_image'=>$post_image,'location'=>$location,'address'=>$address,'designation'=>$designation,'salary'=>$salary,'skills'=>$skills,'favourite'=>$favourite);
            }
        }
        else
        {
            $response=array();
        }

        return \Response::json(array(            
            'JOBS_APP' => $response,
            'load_more' => $load_more,
            'status_code' => 200 
        ));
    }

    public function cat_loc_comp_list()
    {
        $get_data=checkSignSalt($_POST['data']);

        //Category
        $category= Category::where('status',1)->orderby('category_name')->get();

        if(count($category) > 0)
        {
            foreach($category as $category_data)
            {   
                $post_id=$category_data->id;
                $post_title=stripslashes($category_data->category_name); 
  
                $category_list[]=array('post_id'=>$post_id,'post_title'=>$post_title);
            }
        }
        else
        {
            $category_list=array();
        }

        //Location
        $location_data_list= Location::where('status',1)->orderby('name')->get();

        if(count($location_data_list) > 0)
        {
            foreach($location_data_list as $location_data)
            {   
                $post_id=$location_data->id;
                $post_title=stripslashes($location_data->name);
                 

                $location_list[]=array('post_id'=>$post_id,'post_title'=>$post_title);
            }
        }
        else
        {
            $location_list=array();
        }

        //Compnay 
        $company_data_list = User::whereHas('jobs')->where('usertype','Company')->get();

        if(count($company_data_list) > 0)
        {
            foreach($company_data_list as $company_data)
            {   
                $post_id=$company_data->id;
                $post_title=stripslashes($company_data->name);
                 

                $company_list[]=array('post_id'=>$post_id,'post_title'=>$post_title);
            }
        }
        else
        {
            $company_list=array();
        }        
        
        $job_types_array=array('Contract','Freelance','Full Time','Internship','Part Time');

        foreach($job_types_array as $job_types)
        {
            $job_types_list[]=array('post_title'=>$job_types);
        }

        $qualification_array=array('Bachelors','Masters','MPhil/MS','PHD/Doctorate','Certification','Diploma','Short Course');

        foreach($qualification_array as $job_qualification)
        {
            $qualification_list[]=array('post_title'=>$job_qualification);
        }

        $min_salary= Jobs::min('salary');
        $max_salary= Jobs::max('salary');
 
        return \Response::json(array(            
            'category_list' => $category_list,
            'location_list' => $location_list,
            'company_list' => $company_list,
            'job_types_list' => $job_types_list,
            'qualification_list' => $qualification_list,
            'min_salary' => $min_salary,
            'max_salary' => $max_salary,
            'status_code' => 200 
        ));

    }

    public function jobs_by_company()
    {
        $get_data=checkSignSalt($_POST['data']);

        $company_id = $get_data['company_id'];
         
        $jobs_list= Jobs::where('status',1)->where('user_id',$company_id)->paginate($this->pagination_limit);

        $total_records=Jobs::where('status',1)->where('user_id',$company_id)->count();

       if($jobs_list->currentPage() == $jobs_list->lastPage())
       {
            $load_more=false;  
       }
       else
       {
            $load_more=true;  
       }

        if($total_records > 0)
        {
            foreach($jobs_list as $data)
            {   
                $post_id=$data->id;
                $post_title=stripslashes($data->title);
                $post_image = \URL::to('/'.$data->image);
                $address=stripslashes($data->address);
                $location= Location::getLocationInfo($data->location_id,'name');
                $designation=$data->designation;
                $salary=$data->salary;
                $skills=stripslashes($data->skills);

                $favourite=check_favourite("Jobs",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                $response[]=array('post_id'=>$post_id,'post_title'=>$post_title,'post_image'=>$post_image,'location'=>$location,'address'=>$address,'designation'=>$designation,'salary'=>$salary,'skills'=>$skills,'favourite'=>$favourite);
            }
        }
        else
        {
            $response=array();
        }

        return \Response::json(array(            
            'JOBS_APP' => $response,
            'total_records' => $total_records,
            'load_more' => $load_more,
            'status_code' => 200 
        ));
    }
 
    public function post_view()
    {           
        $get_data=checkSignSalt($_POST['data']);

        $post_id = $get_data['post_id'];
        $post_type = $get_data['post_type'];
          
        //View Update
        post_views_save($post_id,$post_type);

        $post_views= post_views_count($post_id,$post_type);

        $response=array("views"=>$post_views);
         
         return \Response::json(array(            
            'JOBS_APP' => $response,
            'status_code' => 200,
            'success' => 1
        ));

    }
 

    public function post_favourite()
    {   
        
        $get_data=checkSignSalt($_POST['data']);

        $user_id = $get_data['user_id'];
        $post_id = $get_data['post_id'];
        $post_type = $get_data['post_type'];
 
        $fav_info = Favourite::where('post_type', '=', $post_type)->where('post_id', '=', $post_id)->where('user_id', '=', $user_id)->first();   


        if($fav_info)
        { 
            $fav_obj = Favourite::findOrFail($fav_info->id);        
            $fav_obj->delete();

            $success=false;
            $msg=trans('words.fav_deleted');
             
        }
        else
        {
            $fav_obj = new Favourite;

            $fav_obj->post_id = $post_id;
            $fav_obj->user_id = $user_id;
            $fav_obj->post_type = $post_type;
            $fav_obj->save();

            $success=true;
            $msg=trans('words.fav_success');
        }  
          
        $response=array();
         
         return \Response::json(array(            
            'JOBS_APP' => $response,
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
        ));

    }

      
      
    public function login()
    {   
        
        $get_data=checkSignSalt($_POST['data']);

          
        $email=isset($get_data['email'])?$get_data['email']:'';
        $password=isset($get_data['password'])?$get_data['password']:'';
        
        if ($email=='' AND $password=='')
        {
                 
                return \Response::json(array(            
                    'status_code' => 200,
                    'msg' => trans('words.email_pass_req'),
                    'success' => 0
                ));
        }
 
        $user_info = User::where('email',$email)->first(); 

        if (!$user_info)
        {
                 

                return \Response::json(array(            
                    'status_code' => 200,
                    'msg' => trans('words.email_password_invalid'),
                    'success' => 0
                ));
        }
         
        if (Hash::check($password, $user_info['password'])) 
        {
           
            if($user_info->status==0){
                  

                  return \Response::json(array(            
                    'status_code' => 200,
                    'msg' => trans('words.account_banned'),
                    'success' => 0
                ));
            }             
            else
            { 
                $user_id=$user_info->id;
                $user = User::findOrFail($user_id);

                 
                if($user->user_image!='')
                {
                    $user_image=\URL::asset('upload/'.$user->user_image);
                }
                else
                {
                    $user_image=\URL::asset('images/profile.png');
                }
                $phone= $user->phone?$user->phone:'';

                $response = array('user_id' => $user_id,'usertype' => $user->usertype,'name' => $user->name,'email' => $user->email,'phone' => $phone,'user_image' => $user_image);
            }

            return \Response::json(array(            
                'JOBS_APP' => $response,
                'status_code' => 200,
                'msg' => trans('words.login_success'),
                'success' => 1
            ));   

        }
        else
        {
 
            return \Response::json(array(            
                'status_code' => 200,
                'msg' => trans('words.email_password_invalid'),
                'success' => 0
            ));   
        }
        
         
    }

    public function signup()
    {  
        $get_data=checkSignSalt($_POST['data']);
            
        $usertype= $get_data['usertype'];
        $name= $get_data['name'];
        $email= $get_data['email'];
        $password= $get_data['password'];
        $phone= $get_data['phone'];
        
        $check_email = User::where('email', $email)->first();

        if($check_email)
        {

                return \Response::json(array(            
                    'status_code' => 200,
                    'msg' => trans('words.email_already_used'),
                    'success' => 0
                ));
        }
        else
        {   
            $user = new User;

            $user->usertype = $usertype;
            $user->name = $name; 
            $user->email = $email;         
            $user->password= bcrypt($password);  
            $user->phone= $phone?$phone:'';        
            $user->save();


            return \Response::json(array(            
                'status_code' => 200,
                'msg' => trans('words.account_created_successfully'),
                'success' => 1
            ));
        }
    }

    public function social_login()
    {   
        
        $get_data=checkSignSalt($_POST['data']);
            
        $login_type= $get_data['login_type']; // FB or Google
        $social_id= $get_data['social_id'];
         
        $name= $get_data['name'];
        $email= $get_data['email'];
        $password= bcrypt('123456dummy');
        $phone= '';
        
        $check_email = User::where('email', $email)->first();

        if($check_email)
        {
            $finduser = User::where('email', $email)->first();
        }
        else
        {
            if($login_type=="google")
            {
                 $finduser = User::where('google_id', $social_id)->first();
     
            }
            else
            {
                 $finduser = User::where('facebook_id', $social_id)->first();
      
            }
        }

        if($finduser)
        {   
                if($finduser->user_image!='')
                {
                    $user_image=\URL::asset('upload/'.$finduser->user_image);
                }
                else
                {
                    $user_image=\URL::asset('images/profile.png');
                }

                if($finduser->status==0){
                 
                    $msg= trans('words.account_banned');
                    $success =0;

                    return \Response::json(array(            
                        'status_code' => 200,
                        'msg' => $msg,
                        'success' => $success
                    ));
                }
                else
                {
                 $phone= $finduser->phone?$finduser->phone:'';  
                 
                 $msg= trans('words.login_success');
                 $success =1;
                
                 $response = array('user_id' => $finduser->id,'usertype' => $finduser->usertype,'name' => $finduser->name,'email' => $finduser->email,'phone' => $phone,'user_image' => $user_image);
                }
        }
        else
        {

            if($login_type=="google")
            {
                 $social_login_type="google";
                 $google_id=$social_id;

                 $user_obj = new User;

                $user_obj->usertype = 'User';
                $user_obj->social_login_type = $social_login_type; 
                $user_obj->google_id = $google_id; 
                $user_obj->name = $name; 
                $user_obj->email = $email;         
                $user_obj->password= bcrypt($password);  
                $user_obj->phone= $phone?$phone:'';        
                $user_obj->save();
     
            }
            else
            {
                 $social_login_type="facebook";
                 $facebook_id=$social_id;

                 $user_obj = new User;

                $user_obj->usertype = 'User';
                $user_obj->social_login_type = $social_login_type; 
                $user_obj->facebook_id = $facebook_id; 
                $user_obj->name = $name; 
                $user_obj->email = $email;         
                $user_obj->password= bcrypt($password);  
                $user_obj->phone= $phone?$phone:'';        
                $user_obj->save();
      
            }

            //Get last insert user id
            $user_id=$user_obj->id;
 
            $user = User::findOrFail($user_id);

                 
            if($user->user_image!='')
            {
                $user_image=\URL::asset('upload/'.$user->user_image);
            }
            else
            {
                $user_image=\URL::asset('images/profile.png');
            }
            $phone= $user->phone?$user->phone:'';

            $msg= trans('words.login_success');
            $success =1;

            $response = array('user_id' => $user_id,'usertype' => $user->usertype,'name' => $user->name,'email' => $user->email,'phone' => $phone,'user_image' => $user_image);
        }

 
        return \Response::json(array(            
            'JOBS_APP' => $response,
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
        ));   
    }
     
 
    public function forgot_password()
    {   
        $get_data=checkSignSalt($_POST['data']);

        $email=isset($get_data['email'])?$get_data['email']:'';
 
        $user = User::where('email', $email)->first();

        //dd($user);
        //exit;

        if(!$user)
        {   
            $msg = trans('words.email_not_found');
            $success = 0;

            $response = array();
        }
        else
        {  
           $user_id=$user->id;
           $name=$user->name;
           $email=$user->email;

           $password= Str::random(10);

           $user = User::findOrFail($user_id);
           $user->password= bcrypt($password);
           $user->save(); 
    
           try{

            $data_email = array(
                'name' => $name,
                'password' => $password
                );    

            \Mail::send('emails.password', $data_email, function($message) use ($name,$email){
                $message->to($email, $name)
                ->from(getcong('app_email'), getcong('app_name'))
                ->subject('Password Reset | '.getcong('app_name'));
            });    

            }catch (\Throwable $e) {
                     
                \Log::info($e->getMessage());    
            }     
     
            $msg =  trans('words.email_new_pass_sent');
            $success = 1;

            $response = array();
 
        }

        return \Response::json(array(            
            'JOBS_APP' => $response,
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
        ));
    }

     
    public function profile()
    {   
        $get_data=checkSignSalt($_POST['data']);

        $user_id=$get_data['user_id'];

        $user = User::where('id',$user_id)->first();

        if (!$user)
        {
            $msg =  'Something went wrong';
            $response = array();

            return \Response::json(array(            
                'JOBS_APP' => $response,
                'status_code' => 200,
                'msg' => $msg,
                'success' => 0
            ));
        }
                 
        if($user->user_image!='')
        {
            $user_image=\URL::asset('upload/'.$user->user_image);
        }
        else
        {
            $user_image=\URL::asset('images/profile.png');
        }

        $phone=$user->phone?$user->phone:'';
        $city=$user->city?$user->city:'';
        $address=$user->address?$user->address:'';
        $date_of_birth=$user->date_of_birth?date('m-d-Y', $user->date_of_birth):'';
        $gender=$user->gender;
        $current_company=$user->current_company?$user->current_company:'';
        $skills=$user->skills?$user->skills:'';
        $experience=$user->experience?$user->experience:'';
         
        $resume=$user->resume?\URL::asset('/'.$user->resume):'';

        $applied_jobs=total_applied_jobs($user_id);
        $saved_jobs=total_saved_jobs($user_id);

        if($user->plan_id!="")
        {
            $user_plan_id=$user->plan_id;        
            $user_plan_exp_date=$user->exp_date;

            $current_plan=SubscriptionPlan::getSubscriptionPlanInfo($user_plan_id,'plan_name');                
            $expired_date=date('d, M Y',$user_plan_exp_date);

        }
        else
        {
            $current_plan="";                
            $expired_date="";
        }
        

        $trans_info = Transactions::where('user_id',$user_id)->orderby('id', 'desc')->first();

        if(!empty($trans_info))
        {
            $last_plan_id=$trans_info->plan_id;
            $last_invoice_plan_name=$current_plan=SubscriptionPlan::getSubscriptionPlanInfo($last_plan_id,'plan_name');
            $last_invoice_plan_amount=$trans_info->payment_amount;
            $last_invoice_date=date('d, M Y',$trans_info->date);
        }
        else
        {
            $last_plan_id="";
            $last_invoice_plan_name="";
            $last_invoice_plan_amount="";
            $last_invoice_date="";
        }
        
         
 
        $response = array('user_id' => $user_id,'name' => $user->name,'email' => $user->email,'phone' => $phone,'city' => $city,'address' => $address,'date_of_birth' => $date_of_birth,'gender' => $gender,'current_company' => $current_company,'skills' => $skills,'experience' => $experience,'user_image' => $user_image,'resume' => $resume,'applied_jobs' => $applied_jobs,'saved_jobs' => $saved_jobs);


        return \Response::json(array(            
            'JOBS_APP' => $response,
            'current_plan' => $current_plan,
            'expired_date' => $expired_date,
            'last_invoice_date' => $last_invoice_date,
            'last_invoice_plan_name' => $last_invoice_plan_name,
            'last_invoice_plan_amount' => $last_invoice_plan_amount,
            'status_code' => 200,
            'msg' => trans('words.profile'),
            'success' => 1
        ));
    }

    public function profile_update(Request $request)
    { 
         //$data =  \Request::except(array('_token'));
         
        $inputs = $request->all();
         //dd($inputs);
        //exit;
        //echo $inputs['data'];
        $get_data=checkSignSalt($inputs['data']);

          
        $user_id=$get_data['user_id'];    
        $user_obj = User::findOrFail($user_id);

        $icon = $request->file('user_image');
        
                 
        if($icon){

            \File::delete(public_path('/upload/').$user_obj->user_image);            

            //$tmpFilePath = public_path().'/upload/';
            $tmpFilePath = public_path('/upload/');

            $hardPath =  Str::slug($get_data['name'], '-').'-'.md5(time());

            $img = Image::make($icon);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
            //$img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');

            $user_obj->user_image = $hardPath.'-b.jpg';
        }

        //Resume
        $resume = $request->file('resume');        
                 
        if($resume){
            
            $fileName = time().'_'.$resume->getClientOriginalName();
            
             $resume->move(public_path('upload/resume/'), $fileName);  
             
             $user_obj->resume = 'upload/resume/'.$fileName;
        }
        
        
        $user_obj->name = $get_data['name'];          
        $user_obj->email = $get_data['email']; 
        $user_obj->phone = $get_data['phone'];
         
        
        $user_obj->city = $get_data['city'];
        $user_obj->address = $get_data['address'];
        $user_obj->date_of_birth = strtotime($get_data['date_of_birth']);
        $user_obj->gender = $get_data['gender'];
        $user_obj->current_company = $get_data['current_company'];
        $user_obj->skills = $get_data['skills'];
        $user_obj->experience = $get_data['experience'];
        
        $user_obj->save();

        $user_id=$get_data['user_id'];    
        $user = User::findOrFail($user_id);

        if($user->user_image!='')
        {
            $user_image=\URL::asset('upload/'.$user->user_image);
        }
        else
        {
            $user_image=\URL::asset('images/profile.png');
        }

        $response = array('user_id' => $user_id,'name' => $user->name,'email' => $user->email,'phone' => $user->phone,'user_image' => $user_image);
 
        return \Response::json(array(            
            'JOBS_APP' => $response,
            'status_code' => 200,
            'msg' => trans('words.successfully_updated'),
            'success' => 1
        ));
    }

    public function provider_profile()
    {   
        $get_data=checkSignSalt($_POST['data']);

        $user_id=$get_data['user_id'];

        $user = User::where('id',$user_id)->first();

        if (!$user)
        {
            $msg =  'Something went wrong';
            $response = array();

            return \Response::json(array(            
                'JOBS_APP' => $response,
                'status_code' => 200,
                'msg' => $msg,
                'success' => 0
            ));
        }
                 
        if($user->user_image!='')
        {
            $user_image=\URL::asset('upload/'.$user->user_image);
        }
        else
        {
            $user_image=\URL::asset('images/profile.png');
        }

        $phone=$user->phone?$user->phone:'';
        $city=$user->city?$user->city:'';
        $address=$user->address?$user->address:'';

        $company_website=$user->company_website?$user->company_website:'';
        $company_working_day=$user->company_working_day?$user->company_working_day:'';
        $company_working_time=$user->company_working_time?$user->company_working_time:'';
        $company_info=$user->company_info?$user->company_info:'';
         
        if($user->plan_id!="")
        {
            $user_plan_id=$user->plan_id;        
            $user_plan_exp_date=$user->exp_date;

            $current_plan=SubscriptionPlan::getSubscriptionPlanInfo($user_plan_id,'plan_name');                
            $expired_date=date('d, M Y',$user_plan_exp_date);

        }
        else
        {
            $current_plan="";                
            $expired_date="";
        }
        

        $trans_info = Transactions::where('user_id',$user_id)->orderby('id', 'desc')->first();

        if(!empty($trans_info))
        {
            $last_plan_id=$trans_info->plan_id;
            $last_invoice_plan_name=$current_plan=SubscriptionPlan::getSubscriptionPlanInfo($last_plan_id,'plan_name');
            $last_invoice_plan_amount=$trans_info->payment_amount;
            $last_invoice_date=date('d, M Y',$trans_info->date);
        }
        else
        {
            $last_plan_id="";
            $last_invoice_plan_name="";
            $last_invoice_plan_amount="";
            $last_invoice_date="";
        }
        
         
 
        $response = array('user_id' => $user_id,'name' => $user->name,'email' => $user->email,'phone' => $phone,'city' => $city,'address' => $address,'company_website' => $company_website,'company_working_day' => $company_working_day,'company_working_time' => $company_working_time,'company_info' => $company_info,'user_image' => $user_image);


        return \Response::json(array(            
            'JOBS_APP' => $response,
            'current_plan' => $current_plan,
            'expired_date' => $expired_date,
            'last_invoice_date' => $last_invoice_date,
            'last_invoice_plan_name' => $last_invoice_plan_name,
            'last_invoice_plan_amount' => $last_invoice_plan_amount,
            'status_code' => 200,
            'msg' => trans('words.profile'),
            'success' => 1
        ));
    }

    public function provider_profile_update(Request $request)
    { 
         //$data =  \Request::except(array('_token'));
         
        $inputs = $request->all();
         //dd($inputs);
        //exit;
        //echo $inputs['data'];
        $get_data=checkSignSalt($inputs['data']);

          
        $user_id=$get_data['user_id'];    
        $user_obj = User::findOrFail($user_id);

        $icon = $request->file('user_image');
        
                 
        if($icon){

            \File::delete(public_path('/upload/').$user_obj->user_image);            

            //$tmpFilePath = public_path().'/upload/';
            $tmpFilePath = public_path('/upload/');

            $hardPath =  Str::slug($get_data['name'], '-').'-'.md5(time());

            $img = Image::make($icon);

            $img->fit(250, 250)->save($tmpFilePath.$hardPath.'-b.jpg');
            //$img->fit(80, 80)->save($tmpFilePath.$hardPath. '-s.jpg');

            $user_obj->user_image = $hardPath.'-b.jpg';
        }

          
        
        $user_obj->name = $get_data['name'];          
        $user_obj->email = $get_data['email']; 
        $user_obj->phone = $get_data['phone'];
         
        $user_obj->city = $get_data['city'];
        $user_obj->address = $get_data['address'];

        $user_obj->company_website = $get_data['company_website'];
        $user_obj->company_working_day = $get_data['company_working_day'];
        $user_obj->company_working_time = $get_data['company_working_time'];
        $user_obj->company_info = $get_data['company_info'];
        
        $user_obj->save();

        $user_id=$get_data['user_id'];    
        $user = User::findOrFail($user_id);

        if($user->user_image!='')
        {
            $user_image=\URL::asset('upload/'.$user->user_image);
        }
        else
        {
            $user_image=\URL::asset('images/profile.png');
        }

        $response = array('user_id' => $user_id,'name' => $user->name,'email' => $user->email,'phone' => $user->phone,'user_image' => $user_image);
 
        return \Response::json(array(            
            'JOBS_APP' => $response,
            'status_code' => 200,
            'msg' => trans('words.successfully_updated'),
            'success' => 1
        ));
    }

    public function password_update(Request $request)
    { 
         //$data =  \Request::except(array('_token'));
         
        $inputs = $request->all();
         
        $get_data=checkSignSalt($inputs['data']);
          
        $user_id=$get_data['user_id'];    
        $user_obj = User::findOrFail($user_id);

        if(!\Hash::check($get_data['old_password'], $user_obj->password))
        {
            return \Response::json(array(            
                'status_code' => 200,
                'msg' => trans('words.old_wrong_pass'),
                'success' => 0
            ));
        }
        else
        {

            if($get_data['new_password']!=$get_data['confirm_password'])
            {
                return \Response::json(array(            
                    'status_code' => 200,
                    'msg' => trans('words.confirm_pass_not_match'),
                    'success' => 0
                ));
            }
            else
            {
                $user_obj->password = bcrypt($get_data['new_password']); 
         
                $user_obj->save();

                return \Response::json(array(            
                    'status_code' => 200,
                    'msg' => trans('words.successfully_updated'),
                    'success' => 1
                ));
            }
            
        }
  
        
    }

    public function user_favourite_post_list()
    {   
        
        $get_data=checkSignSalt($_POST['data']);

        $user_id=$get_data['user_id'];

        
        $data_list= Favourite::where('post_type','Jobs')->where('user_id',$user_id)->orderby('id','DESC')->paginate($this->pagination_limit);
        $total_records= Favourite::where('post_type','Jobs')->where('user_id',$user_id)->count();
        
        if($data_list->currentPage() == $data_list->lastPage())
        {
            $load_more=false;  
        }
        else
        {
            $load_more=true;  
        }

        if($total_records > 0)
        {

            foreach($data_list as $obj_data)
            {   
                $post_id=$obj_data->post_id;

                if(Jobs::getJobsInfo($post_id,'status')==1)
                { 
                   
                    $post_title= Jobs::getJobsInfo($post_id,'title');
                    $post_image= \URL::to('/'.Jobs::getJobsInfo($post_id,'image'));
                    $address=stripslashes(Jobs::getJobsInfo($post_id,'address'));

                    $location_id=Jobs::getJobsInfo($post_id,'location_id');

                    $location= Location::getLocationInfo($location_id,'name');
                    $designation=Jobs::getJobsInfo($post_id,'designation');
                    $salary=Jobs::getJobsInfo($post_id,'salary');
                    $skills=stripslashes(Jobs::getJobsInfo($post_id,'skills'));

                    $favourite=check_favourite("Jobs",$post_id,isset($get_data['user_id'])?$get_data['user_id']:"");

                    $response[]=array('post_id'=>$post_id,'post_title'=>$post_title,'post_image'=>$post_image,'location'=>$location,'address'=>$address,'designation'=>$designation,'salary'=>$salary,'skills'=>$skills,'favourite'=>$favourite);
                }
 
            }
        }
        else
        {
            $response=array();
        }
 
         return \Response::json(array(            
            'JOBS_APP' => $response,
            'total_records' => $total_records,
            'load_more' => $load_more,
            'status_code' => 200,
            'success' => 1
        ));

    }

    
    public function user_reports()
    { 
         
        $get_data=checkSignSalt($_POST['data']);

        $user_id = $get_data['user_id'];
        $post_id = $get_data['post_id'];
        $post_type = $get_data['post_type'];
 
        $message = $get_data['message']; 
         
        $re_obj = new Reports;

        $re_obj->post_type = $post_type;
        $re_obj->post_id = $post_id;
        $re_obj->user_id = $user_id;
        $re_obj->message = $message;
        $re_obj->date = strtotime(date('m/d/Y H:i:s'));
        $re_obj->save();

            
        $response=array();
         
         return \Response::json(array(            
            'JOBS_APP' => $response,
            'status_code' => 200,
            'msg' => trans('words.reports_success'),
            'success' => 1
        ));
        
    }

    public function user_applied_job()
    { 
         
        $get_data=checkSignSalt($_POST['data']);

        $user_id = $get_data['user_id'];
        $post_id = $get_data['post_id'];

         
        if(user_plan_limit_check($user_id)!="true")
        {
              
            $msg = user_plan_limit_check($user_id);

            return \Response::json(array(            
                'status_code' => 200,
                'msg' => $msg,
                'success' => 0
            ));    
        }
        
        $apply_info=AppliedUsers::where('post_id',$post_id)->where('user_id',$user_id)->first();
        
        if($apply_info)
        {
            $response=array();
            
            return \Response::json(array(            
                'JOBS_APP' => $response,
                'status_code' => 200,
                'msg' => trans('words.applied_already'),
                'success' => 2
            ));
        }
        else
        {
            $ap_obj = new AppliedUsers;

            $ap_obj->post_id = $post_id;
            $ap_obj->user_id = $user_id;
            $ap_obj->date = strtotime(date('m/d/Y H:i:s'));
            $ap_obj->save();

                
            $response=array();
            
            return \Response::json(array(            
                'JOBS_APP' => $response,
                'status_code' => 200,
                'msg' => trans('words.applied_job_success'),
                'success' => 1
            ));
        }
          
    }

    public function user_applied_job_list()
    {   
        
        $get_data=checkSignSalt($_POST['data']);

        $user_id=$get_data['user_id'];

        
        $data_list= AppliedUsers::where('user_id',$user_id)->orderby('id','DESC')->paginate($this->pagination_limit);
        $total_records= AppliedUsers::where('user_id',$user_id)->count();

        if($data_list->currentPage() == $data_list->lastPage())
       {
            $load_more=false;  
       }
       else
       {
            $load_more=true;  
       }

        if($total_records > 0)
        {

            foreach($data_list as $obj_data)
            { 
                $post_id=$obj_data->post_id;
                
                 if(Jobs::getJobsInfo($post_id,'status')==1)
                 { 
                    
                    $post_title= Jobs::getJobsInfo($post_id,'title');
                    $post_image= \URL::to('/'.Jobs::getJobsInfo($post_id,'image')); 
                    
                    $location_id= Jobs::getJobsInfo($post_id,'location_id');

                    $location= Location::getLocationInfo($location_id,'name');
                     
                    $applied_date=date('d M Y',$obj_data->date);
                    $applied_status=$obj_data->status?'true':'false';

                    $response[]=array("post_id"=>$post_id,"post_title"=>stripslashes($post_title),"post_image"=>$post_image,"location"=>$location,"applied_date"=>$applied_date,"applied_status"=>$applied_status); 
                 }
                 
            }
        }
        else
        {
            $response=array();
        }
 
         return \Response::json(array(            
            'JOBS_APP' => $response,
            'total_records' => $total_records,
            'load_more' => $load_more,
            'status_code' => 200,
            'success' => 1
        ));

    }

    public function check_user_plan()
    {
        $get_data=checkSignSalt($_POST['data']);

        $user_id=$get_data['user_id'];

        $user_info = User::where('id',$user_id)->first();
        $user_plan_id=$user_info->plan_id;
        $user_plan_exp_date=$user_info->exp_date;
        

        if($user_plan_id==0)
        {          
            //\Session::flash('flash_message', 'Login status reset!');
            $response = array();

            return \Response::json(array(            
            'JOBS_APP' => $response,
            'status_code' => 200,
            'msg' => trans('words.select_sub_plan'),
            'success' => 0
            ));
        }
        else if(strtotime(date('m/d/Y'))>$user_plan_exp_date)
        {
 
                $current_plan=SubscriptionPlan::getSubscriptionPlanInfo($user_plan_id,'plan_name');

                $plan_job_limit=SubscriptionPlan::getSubscriptionPlanInfo($user_plan_id,'plan_job_limit');

                $total_jobs = Jobs::where('user_id',$user_id)->count();

                if($total_jobs >= $plan_job_limit)
                { 
                    $job_limit_reached='yes';
 
                }
                else
                {
                    $job_limit_reached='no';
                }
                
                $expired_on=date('d, M Y',$user_plan_exp_date);

                $response = array();

                return \Response::json(array(            
                'JOBS_APP' => $response,
                'current_plan' => $current_plan,
                'expired_on' => $expired_on,
                'job_limit_reached' => $job_limit_reached,
                'status_code' => 200,
                'msg' => trans('words.renew_sub_plan'),
                'success' => 0                 
                ));
        }
        else
        {
                $current_plan=SubscriptionPlan::getSubscriptionPlanInfo($user_plan_id,'plan_name');

                $plan_job_limit=SubscriptionPlan::getSubscriptionPlanInfo($user_plan_id,'plan_job_limit');

                $total_jobs = Jobs::where('user_id',$user_id)->count();

                if($total_jobs >= $plan_job_limit)
                { 
                    $job_limit_reached='yes';
 
                }
                else
                {
                    $job_limit_reached='no';
                }
                
                $expired_on=date('d, M Y',$user_plan_exp_date);

                $response = array();

                return \Response::json(array(            
                'JOBS_APP' => $response,
                'current_plan' => $current_plan,
                'expired_on' => $expired_on,
                'job_limit_reached' => $job_limit_reached,
                'status_code' => 200,
                'msg' => trans('words.my_subscription'),
                'success' => 1
                ));
        }        
        
        
    }

    public function subscription_plan()
    {
        $get_data=checkSignSalt($_POST['data']);

        $plan_type=$get_data['plan_type'];

        $plan_list = SubscriptionPlan::where('status','1')->where('plan_type',$plan_type)->orderby('id')->get(); 

        $settings = Settings::findOrFail('1'); 

        $currency_code=$settings->currency_code;
        
        if(count($plan_list) > 0)
        {
            foreach($plan_list as $plan_data)
            {
                    $plan_id= $plan_data->id;
                    $plan_name= $plan_data->plan_name;  
                    $plan_duration= SubscriptionPlan::getPlanDuration($plan_data->id);
                    $plan_price= $plan_data->plan_price; 
                    $plan_job_limit= $plan_data->plan_job_limit;                 
                    
                    $response[]=array("plan_id"=>$plan_id,"plan_name"=>$plan_name,"plan_duration"=>$plan_duration,"plan_price"=>$plan_price,"plan_job_limit"=>$plan_job_limit,"currency_code"=>$currency_code);   
            } 
        }
        else
        {
            $response=array();
        }
           

        return \Response::json(array(            
            'JOBS_APP' => $response,
            'status_code' => 200,
            'success' => 1
        ));
    }

     
    public function transaction_add()
    {
        $get_data=checkSignSalt($_POST['data']);

        $plan_id=$get_data['plan_id'];
        $user_id=$get_data['user_id'];
        $payment_id=$get_data['payment_id'];
        $payment_gateway=$get_data['payment_gateway'];

        $plan_info = SubscriptionPlan::where('id',$plan_id)->where('status','1')->first();
        $plan_name=$plan_info->plan_name;
        $plan_days=$plan_info->plan_days;
        $plan_amount=$plan_info->plan_price;

        //User info update        
           
        $user = User::findOrFail($user_id);

        $user_email=$user->email;

        $user->plan_id = $plan_id;                    
        $user->start_date = strtotime(date('m/d/Y'));             
        $user->exp_date = strtotime(date('m/d/Y', strtotime("+$plan_days days")));
                   
        $user->plan_amount = $plan_amount;         
        $user->save();

        //Check duplicate
        $trans_info = Transactions::where('user_id',$user_id)->where('payment_id',$payment_id)->first();

        if($trans_info=="")
        {
            //Transactions info update
            $payment_trans = new Transactions;

            $payment_trans->user_id = $user_id;
            $payment_trans->email = $user_email;
            $payment_trans->plan_id = $plan_id;
            $payment_trans->gateway = $payment_gateway;
            $payment_trans->payment_amount = $plan_amount;
            $payment_trans->payment_id = $payment_id;
            $payment_trans->date = strtotime(date('m/d/Y H:i:s'));                    
            $payment_trans->save();
        }

        $response = array();
        
        return \Response::json(array(            
            'JOBS_APP' => $response,
            'status_code' => 200,
            'msg' => trans('words.payment_success'),
            'success' => 1
        ));
    }

    public function provider_applied_job_list()
    {   
        
        $get_data=checkSignSalt($_POST['data']);

        $provider_id=$get_data['provider_id'];
 
        $data_list = AppliedUsers::select('applied_users.*','jobs.user_id as company_id')
                        ->join('jobs', 'applied_users.post_id', '=', 'jobs.id')
                        ->join('users', 'applied_users.user_id', '=', 'users.id')
                        ->where("jobs.user_id", "$provider_id")                          
                        ->orderBy('applied_users.id','DESC')
                        ->paginate($this->pagination_limit);

        $total_records= AppliedUsers::select('applied_users.*','jobs.user_id as company_id')
        ->join('jobs', 'applied_users.post_id', '=', 'jobs.id')
        ->join('users', 'applied_users.user_id', '=', 'users.id')
        ->where("jobs.user_id", "$provider_id")->count();                

       if($data_list->currentPage() == $data_list->lastPage())
       {
            $load_more=false;  
       }
       else
       {
            $load_more=true;  
       }

        if($total_records > 0)
        {

            foreach($data_list as $obj_data)
            { 
                $applied_id=$obj_data->id;

                $post_id=$obj_data->post_id;
                
                 if(Jobs::getJobsInfo($post_id,'status')==1)
                 { 
                    $user_id = $obj_data->user_id;

                    $user_info = User::where('id',$user_id)->first();  

                    $post_title= Jobs::getJobsInfo($post_id,'title');
                    $user_name = $user_info->name;
                    $user_email = $user_info->email;
                    $user_phone= $user_info->phone?$user_info->phone:'';
                    $user_resume= $user_info->resume?$user_info->resume:'';

                    $applied_date=date('M d Y h:i a',$obj_data->date);
                    $applied_status=$obj_data->status?'SEEN':'NOT SEEN';

                    $response[]=array("applied_id"=>$applied_id,"post_id"=>$post_id,"post_title"=>stripslashes($post_title),"user_name"=>$user_name,"user_email"=>$user_email,"user_phone"=>$user_phone,"user_resume"=>$user_resume,"applied_date"=>$applied_date,"applied_status"=>$applied_status); 
                 }
                 
            }
        }
        else
        {
            $response=array();
        }
 
         return \Response::json(array(            
            'JOBS_APP' => $response,
            'total_records' => $total_records,
            'load_more' => $load_more,
            'status_code' => 200,
            'success' => 1
        ));

    }

    public function provider_applied_status_chanage()
    {
        $get_data=checkSignSalt($_POST['data']);

        $post_id=$get_data['post_id'];

        $data_obj = AppliedUsers::findOrFail($post_id);        
      
        if($data_obj->status==1)
        {
            $data_obj->status = 0; 
            
            $msg="NOT SEEN";
            $response = array();
        }
        else
        {
            $data_obj->status = 1;

            $msg="SEEN";
            $response = array();
        }

        $data_obj->save();   
        
        return \Response::json(array(            
            'JOBS_APP' => $response,
            'msg' => $msg,
            'status_code' => 200,
            'success' => 1
        ));
        
    }

    public function provider_job_add_edit(Request $request)
    { 
        $inputs = $request->all();
         
        $get_data=checkSignSalt($inputs['data']);
        
        $provider_id=$get_data['provider_id'];

        if(!empty($get_data['post_id'])){
           
            $data_obj = Jobs::findOrFail($get_data['post_id']);

            $msg =  trans('words.successfully_updated');

        }else{

            $data_obj = new Jobs;

            $msg =  trans('words.added');

            $data_obj->user_id = $provider_id;
            
        }
          
        $data_obj->cat_id = $get_data['category_id'];
        $data_obj->location_id = $get_data['location_id'];
        $data_obj->title = addslashes($get_data['job_title']);
        $data_obj->description = addslashes($get_data['description']);
        $data_obj->job_type = $get_data['job_type'];
        $data_obj->designation = $get_data['designation'];
        $data_obj->salary = $get_data['salary'];
        $data_obj->company_name = addslashes($get_data['company_name']);
        $data_obj->phone = addslashes($get_data['phone']);
        $data_obj->email = addslashes($get_data['email']);
        $data_obj->website = addslashes($get_data['website']);
        $data_obj->job_work_days = addslashes($get_data['job_work_days']);
        $data_obj->job_work_time = addslashes($get_data['job_work_time']);
        $data_obj->vacancy = addslashes($get_data['vacancy']);
        $data_obj->address = addslashes($get_data['address']);
        $data_obj->experience = addslashes($get_data['experience']);
        $data_obj->qualification = $get_data['qualification'];
        $data_obj->skills = addslashes($get_data['skills']);
        $data_obj->date = strtotime($get_data['date']);
 
        $job_image = $request->file('job_image');        
                
        if($job_image){

            $tmpFilePath = public_path('/upload/');

            $hardPath =  $provider_id.'-'.md5(time());

            $job_img = Image::make($job_image);

            $job_img->save($tmpFilePath.$hardPath.'.jpg');

            $data_obj->image = 'upload/'.$hardPath.'.jpg';
        }
        
         
        $data_obj->status = $get_data['status']; 
        
        $data_obj->save();
 

        $response = array();
        

        return \Response::json(array(            
            'JOBS_APP' => $response,
            'msg' => $msg,
            'status_code' => 200,
            'success' => 1
        ));
    }

    public function provider_job_edit_details()
    {   
        $get_data=checkSignSalt($_POST['data']);

        $post_id=$get_data['post_id'];

        $job_info = Jobs::where('id',$post_id)->first();

        if (!$job_info)
        {
            $msg =  'Something went wrong';
            $response = array();

            return \Response::json(array(            
                'JOBS_APP' => $response,
                'status_code' => 200,
                'msg' => $msg,
                'success' => 0
            ));
        }
                
        $cat_id=$job_info->cat_id?$job_info->cat_id:'';
        $location_id=$job_info->location_id?$job_info->location_id:'';
        $job_title=addslashes($job_info->title);
        $description=addslashes($job_info->description);
        $job_type=$job_info->job_type?$job_info->job_type:'';
        $designation=$job_info->designation?$job_info->designation:'';
        $salary=$job_info->salary?$job_info->salary:'';        
        $company_name=$job_info->company_name?addslashes($job_info->company_name):'';
        $phone=$job_info->phone?addslashes($job_info->phone):'';
        $email=$job_info->email?addslashes($job_info->email):'';
        $website=$job_info->website?addslashes($job_info->website):'';
        $job_work_days=$job_info->job_work_days?addslashes($job_info->job_work_days):'';
        $job_work_time=$job_info->job_work_time?addslashes($job_info->job_work_time):'';
        $vacancy=$job_info->vacancy?addslashes($job_info->vacancy):'';
        $address=$job_info->address?addslashes($job_info->address):'';
        $experience=$job_info->experience?addslashes($job_info->experience):'';
        $qualification=$job_info->qualification?addslashes($job_info->qualification):'';
        $skills=$job_info->skills?addslashes($job_info->skills):'';
        
        $date=$job_info->date?date('m-d-Y', $job_info->date):'';

        if($job_info->image!='')
        {
            $image=\URL::asset('/'.$job_info->image);
        }
        else
        {
            $image='';
        }
         
        $status=$job_info->status;

        $response = array('status' => $status,'cat_id' => $cat_id,'location_id' => $location_id,'job_title' => $job_title,'description' => $description,'salary' => $salary,'job_type' => $job_type,'designation' => $designation,'company_name' => $company_name,'phone' => $phone,'email' => $email,'website' => $website,'job_work_days' => $job_work_days,'job_work_time' => $job_work_time,'vacancy' => $vacancy,'address' => $address,'experience' => $experience,'qualification' => $qualification,'skills' => $skills,'date' => $date,'image' => $image);


        return \Response::json(array(            
            'JOBS_APP' => $response,          
            'status_code' => 200,             
            'success' => 1
        ));
    }

    public function provider_job_list()
    {

        $get_data=checkSignSalt($_POST['data']);

        $provider_id=$get_data['provider_id'];

        $data_list = Jobs::where("user_id", $provider_id)->orderBy('id','DESC')->paginate($this->pagination_limit);

        $total_records = Jobs::where("user_id", $provider_id)->count();

        if($data_list->currentPage() == $data_list->lastPage())
        {
             $load_more=false;  
        }
        else
        {
             $load_more=true;  
        }
 
         if($total_records > 0)
         {
 
             foreach($data_list as $obj_data)
             {  
                     $post_id= $obj_data->id;
                     $category_name= Category::getCategoryInfo($obj_data->cat_id,'category_name');                     
                     $title = stripslashes($obj_data->title);
                     $status= $obj_data->status;  
                     $date=date('M d Y',$obj_data->date);
                     $image = $obj_data->image? \URL::to('/'.$obj_data->image):'';
                    
                     $response[]=array("post_id"=>$post_id,"category_name"=>$category_name,"title"=>$title,"status"=>$status,"date"=>$date,"image"=>$image); 
                   
             }
         }
         else
         {
             $response=array();
         }
  
          return \Response::json(array(            
             'JOBS_APP' => $response,
             'total_records' => $total_records,
             'load_more' => $load_more,
             'status_code' => 200,
             'success' => 1
         ));

    }

    public function provider_job_delete()
    {

        $get_data=checkSignSalt($_POST['data']);

        $provider_id=$get_data['provider_id'];

        $job_id=$get_data['post_id'];

        $job_obj = Jobs::where('id',$job_id)->where('user_id',$provider_id)->delete();


        $msg= trans('words.deleted');
        $success=1;    

         return \Response::json(array(  
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
        ));   

    }

    public function stripe_token_get()
    {

        $get_data=checkSignSalt($_POST['data']);

        $amount=$get_data['amount'];

 
        \Stripe\Stripe::setApiKey(getPaymentGatewayInfo(2,'stripe_secret_key'));


        $customer = \Stripe\Customer::create();
        $ephemeralKey = \Stripe\EphemeralKey::create(
            ['customer' => $customer->id],
            ['stripe_version' => '2020-08-27']
          );

        $currency_code=getcong('currency_code')?getcong('currency_code'):'USD';

        //$amount=10;

        $intent = \Stripe\PaymentIntent::create([
                'amount' => $amount * 100,
                'currency' => $currency_code,
            ]);

        if (!isset($intent->client_secret))
        {   
            $msg = "The Stripe Token was not generated correctly";
            $success = 0;   
            
            return \Response::json(array(   
                'status_code' => 200,
                'msg' => $msg,
                'success' => $success
            ));  
        }
        else
        {
            $id = $intent->id;

            $client_secret = $intent->client_secret;
            $ephemeralKey = $ephemeralKey->secret;
            $customer_id = $customer->id;

            $response=array();

            $msg = "Stripe Token";
            $success = 1;   

            return \Response::json(array(            
                "id"=>$id,
                "stripe_payment_token"=>$client_secret,
                'ephemeralKey' =>$ephemeralKey,
                "customer" => $customer_id,
                'status_code' => 200,
                 'msg' => $msg,
                'success' => $success
            ));  
        }   
          
    }

    public function get_braintree_token()
    {


        require_once(base_path() . '/public/paypal_braintree/lib/Braintree.php');

        $mode=getPaymentGatewayInfo(1,'mode');
        
        if($mode=="sandbox")
        {
            $environment='sandbox';
        }
        else
        {
            $environment='production';
        }


        $merchantId=getPaymentGatewayInfo(1,'braintree_merchant_id');
        $publicKey=getPaymentGatewayInfo(1,'braintree_public_key');
        $privateKey=getPaymentGatewayInfo(1,'braintree_private_key');
 

        $gateway = new \Braintree\Gateway([
                        'environment' => $environment,
                        'merchantId' => $merchantId,
                        'publicKey' => $publicKey,
                        'privateKey' => $privateKey
                        ]);


        $clientToken = $gateway->clientToken()->generate();

            
 
           return \Response::json(array(            
            'client_token' => $clientToken,
            'status_code' => 200,
            'msg' => 'Token created',
            'success' => 1
             ));

    }  

    public function braintree_checkout()
    {

        $get_data=checkSignSalt($_POST['data']); 
         
        require_once(base_path() . '/public/paypal_braintree/lib/Braintree.php');

        $mode=getPaymentGatewayInfo(1,'mode');
        
        if($mode=="sandbox")
        {
            $environment='sandbox';
        }
        else
        {
            $environment='production';
        }
 

        $merchantId=getPaymentGatewayInfo(1,'braintree_merchant_id');
        $publicKey=getPaymentGatewayInfo(1,'braintree_public_key');
        $privateKey=getPaymentGatewayInfo(1,'braintree_private_key');
        $merchantAccountId=getPaymentGatewayInfo(1,'braintree_merchant_account_id');

        $gateway = new \Braintree\Gateway([
                        'environment' => $environment,
                        'merchantId' => $merchantId,
                        'publicKey' => $publicKey,
                        'privateKey' => $privateKey
                        ]);

        $payment_amount=$get_data['payment_amount'];
        $payment_nonce=$get_data['payment_nonce'];

        $result = $gateway->transaction()->sale([
          'amount' => $payment_amount,
          'paymentMethodNonce' => $payment_nonce,
          'merchantAccountId' => $merchantAccountId,
          'options' => [
            'submitForSettlement' => True
          ]
        ]);

        //echo $result->transaction->id;
        
        //dd($result);exit;

        if ($result->success) {

            $paypal_payment_id = $result->transaction->paypal['paymentId'];

            $transaction_id= $result->transaction->id;

            $response = array();

            $msg= "Transaction successful";
            $success=1;

            return \Response::json(array(            
                'transaction_id' => $transaction_id,
                'paypal_payment_id' => $paypal_payment_id,
                'status_code' => 200,
                'msg' => $msg,
                'success' => $success
                 ));

        }
        else
        {
            $response = array();

            $msg= "Transaction failed";
            $success=0;

            return \Response::json(array(            
                'status_code' => 200,
                'msg' => $msg,
                'success' => $success
                 ));
        }
  

    }

    public function razorpay_order_id_get()
    {

        $get_data=checkSignSalt($_POST['data']);

        $user_id=$get_data["user_id"];
        $amount=$get_data['amount']; 

        $razor_key=getPaymentGatewayInfo(3,'razorpay_key');
        $razor_secret=getPaymentGatewayInfo(3,'razorpay_secret');

        $api = new Api($razor_key, $razor_secret);

        $order = $api->order->create(array('receipt' => 'rcptid_'.$user_id, 'amount' => $amount, 'currency' => 'INR'));

        $orderId = $order['id'];

        $msg= "Order ID created";
        $success=1;
         
          
          return \Response::json(array(            
            "order_id"=>$orderId,
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
        ));  
    }
    
    public function payumoney_hash_generator()
    {
        
        $get_data=checkSignSalt($_POST['data']); 

        $hashdata=$get_data["hashdata"];
        $salt=getPaymentGatewayInfo(6,'payu_salt');
         
        /***************** DO NOT EDIT ***********************/
        $payhash_str = $hashdata.$salt;

        
        $hash = strtolower(hash('sha512', $payhash_str));
        /***************** DO NOT EDIT ***********************/

        $msg= "Hash created";
        $success=1;

  
          return \Response::json(array(            
            "payu_hash"=>$hash,
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
        ));
         
    }

    public function paystack_token_get()
    {

        $get_data=checkSignSalt($_POST['data']);

        $paystack_secret_key=getPaymentGatewayInfo(4,'paystack_secret_key');

        $email=$get_data['email'];
        $amount=$get_data['amount']*100;

        $url = "https://api.paystack.co/transaction/initialize";

        $fields = [
            'email' => $email,
            'amount' => $amount,
        ];

        $fields_string = http_build_query($fields);

        //open connection
        $ch = curl_init();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: Bearer ".$paystack_secret_key,
            "Cache-Control: no-cache",
        ));
        
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 
        
        //execute post
        $result = curl_exec($ch);

        $tranx = json_decode($result, true);
          //dd($tranx);
          
            $access_code = $tranx['data']['access_code'];
            $reference = $tranx['data']['reference'];

            $response=array();

            $msg = "Paystack access code";
            $success = 1;   

            return \Response::json(array(            
                "access_code"=>$access_code,
                "reference" => $reference,
                'status_code' => 200,
                 'msg' => $msg,
                'success' => $success
            ));  
         
    }

    public function account_delete()
    { 

        $get_data=checkSignSalt($_POST['data']);

        $user_id=$get_data['user_id']; 

        $fav_obj = Favourite::where('user_id',$user_id)->delete();
        $app_obj = AppliedUsers::where('user_id',$user_id)->delete();
        $rep_obj = Reports::where('user_id',$user_id)->delete();
        
        $user = User::findOrFail($user_id);   
       

         //Account Delete Email
         if(getenv("MAIL_USERNAME"))
         {
             $user_name=$user->name;
             $user_email=$user->email;
 
             $data_email = array(
                 'name' => $user_name,
                 'email' => $user_email
                 );    
 
             \Mail::send('emails.account_delete', $data_email, function($message) use ($user_name,$user_email){
                 $message->to($user_email, $user_name)
                 ->from(getcong('app_email'), getcong('app_name'))
                 ->subject(trans('words.user_dlt_email_subject'));
             });    
         }

         $user->delete();

          
        $msg= trans('words.user_dlt_success');
        $success=1;    

         return \Response::json(array(  
            'status_code' => 200,
            'msg' => $msg,
            'success' => $success
        ));        
        
    }
  
}
