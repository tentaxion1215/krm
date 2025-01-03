<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\PaymentGateway;

use App\Http\Requests;
use Illuminate\Http\Request;
use Session;
use Intervention\Image\Facades\Image; 
use Illuminate\Support\Str;

class PaymentGatewayController extends MainAdminController
{
	public function __construct()
    {
		 $this->middleware('auth');
		  
		parent::__construct(); 	
 		  
    }
    public function list()
    { 
        
        if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
        {

            \Session::flash('flash_message', trans('words.access_denied'));

            return redirect('dashboard');
            
        }

        $page_title=trans('words.payment_gateway');
              
        $list = PaymentGateway::orderBy('id')->get();
         
        return view('admin.pages.gateway.list',compact('page_title','list'));
    }
    
    public function edit($post_id)    
    {     
            if(Auth::User()->usertype!="Admin" AND Auth::User()->usertype!="Sub_Admin")
            {

                \Session::flash('flash_message', trans('words.access_denied'));

                return redirect('dashboard');
                
            }  

          
          $post_info = PaymentGateway::findOrFail($post_id);  
            
          $gateway_info=json_decode($post_info->gateway_info);

          //echo $gateway_info->mode;
         // exit; 

          if($post_id==1)
          {
            $page_title='PayPal';

            return view('admin.pages.gateway.paypal',compact('page_title','post_info','gateway_info'));
          }
          else if($post_id==2)
          {
            $page_title='Stripe';

            return view('admin.pages.gateway.stripe',compact('page_title','post_info','gateway_info'));
          }
          else if($post_id==3)
          {
            $page_title='Razorpay';

            return view('admin.pages.gateway.razorpay',compact('page_title','post_info','gateway_info'));
          }
          else if($post_id==4)
          {
            $page_title='Paystack';

            return view('admin.pages.gateway.paystack',compact('page_title','post_info','gateway_info'));
          }          
          else if($post_id==6)
          {
            $page_title='PayUMoney';

            return view('admin.pages.gateway.payu',compact('page_title','post_info','gateway_info'));
          }  
          else if($post_id==8)
          {
            $page_title='Flutterwave';

            return view('admin.pages.gateway.flutterwave',compact('page_title','post_info','gateway_info'));
          }         
          else if($post_id==9)
          {
            $page_title='Paytm';

            return view('admin.pages.gateway.paytm',compact('page_title','post_info','gateway_info'));
          }          
 
    }    
    
