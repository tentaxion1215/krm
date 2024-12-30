@extends("admin.admin_app")

@section("content")

  

<div class="content-page">
      <div class="content">
        <div class="container-fluid">

        @if(Auth::User()->plan_id==0 OR strtotime(date('m/d/Y')) > Auth::User()->exp_date)
        <div class="alert alert-danger">
                       
        {{trans('words.subscription_plan_exp')}}
       
        </div>
        @endif
          
            <div class="row">
                      
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

            </div>   
        
        </div>

        
      </div>
      @include("admin.copyright") 
    </div>

 
 
@endsection