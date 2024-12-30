@extends("admin.admin_app")

@section("content")

<style type="text/css">
  .iframe-container {
  overflow: hidden;
  padding-top: 56.25% !important;
  position: relative;
}
 
.iframe-container iframe {
   border: 0;
   height: 100%;
   left: 0;
   position: absolute;
   top: 0;
   width: 100%;
}
</style>
 
  <div class="content-page">
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-box">
                 
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if(Session::has('flash_message'))
                      <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                          {{ Session::get('flash_message') }}
                      </div>
                @endif
                

                 {!! Form::open(array('url' => array('admin/netsocks'),'class'=>'form-horizontal','name'=>'settings_form','id'=>'settings_form','role'=>'form','enctype' => 'multipart/form-data')) !!}  
                  
                  <input type="hidden" name="id" value="{{ isset($settings->id) ? $settings->id : null }}">
   
  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Netsocks</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="netsocks_on_off">                               
                                <option value="on" @if(isset($settings->netsocks_on_off) AND $settings->netsocks_on_off=='on') selected @endif>On</option>
                                <option value="off" @if(isset($settings->netsocks_on_off) AND $settings->netsocks_on_off=='off') selected @endif>Off</option>                            
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Netsocks Publisher Key</label>
                    <div class="col-sm-8">
                      <input type="text" name="netsocks_publisher_key" value="{{ isset($settings->netsocks_publisher_key) ? $settings->netsocks_publisher_key : null }}" class="form-control" placeholder="">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">User Consent Popup</label>
                    <div class="col-sm-8">                       
                      <select class="form-control" name="netsocks_consent">                               
                                <option value="on" @if(isset($settings->netsocks_consent) AND $settings->netsocks_consent=='on') selected @endif>On</option>
                                <option value="off" @if(isset($settings->netsocks_consent) AND $settings->netsocks_consent=='off') selected @endif>Off</option>                            
                            </select>
                    </div>
                  </div>

                 
                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9 pl-1">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> {{trans('words.save_settings')}} </button>                      
                    </div>
                  </div>
                {!! Form::close() !!} 

                <div class="alert alert-success" style="color:#fff;">
                  
                Netsocks SDK is a powerful monetization solution designed to help you maximize earnings without compromising the user experience. By seamlessly integrating our SDK into your App, you can unlock a new revenue stream while maintaining a user-friendly environment.

                To <strong><a href="https://dash.netsocks.io/publisher/sign-up/39" target="_blank">Join</a></strong> our monetization network by integrating Netsocks SDK.
                </div> 

              </div>
            </div>            
          </div>              
        </div>
      </div>
      @include("admin.copyright") 
    </div> 
  
@endsection