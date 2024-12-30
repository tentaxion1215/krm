<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Category;
use App\Location;
use App\Jobs;
use App\Reports;
use App\Pages;
use App\Favourite;
use App\PostRatings;
use App\PostViewsDownload;
use App\SubscriptionPlan;
use App\AppAds;
use App\PaymentGateway;
use App\AppliedUsers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str; 

class ActionsController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
          
    }
 

    public function ajax_status(Request $request)
    {  
       
       //$data =  \Request::except(array('_token'));

        $inputs = $request->all(); 
        //dd($inputs);exit;

        $post_id=$inputs['id'];
        $value=$inputs['value'];
        $action_for=$inputs['action_for'];
        
        if($action_for=="cat_status")
        {

            $data_obj = Category::findOrFail($post_id);        
     
            if($value=="true")
            {
                $data_obj->status = 1; 
            }
            else
            {
                $data_obj->status = 0; 
            }        
             
            $data_obj->save();             
            $response['status'] = 1;
            
        }       
        else if($action_for=="job_status")
        {

            $data_obj = Jobs::findOrFail($post_id);        
     
            if($value=="true")
            {
                $data_obj->status = 1; 
            }
            else
            {
                $data_obj->status = 0; 
            }        
             
            $data_obj->save();             
            $response['status'] = 1;
            
        } 
        else if($action_for=="applied_status")
        {

            $data_obj = AppliedUsers::findOrFail($post_id);        
     
             
            if($data_obj->status==1)
            {
                $data_obj->status = 0; 
                $response['set_val'] = '<span class="badge badge-danger">NOT SEEN</span>';
            }
            else
            {
                $data_obj->status = 1;
                $response['set_val'] = '<span class="badge badge-success">SEEN</span>';
            }
             
            $data_obj->save();             
            $response['status'] = 1;
            
        }         
        else if($action_for=="ads_status")
        {

            $data_obj = AppAds::findOrFail($post_id);        
     
            if($value=="true")
            {
                $data_obj->status = 1; 

                //Other Ads Disable
                AppAds::where('id','!=', $post_id)->update(['status' => 0]);
            }
            else
            {
                $data_obj->status = 0; 
            }        
             
            $data_obj->save();             
            $response['status'] = 1;
            
        }     
        else if($action_for=="payment_status")
        {

            $data_obj = PaymentGateway::findOrFail($post_id);        
     
            if($value=="true")
            {
                $data_obj->status = 1; 
 
            }
            else
            {
                $data_obj->status = 0; 
            }        
             
            $data_obj->save();             
            $response['status'] = 1;
            
        }    
        else
        {
            $response['status'] = 0;
        }     

        echo json_encode($response);
        exit;   
    }

    public function ajax_delete(Request $request)
    {  
        
        $inputs = $request->all(); 
        //dd($inputs);exit;

        if(!isset($inputs['id']))
        {
            $response['status'] = 0;           
              
            echo json_encode($response);
            exit;

        }
        
        if(is_array($inputs['id']))
        {
            $post_ids=$inputs['id'];
        }
        else
        {
            $post_id=$inputs['id'];
        }

        //echo $post_id;exit;
         
        //$post_id=$inputs['id'];
        $action_for=$inputs['action_for'];
        
        if($action_for=="cat_delete")
        {
            $data_obj = Category::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        }         
        else if($action_for=="location_delete")
        {
            $data_obj = Location::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        }         
        else if($action_for=="job_delete")
        {
            $fav_obj = Favourite::where('post_id',$post_id)->delete();
            $app_obj = AppliedUsers::where('post_id',$post_id)->delete();
            $rep_obj = Reports::where('post_id',$post_id)->delete();

            $data_obj = Jobs::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        } 
        else if($action_for=="job_delete_selected")
        {
            foreach($post_ids as $pid){
               
			   $fav_obj = Favourite::where('post_id',$pid)->delete();
                $app_obj = AppliedUsers::where('post_id',$pid)->delete();
                $rep_obj = Reports::where('post_id',$pid)->delete();
                 
                $data_obj = Jobs::findOrFail($pid);
                $data_obj->delete();

            }
            
            $response['status'] = 1;
        }
        else if($action_for=="applied_delete")
        {
            $data_obj = AppliedUsers::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        }
        else if($action_for=="plan_delete")
        {
            $data_obj = SubscriptionPlan::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        }        
        else if($action_for=="report_delete")
        {
            $data_obj = Reports::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        }
        else if($action_for=="page_delete")
        {
            $data_obj = Pages::findOrFail($post_id);
            $data_obj->delete(); 
             
            $response['status'] = 1;            
        }
        else if($action_for=="user_delete")
        {
            if($post_id==1)
            { 
                $response['status'] = 0;
            }
            else
            {
                $fav_obj = Favourite::where('user_id',$post_id)->delete();
                $app_obj = AppliedUsers::where('user_id',$post_id)->delete();
                $rep_obj = Reports::where('user_id',$post_id)->delete();

                $data_obj = User::findOrFail($post_id);
                $data_obj->delete(); 
             
                $response['status'] = 1;     
            }
                   
        }   
        else
        {
            $response['status'] = 0;            
        }     

        echo json_encode($response);
        exit;    
             
    }
     
}
