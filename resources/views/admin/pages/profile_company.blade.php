@extends("admin.admin_app")

@section("content")

  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12">
              <div class="card-box">
                                 

              {!! Form::open(array('url' => array('admin/company/profile_edit'),'class'=>'form-horizontal','name'=>'user_form','id'=>'user_form','role'=>'form','enctype' => 'multipart/form-data')) !!}  
                  
                  <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : null }}">
 
                   
                   
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.name')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="name" value="{{ isset($user->name) ? $user->name : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.email')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="email" value="{{ isset($user->email) ? $user->email : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.password')}}</label>
                    <div class="col-sm-8">
                      <input type="password" name="password" value="" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.phone')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="phone" value="{{ isset($user->phone) ? $user->phone : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.city')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="city" value="{{ isset($user->city) ? $user->city : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.address')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="address" value="{{ isset($user->address) ? stripslashes($user->address) : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.company_website')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="company_website" value="{{ isset($user->company_website) ? stripslashes($user->company_website) : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.company_working_day')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="company_working_day" value="{{ isset($user->company_working_day) ? stripslashes($user->company_working_day) : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.company_working_time')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="company_working_time" value="{{ isset($user->company_working_time) ? stripslashes($user->company_working_time) : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.company_info')}}</label>
                    <div class="col-sm-8">                       
                      <textarea name="company_info" class="form-control elm1_editor" placeholder="">{{ isset($user->company_info) ? stripslashes($user->company_info) : null }}</textarea>
                    </div>
                  </div>

                    
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.company_logo')}}</label>
                    <div class="col-sm-8">
                      <input type="file" name="company_logo" class="form-control">                     
                    </div>
                  </div>

                  @if(isset($user->user_image)) 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">
                      <img src="{{URL::to('upload/'.$user->user_image)}}" alt="video image" class="img-thumbnail" width="140">       
                    </div>
                  </div>
                  @endif  
                                         

                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9 pl-1">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> {{trans('words.save')}} </button>                      
                    </div>
                  </div>
                {!! Form::close() !!}  
              </div>
            </div>
          </div>
        </div>
      </div>
      @include("admin.copyright") 
    </div>

<script type="text/javascript">

@if(Session::has('flash_message'))     

  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: false,
    /*didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }*/
  })

  Toast.fire({
    icon: 'success',
    title: '{{ Session::get('flash_message') }}'
  })     
  
@endif

@if (count($errors) > 0)
              
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: '<p>@foreach ($errors->all() as $error) {{$error}}<br/> @endforeach</p>',
        showConfirmButton: true,
        confirmButtonColor: '#10c469',
        background:"#1a2234",
        color:"#fff"
        }) 
@endif

</script>


@endsection