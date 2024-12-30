@extends("admin.admin_app")

@section("content")

  

<div class="content-page">
      <div class="content">
        <div class="container-fluid">
          
          @if(Auth::User()->usertype=="Admin")  
                <div class="row">
                     
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/category')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-custom" data-plugin="counterup">{{$category}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.categories_text')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/location')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-purple" data-plugin="counterup">{{$location}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.locations')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
 

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/jobs')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-success" data-plugin="counterup">{{$jobs}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.jobs_text')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/applied_users')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-warning" data-plugin="counterup">{{$applied_users}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.applied_users')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/users')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-info" data-plugin="counterup">{{$job_seekers}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.job_seeker')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/company')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-pink" data-plugin="counterup">{{$job_providers}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.job_provider')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                     

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/reports')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-dark" data-plugin="counterup">{{$reports}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.reports')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/transactions')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-danger" data-plugin="counterup">{{$transactions}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.transactions')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
 
                </div> 

                  
                <div class="row">
                <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            

                            <h4 class="header-title mt-0 m-b-5">{{trans('words.latest_jobs')}}</h4>
                            <p class="text-muted m-b-20">&nbsp;</p>

                            <div class="inbox-widget nicescroll" style="height: 315px; overflow: hidden; outline: none;" tabindex="5000">

                                @foreach($latest_jobs as $latest_data)
                                 
                                <a href="Javascript::void(0);" class="text-inverse">
                                
                                <p class="font-600 m-b-5 " data-toggle="tooltip" data-html="true" data-placement="right" title=''>  
                                    {{Str::limit(stripslashes($latest_data->title), 25)}} 
                                     
                                    <span class="badge badge-danger pull-right">{{number_format_short(post_views_count($latest_data->id,"Jobs"))}} {{trans('words.views')}}  </span>
                                </p>

                                </a>

                                @endforeach
                                 
                            </div>
                        </div>
                </div>
                <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            

                            <h4 class="header-title mt-0 m-b-5">{{trans('words.trending_now')}}</h4>
                            <p class="text-muted m-b-20">{{trans('words.based_on_30_days')}}</p>

                            <div class="inbox-widget nicescroll" style="height: 315px; overflow: hidden; outline: none;" tabindex="5000">

                                @foreach($trending_now as $trending_data)
                                 
                                <a href="Javascript::void(0);" class="text-inverse">
                                
                                <p class="font-600 m-b-5 " data-toggle="tooltip" data-html="true" data-placement="right" title=''>  
                                    {{Str::limit(stripslashes(\App\Jobs::getJobsInfo($trending_data->post_id,'title')), 25)}} 
                                     
                                    <span class="badge badge-danger pull-right">{{number_format_short($trending_data->total_views)}} {{trans('words.views')}}  </span>
                                </p>

                                </a>

                                @endforeach
                                 
                            </div>
                        </div>
                </div>
                 

                <div class="col-xl-4 col-md-6">
                    <div class="card-box">
                        

                        <h4 class="header-title mt-0 m-b-5">{{trans('words.top_country')}}</h4>
                        <p class="text-muted m-b-20">{{trans('words.based_on_30_days')}}</p>
                      
                        <div class="inbox-widget nicescroll" style="height: 315px; overflow: hidden; outline: none;" tabindex="5000">

                            @foreach($top_country as $country_data)

                            <p class="font-600 m-b-5"><img src="{{ URL::asset('admin_assets/country_icons/').'/'.strtolower(countryNameToISO3166($country_data->country,'US')) }}.png" alt="" style="width:20px;"> &nbsp;{{$country_data->country}} <span class="badge badge-success pull-right">{{number_format_short($country_data->count_row)}} <i class="fa fa-eye"></i></span></p>

                            @endforeach
 
                             
                        </div>
                    </div>
                </div>

                <div class="col-xl-4 col-md-6">
                        <div class="card-box">
                            

                            <h4 class="header-title mt-0 m-b-5">{{trans('words.latest_applied_jobs')}}</h4>
                            <p class="text-muted m-b-20">&nbsp;</p>

                            <div class="inbox-widget nicescroll" style="height: 315px; overflow: hidden; outline: none;" tabindex="5000">

                            @foreach($applied_users_list as $applied_data)
                            <a href="Javascript::void(0);" >
                                <div class="inbox-item">
                                    <div class="inbox-item-img">
                                    @if(isset(\App\User::getUserInfo($applied_data->user_id)->user_image))                                 
 
                                    <img src="{{URL::to('upload/'.\App\User::getUserInfo($applied_data->user_id,'user_image'))}}" alt="person" class="rounded-circle"/>
                                    
                                    @else
                                        
                                    <img src="{{ URL::asset('admin_assets/images/users/avatar-10.jpg') }}" alt="person" class="rounded-circle"/>
                                    
                                    @endif    
                                     
                                    </div>
                                    <p class="inbox-item-author" style="color: #fff;">{{ \App\User::getUserInfo($applied_data->user_id,'name') }}</p>
                                    <p class="inbox-item-text">{{Str::limit(stripslashes(\App\Jobs::getJobsInfo($applied_data->post_id,'title')), 70)}}</p>
                                    <p class="inbox-item-date">{{date('M d, Y',$applied_data->date)}}</p>
                                </div>
                            </a>
                            @endforeach

                                  
                                 
                            </div>
                        </div>
                </div>

                  

                <div class="col-xl-8 col-md-6">
                <div class="card-box">
                         
                         <h4 class="header-title mt-0 m-b-30">{{trans('words.latest_reports')}}</h4>

                         <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th style="width: 15%;">&nbsp;</th>
                                                <th style="width: 15%;">{{trans('words.name')}}</th>
                                                <th style="width: 40%;">{{trans('words.message')}}</th>
                                                <th style="text-align: center">Date</th>
                                                <th>&nbsp;</th> 
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($reports_list as $reports_data)    
                                             
                                            <tr>
                                                    <td>
                                                    <div class="inbox-item-img">
                                                    @if(isset(\App\User::getUserInfo($reports_data->user_id)->user_image))
                                                    <img src="{{URL::to('upload/'.\App\User::getUserInfo($reports_data->user_id)->user_image)}}" class="rounded-circle" alt="" width="50">
                                                    @else
                                                    <img src="{{URL::to('upload/profile.jpg')}}" class="rounded-circle" alt="" width="50">
                                                    @endif                                         
                                                    </div>
                                                    </td>
                                                    <td>
                                                    <p class="inbox-item-author" style="color:#fff;">{{\App\User::getUserFullname($reports_data->user_id)}}</p>
                                                    </td>
                                                    <td>
                                                        <p class="inbox-item-text">{{Str::limit($reports_data->message,70)}}</p>
                                                    </td>
                                                     <td style="text-align: center">
                                                        <span class="badge badge-success">{{ date('m-d-Y h:i a',$reports_data->date) }}</span>
                                                    </td>
                                                    <td>
                                                    <a href="{{URL::to('admin/reports')}}" class="btn btn-icon waves-effect waves-light btn-purple"> <i class="fa fa-info"></i> </a>
                                                    </td>
                                                 </tr>
                                                 
                                            @endforeach       
                                        

                                            </tbody>
                                        </table>
                                    </div>
 
                          
                     </div>
                </div><!-- end col-->
 
                       
          </div>
          
          @else

                <div class="row">
                     
                <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/category')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-custom" data-plugin="counterup">{{$category}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.categories_text')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/location')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-purple" data-plugin="counterup">{{$location}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.locations')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
 

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/jobs')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-success" data-plugin="counterup">{{$jobs}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.jobs_text')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/applied_users')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-warning" data-plugin="counterup">{{$applied_users}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.applied_users')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/users')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-info" data-plugin="counterup">{{$job_seekers}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.job_seeker')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/company')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-pink" data-plugin="counterup">{{$job_providers}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.job_provider')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                     

                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/reports')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-dark" data-plugin="counterup">{{$reports}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.reports')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="{{URL::to('admin/transactions')}}">
                        <div class="card-box widget-user">
                            <div class="text-center">
                                <h2 class="text-danger" data-plugin="counterup">{{$transactions}}</h2>
                                <h5 style="color: #f9f9f9;">{{trans('words.transactions')}}</h5>
                            </div>
                        </div>
                        </a>
                    </div>
                    
                    
                </div> 


          @endif 
        
        </div>

        
      </div>
      @include("admin.copyright") 
    </div>

 
 
@endsection