@extends("admin.admin_app")

@section("content")
 <?php $base_url=\URL::to('/').'/api/v1/';?>
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12">
              <div class="card-box" style="color: #a9b7c6;">
                <h3 style="font-weight: 600;">APIs</h3>
                 <code style="color: #a9b7c6;background: #2b3751;padding: 5px 10px;font-size: 14px;font-weight: 600;"> API URL  {{$base_url}}</code><br/><br/>
                  <b>App Details:</b>  (Method: app_details)<br/><br/>
  
                  <br/>
                  <b>Payment Settings:</b> (Method: payment_settings) <br/><br/>

                  <b>Home:</b> (Method: home) (Parameter: user_id)<br/><br/>                 
                  
                  <b>Company List:</b> (Method: company_list)  <br/><br/>

                  <b>Latest Jobs:</b> (Method: jobs_by_cat) (Parameter: cat_id, user_id)  <br/><br/>

                  <b>Recommend Jobs:</b> (Method: recommend_jobs) (Parameter: user_id)  <br/><br/>

                  <b>Recently View:</b> (Method: recently_view) (Parameter: user_id)  <br/><br/>

                  <b>Category List:</b> (Method: category) <br/><br/>
                  
                   <b>Jobs by Category:</b> (Method: jobs_by_cat) (Parameter: cat_id, user_id)  <br/><br/>
                 
                  <b>Jobs Details:</b> (Method: jobs_details) (Parameter: job_id, user_id)  <br/><br/>

                  <b>Jobs Search:</b> (Method: jobs_search) (Parameter: search_text, user_id)  <br/><br/>
 
                  <b>Category, Location, Company List :</b> (Method: cat_loc_comp_list) <br/><br/>

                  <b>Jobs Filter:</b> (Method: jobs_filter)(Parameter: user_id, search_text, cat_ids(1,2), location_ids(1,2),company_ids(1,2), salary_start, salary_end, job_type(Contract, Freelance, Full Time, Internship, Part Time), qualification(Bachelors, Masters, MPhil/MS, PHD/Doctorate, Certification, Diploma, Short Course)) <br/><br/>

                  <b>Jobs by Company:</b> (Method: jobs_by_company) (Parameter: company_id, user_id)  <br/><br/>
                  
                  <b>Post Views:</b> (Method: post_view) (Parameter: post_id, post_type(Jobs)) <br/><br/>
                    
                  <b>Post Favourite:</b> (Method: post_favourite) (Parameter: user_id, post_id,post_type(Jobs))<br/><br/>
                                     
 
                  <b>Login:</b> (Method: login) (Parameter: email, password)<br/><br/>
                  <b>Signup:</b> (Method: signup) (Parameter: usertype(User or Company), name, email, password, phone)<br/><br/>
                  <b>Social Login:</b> (Method: social_login) (Parameter: login_type(google or facebook), social_id, name, email)<br/><br/>
                  <b>Forgot Password:</b> (Method: forgot_password) (Parameter: email)<br/><br/>
                  <b>Profile:</b> (Method: profile) (Parameter: user_id)<br/><br/>
                  <b>Profile Update:</b> (Method: profile_update) (Parameter: user_id, name,email, phone, city, address, date_of_birth, gender, current_company, skills, experience, user_image)<br/><br/>

                  <b>Provider Profile:</b> (Method: provider_profile) (Parameter: user_id)<br/><br/>
                  <b>Provider Update:</b> (Method: provider_profile_update) (Parameter: user_id, name,email, phone, city, address, company_website, company_working_day, company_working_time, company_info, user_image)<br/><br/>

                  <b>Password Update:</b> (Method: password_update) (Parameter: user_id, old_password, new_password, confirm_password)<br/><br/>
                  
                  <b>User Favourite Jobs:</b> (Method: user_favourite_post_list) (Parameter: user_id)<br/><br/>
                   
                  <b>User Report:</b> (Method: user_reports) (Parameter: user_id, post_id, post_type(Jobs), message)<br/><br/>

                  <b>User Applied Job:</b> (Method: user_applied_job) (Parameter: user_id, post_id)<br/><br/>

                  <b>User Applied Job List:</b> (Method: user_applied_job_list) (Parameter: user_id)<br/><br/>

                  <b>Check User Plan:</b> (Method: check_user_plan) (Parameter: user_id)<br/><br/>
                  <b>Subscription Plan:</b> (Method: subscription_plan)(Parameter: plan_type(Seeker,Provider)) <br/><br/>
                  <b>Transaction Add:</b> (Method: transaction_add) (Parameter: plan_id, user_id, payment_id, payment_gateway) <br/><br/>                   
                  
                  <b>Stripe Token Get:</b> (Method: stripe_token_get) (Parameter: amount)<br/><br/>
                  <b>Braintree Token Get:</b> (Method: get_braintree_token)<br/><br/>
                  <b>Braintree Checkout:</b> (Method: braintree_checkout) (Parameter: payment_amount, payment_nonce)<br/><br/>
                  <b>Razorpay Order ID Get:</b> (Method: razorpay_order_id_get) (Parameter: amount,user_id)<br/><br/>
                  <b>Payu Hash Get:</b> (Method: get_payu_hash) (Parameter: hashdata)<br/><br/>
                  <b>Paystack Token Get:</b> (Method: paystack_token_get) (Parameter: email, amount)<br/><br/>

                  <b>Provider Applied Job List:</b> (Method: provider_applied_job_list) (Parameter: provider_id)<br/><br/>

                  <b>Provider Applied Job Status Change:</b> (Method: provider_applied_status_chanage) (Parameter: post_id)<br/><br/>

                  <b>Provider Job Add/Edit:</b> (Method: provider_job_add_edit) (Parameter: post_id(when edit), provider_id, category_id, location_id, job_title, description, job_type(Contract, Freelance, Full Time, Internship, Part Time), designation, salary, company_name, phone, email, website, job_work_days, job_work_time, vacancy, address, experience, qualification(Bachelors, Masters, MPhil/MS, PHD/Doctorate, Certification, Diploma, Short Course), skills, date(m-d-Y), status, job_image)<br/><br/>

                  <b>Provider Job Edit Details:</b> (Method: provider_job_edit_details) (Parameter: post_id)<br/><br/>

                  <b>Provider Job List:</b> (Method: provider_job_list) (Parameter: provider_id)<br/><br/>

                  <b>Provider Job Delete:</b> (Method: provider_job_delete) (Parameter: post_id, provider_id)<br/><br/>
              </div>
 
            </div>
          </div>
        </div>
      </div>
      @include("admin.copyright") 
    </div>

@endsection