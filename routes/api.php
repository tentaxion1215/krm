<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1','namespace' => 'API'], function(){
     
    Route::get('/', 'AndroidApiController@index');
    Route::post('app_details', 'AndroidApiController@app_details');
    Route::post('payment_settings', 'AndroidApiController@payment_settings');
    
    Route::post('home', 'AndroidApiController@home');
    Route::post('company_list', 'AndroidApiController@company_list');
    Route::post('latest_jobs', 'AndroidApiController@latest_jobs');
    Route::post('recently_view', 'AndroidApiController@recently_view');
    Route::post('recommend_jobs', 'AndroidApiController@recommend_jobs');
        
    Route::post('category', 'AndroidApiController@category');
    
    Route::post('jobs_by_cat', 'AndroidApiController@jobs_by_cat'); 
    Route::post('jobs_details', 'AndroidApiController@jobs_details'); 

    Route::post('jobs_search', 'AndroidApiController@jobs_search'); 

    Route::post('jobs_filter', 'AndroidApiController@jobs_filter'); 

    Route::post('jobs_by_company', 'AndroidApiController@jobs_by_company'); 

    Route::post('cat_loc_comp_list', 'AndroidApiController@cat_loc_comp_list'); 
    /*
    Route::post('books_reviews_list', 'AndroidApiController@books_reviews_list'); 

    Route::post('search_book', 'AndroidApiController@search_book');*/
     
    Route::post('post_view', 'AndroidApiController@post_view');
    Route::post('post_rate', 'AndroidApiController@post_rate');
    Route::post('post_favourite', 'AndroidApiController@post_favourite');

  
    Route::post('login', 'AndroidApiController@login');
    Route::post('signup', 'AndroidApiController@signup');
    Route::post('social_login', 'AndroidApiController@social_login');
    Route::post('forgot_password', 'AndroidApiController@forgot_password');

    Route::post('profile', 'AndroidApiController@profile');
    Route::post('profile_update', 'AndroidApiController@profile_update');

    Route::post('provider_profile', 'AndroidApiController@provider_profile');
    Route::post('provider_profile_update', 'AndroidApiController@provider_profile_update');

    Route::post('password_update', 'AndroidApiController@password_update');

    Route::post('account_delete', 'AndroidApiController@account_delete');

    Route::post('user_favourite_post_list', 'AndroidApiController@user_favourite_post_list'); 
    Route::post('user_reports', 'AndroidApiController@user_reports');
    Route::post('user_applied_job', 'AndroidApiController@user_applied_job');
    Route::post('user_applied_job_list', 'AndroidApiController@user_applied_job_list');
    
    Route::post('check_user_plan', 'AndroidApiController@check_user_plan');
    Route::post('subscription_plan', 'AndroidApiController@subscription_plan');
    Route::post('transaction_add', 'AndroidApiController@transaction_add');

    Route::post('stripe_token_get', 'AndroidApiController@stripe_token_get');
    Route::post('get_braintree_token', 'AndroidApiController@get_braintree_token');
    Route::post('braintree_checkout', 'AndroidApiController@braintree_checkout');
    Route::post('razorpay_order_id_get', 'AndroidApiController@razorpay_order_id_get');
    Route::post('get_payu_hash', 'AndroidApiController@payumoney_hash_generator');
    Route::post('paystack_token_get', 'AndroidApiController@paystack_token_get');

    Route::post('provider_applied_job_list', 'AndroidApiController@provider_applied_job_list');

    Route::post('provider_applied_status_chanage', 'AndroidApiController@provider_applied_status_chanage');

    Route::post('provider_job_add_edit', 'AndroidApiController@provider_job_add_edit');
    Route::post('provider_job_edit_details', 'AndroidApiController@provider_job_edit_details');

    Route::post('provider_job_list', 'AndroidApiController@provider_job_list');

    Route::post('provider_job_delete', 'AndroidApiController@provider_job_delete');

 });