    public function paypal(Request $request)
    {
        $data =  \Request::except(array('_token')) ;
        
        $rule=array(
                'gateway_name' => 'required'                
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

           
           
          $mode= $inputs['mode'];
           
          $braintree_merchant_id= $inputs['braintree_merchant_id'];
          $braintree_public_key= $inputs['braintree_public_key'];
          $braintree_private_key= $inputs['braintree_private_key'];
          $braintree_merchant_account_id= $inputs['braintree_merchant_account_id'];

          $gateway_data=json_encode(['mode' => $mode,'braintree_merchant_id' => $braintree_merchant_id,'braintree_public_key' => $braintree_public_key,'braintree_private_key' => $braintree_private_key,'braintree_merchant_account_id' => $braintree_merchant_account_id]);  
 
          $ad_obj->gateway_name = addslashes($inputs['gateway_name']); 
          $ad_obj->gateway_info = $gateway_data;
          
          $ad_obj->status = $inputs['status'];   
          $ad_obj->save();

          \Session::flash('flash_message', trans('words.successfully_updated'));

          return \Redirect::back();
    } 

    public function stripe(Request $request)
    {
        $data =  \Request::except(array('_token')) ;
        
        $rule=array(
                'gateway_name' => 'required'                
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

          $stripe_secret_key= $inputs['stripe_secret_key'];
          $stripe_publishable_key= $inputs['stripe_publishable_key'];

          $gateway_data=json_encode(['stripe_secret_key' => $stripe_secret_key,'stripe_publishable_key' => $stripe_publishable_key]);  
 
          $ad_obj->gateway_name = addslashes($inputs['gateway_name']); 
          $ad_obj->gateway_info = $gateway_data;
          
          $ad_obj->status = $inputs['status'];   
          $ad_obj->save();

          \Session::flash('flash_message', trans('words.successfully_updated'));

          return \Redirect::back();
    }

    public function razorpay(Request $request)
    {
        $data =  \Request::except(array('_token')) ;
        
        $rule=array(
                'gateway_name' => 'required'                
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

          $razorpay_key= $inputs['razorpay_key'];
          $razorpay_secret= $inputs['razorpay_secret'];

          $gateway_data=json_encode(['razorpay_key' => $razorpay_key,'razorpay_secret' => $razorpay_secret]);  
 
          $ad_obj->gateway_name = addslashes($inputs['gateway_name']); 
          $ad_obj->gateway_info = $gateway_data;
          
          $ad_obj->status = $inputs['status'];   
          $ad_obj->save();

          \Session::flash('flash_message', trans('words.successfully_updated'));

          return \Redirect::back();
    }
    
    public function paystack(Request $request)
    {
        $data =  \Request::except(array('_token')) ;
        
        $rule=array(
                'gateway_name' => 'required'                
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

          $paystack_secret_key= $inputs['paystack_secret_key'];
          $paystack_public_key= $inputs['paystack_public_key'];

          $gateway_data=json_encode(['paystack_secret_key' => $paystack_secret_key,'paystack_public_key' => $paystack_public_key]);  
 
          $ad_obj->gateway_name = addslashes($inputs['gateway_name']); 
          $ad_obj->gateway_info = $gateway_data;
          
          $ad_obj->status = $inputs['status'];   
          $ad_obj->save();

          \Session::flash('flash_message', trans('words.successfully_updated'));

          return \Redirect::back();
    }
  
    public function payu(Request $request)
    {
        $data =  \Request::except(array('_token')) ;
        
        $rule=array(
                'gateway_name' => 'required'                
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

          $mode= $inputs['mode'];  
          $payu_merchant_id= $inputs['payu_merchant_id'];  
          $payu_key= $inputs['payu_key'];
          $payu_salt= $inputs['payu_salt'];

          $gateway_data=json_encode(['mode' => $mode,'payu_merchant_id' => $payu_merchant_id,'payu_key' => $payu_key,'payu_salt' => $payu_salt]);  
 
          $ad_obj->gateway_name = addslashes($inputs['gateway_name']); 
          $ad_obj->gateway_info = $gateway_data;
          
          $ad_obj->status = $inputs['status'];   
          $ad_obj->save();

          \Session::flash('flash_message', trans('words.successfully_updated'));

          return \Redirect::back();
    }

    public function flutterwave(Request $request)
    {
        $data =  \Request::except(array('_token')) ;
        
        $rule=array(
                'gateway_name' => 'required'                
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

          $flutterwave_public_key= $inputs['flutterwave_public_key'];
          $flutterwave_secret_key= $inputs['flutterwave_secret_key'];
          $flutterwave_encryption_key= $inputs['flutterwave_encryption_key'];
 
          $gateway_data=json_encode(['flutterwave_public_key' => $flutterwave_public_key,'flutterwave_secret_key' => $flutterwave_secret_key,'flutterwave_encryption_key' => $flutterwave_encryption_key]);  
 
          $ad_obj->gateway_name = addslashes($inputs['gateway_name']); 
          $ad_obj->gateway_info = $gateway_data;
          
          $ad_obj->status = $inputs['status'];   
          $ad_obj->save();

          \Session::flash('flash_message', trans('words.successfully_updated'));

          return \Redirect::back();
    }

    public function paytm(Request $request)
    {
        $data =  \Request::except(array('_token')) ;
        
        $rule=array(
                'gateway_name' => 'required'                
                 );
        
         $validator = \Validator::make($data,$rule);
 
        if ($validator->fails())
        {
                return redirect()->back()->withErrors($validator->messages());
        } 
        $inputs = $request->all();

        $ad_obj = PaymentGateway::findOrFail($inputs['id']);

          $mode= $inputs['mode'];
          $paytm_merchant_id= $inputs['paytm_merchant_id'];
          $paytm_merchant_key= $inputs['paytm_merchant_key'];

          $gateway_data=json_encode(['mode' => $mode,'paytm_merchant_id' => $paytm_merchant_id,'paytm_merchant_key' => $paytm_merchant_key]);  
 
          $ad_obj->gateway_name = addslashes($inputs['gateway_name']); 
          $ad_obj->gateway_info = $gateway_data;
          
          $ad_obj->status = $inputs['status'];   
          $ad_obj->save();

          \Session::flash('flash_message', trans('words.successfully_updated'));

          return \Redirect::back();
    }
 
}
