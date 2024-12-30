<div class="left side-menu">
      <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
          
          @if(Auth::User()->usertype =="Admin")
          <ul>
            <li><a href="{{ URL::to('admin/dashboard') }}" class="waves-effect {{classActivePath('dashboard')}}"><i class="fa fa-dashboard"></i><span>{{trans('words.dashboard_text')}}</span></a></li>
            
            <li><a href="{{ URL::to('admin/category') }}" class="waves-effect {{classActivePath('category')}}"><i class="fa fa-list"></i><span>{{trans('words.categories_text')}}</span></a></li>
            
            <li><a href="{{ URL::to('admin/location') }}" class="waves-effect {{classActivePath('location')}}"><i class="fa fa-map-marker"></i><span>{{trans('words.locations')}}</span></a></li>
             

            <li><a href="{{ URL::to('admin/jobs') }}" class="waves-effect {{classActivePath('jobs')}}"><i class="fa fa-book"></i><span>{{trans('words.jobs_text')}}</span></a></li>

            <li><a href="{{ URL::to('admin/applied_users') }}" class="waves-effect {{classActivePath('applied_users')}}"><i class="fa fa-address-card"></i><span>{{trans('words.applied_users')}}</span></a></li>
             
 
            <li class="has_sub"> 
              <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i><span>{{trans('words.users')}}</span><span class="menu-arrow"></span></a>
              <ul class="list-unstyled">                 
                <li class="{{classActivePath('users')}}"><a href="{{ URL::to('admin/users') }}" class="{{classActivePath('users')}}"><i class="fa fa-users"></i><span>{{trans('words.job_seeker')}}</span></a></li>
                <li class="{{classActivePath('company')}}"><a href="{{ URL::to('admin/company') }}" class="{{classActivePath('company')}}"><i class="fa fa-building-o"></i><span>{{trans('words.job_provider')}}</span></a></li>
                <li class="{{classActivePath('sub_admin')}}"><a href="{{ URL::to('admin/sub_admin') }}" class="{{classActivePath('sub_admin')}}"><i class="fa fa-users"></i><span>{{trans('words.admin')}}</span></a></li>
               </ul>
            </li>

            <li><a href="{{ URL::to('admin/subscription_plan') }}" class="waves-effect {{classActivePath('subscription_plan')}}"><i class="fa fa-dollar"></i><span>{{trans('words.subscription_plan')}}</span></a></li>

            <li><a href="{{ URL::to('admin/payment_gateway') }}" class="waves-effect {{classActivePath('payment_gateway')}}"><i class="fa fa-credit-card-alt"></i><span>{{trans('words.payment_gateway')}}</span></a></li>
            
            <li><a href="{{ URL::to('admin/transactions') }}" class="waves-effect {{classActivePath('transactions')}}"><i class="fa fa-list"></i><span>{{trans('words.transactions')}}</span></a></li>

              
            <li><a href="{{ URL::to('admin/reports') }}" class="waves-effect {{classActivePath('reports')}}"><i class="fa fa-bug"></i><span>{{trans('words.reports')}}</span></a></li>

            <li><a href="{{ URL::to('admin/pages') }}" class="waves-effect {{classActivePath('pages')}}"><i class="fa fa-edit"></i><span>{{trans('words.pages')}}</span></a></li>
              

            <li><a href="{{ URL::to('admin/notification_send') }}" class="waves-effect {{classActivePath('notification_send')}}"><i class="fa fa-bell"></i><span>{{trans('words.notification_send')}}</span></a></li>

            <li><a href="{{ URL::to('admin/ad_list') }}" class="waves-effect {{classActivePath('ad_list')}}"><i class="fa fa-buysellads"></i><span>{{trans('words.ad_settings')}}</span></a></li>

            <li class="has_sub"> 
              <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i><span>{{trans('words.settings')}}</span><span class="menu-arrow"></span></a>
              <ul class="list-unstyled">                 
                <li class="{{classActivePath('general_settings')}}"><a href="{{ URL::to('admin/general_settings') }}" class="{{classActivePath('general_settings')}}"><i class="fa fa-cog"></i><span>{{trans('words.general')}}</span></a></li>
                <li class="{{classActivePath('email_settings')}}"><a href="{{ URL::to('admin/email_settings') }}" class="{{classActivePath('email_settings')}}"><i class="fa fa-envelope"></i><span>{{trans('words.smtp_email')}}</span></a></li>                 

                <li class="{{classActivePath('onesignal_notification')}}"><a href="{{ URL::to('admin/onesignal_notification') }}" class="{{classActivePath('onesignal_notification')}}"><i class="fa fa-podcast"></i><span>{{trans('words.onesignal_notification')}}</span></a></li>

                <li class="{{classActivePath('app_update_popup')}}"><a href="{{ URL::to('admin/app_update_popup') }}" class="{{classActivePath('app_update_popup')}}"><i class="fa fa-external-link"></i><span>{{trans('words.app_update_popup')}}</span></a></li>

                <li class="{{classActivePath('others_settings')}}"><a href="{{ URL::to('admin/others_settings') }}" class="{{classActivePath('others_settings')}}"><i class="fa fa-asterisk"></i><span>{{trans('words.others_settings')}}</span></a></li>

                 
                 
               </ul>
            </li> 
            

            <li><a href="{{ URL::to('admin/verify_purchase_app') }}" class="waves-effect {{classActivePath('verify_purchase_app')}}"><i class="fa fa-lock"></i><span>{{trans('words.app_verify')}}</span></a></li>

            <li><a href="{{ URL::to('admin/api_urls') }}" class="waves-effect {{classActivePath('api_urls')}}"><i class="fa fa-align-justify"></i><span>{{trans('words.app_api')}}</span></a></li>

            @elseif(Auth::User()->usertype =="Company")  

              <ul>
                
                <li><a href="{{ URL::to('admin/dashboard') }}" class="waves-effect {{classActivePath('dashboard')}}"><i class="fa fa-dashboard"></i><span>{{trans('words.dashboard_text')}}</span></a></li>
 
                <li><a href="{{ URL::to('admin/logout') }}" class="waves-effect {{classActivePath('logout')}}"><i class="fa fa-power-off"></i><span>{{trans('words.logout')}}</span></a></li>
                
              </ul>

            @else

              <ul>
                
              <li><a href="{{ URL::to('admin/dashboard') }}" class="waves-effect {{classActivePath('dashboard')}}"><i class="fa fa-dashboard"></i><span>{{trans('words.dashboard_text')}}</span></a></li>
            
            <li><a href="{{ URL::to('admin/category') }}" class="waves-effect {{classActivePath('category')}}"><i class="fa fa-list"></i><span>{{trans('words.categories_text')}}</span></a></li>
            
            <li><a href="{{ URL::to('admin/location') }}" class="waves-effect {{classActivePath('location')}}"><i class="fa fa-map-marker"></i><span>{{trans('words.locations')}}</span></a></li>
             

            <li><a href="{{ URL::to('admin/jobs') }}" class="waves-effect {{classActivePath('jobs')}}"><i class="fa fa-book"></i><span>{{trans('words.jobs_text')}}</span></a></li>

            <li><a href="{{ URL::to('admin/applied_users') }}" class="waves-effect {{classActivePath('applied_users')}}"><i class="fa fa-address-card"></i><span>{{trans('words.applied_users')}}</span></a></li>
             
 
            <li class="has_sub"> 
              <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i><span>{{trans('words.users')}}</span><span class="menu-arrow"></span></a>
              <ul class="list-unstyled">                 
                <li class="{{classActivePath('users')}}"><a href="{{ URL::to('admin/users') }}" class="{{classActivePath('users')}}"><i class="fa fa-users"></i><span>{{trans('words.job_seeker')}}</span></a></li>
                <li class="{{classActivePath('company')}}"><a href="{{ URL::to('admin/company') }}" class="{{classActivePath('company')}}"><i class="fa fa-building-o"></i><span>{{trans('words.job_provider')}}</span></a></li>
                 
               </ul>
            </li>

              
            <li><a href="{{ URL::to('admin/transactions') }}" class="waves-effect {{classActivePath('transactions')}}"><i class="fa fa-list"></i><span>{{trans('words.transactions')}}</span></a></li>

              
            <li><a href="{{ URL::to('admin/reports') }}" class="waves-effect {{classActivePath('reports')}}"><i class="fa fa-bug"></i><span>{{trans('words.reports')}}</span></a></li>

            <li><a href="{{ URL::to('admin/pages') }}" class="waves-effect {{classActivePath('pages')}}"><i class="fa fa-edit"></i><span>{{trans('words.pages')}}</span></a></li>
              

            <li><a href="{{ URL::to('admin/notification_send') }}" class="waves-effect {{classActivePath('notification_send')}}"><i class="fa fa-bell"></i><span>{{trans('words.notification_send')}}</span></a></li>
                
              </ul>

            @endif
             
            
          </ul>
        </div>
      </div>
    </div>