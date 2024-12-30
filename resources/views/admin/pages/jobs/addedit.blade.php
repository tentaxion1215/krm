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
                <div class="row">
                 <div class="col-sm-6">
                      <a href="{{ URL::to('admin/jobs') }}"><h4 class="header-title m-t-0 m-b-30 text-primary pull-left" style="font-size: 20px;"><i class="fa fa-arrow-left"></i> {{trans('words.back')}}</h4></a>
                 </div>                  
                </div> 
                 
                 {!! Form::open(array('url' => array('admin/jobs/add_edit'),'class'=>'form-horizontal','name'=>'settings_form','id'=>'settings_form','role'=>'form','enctype' => 'multipart/form-data')) !!}  
                  
                 <input type="hidden" name="id" value="{{ isset($info->id) ? $info->id : null }}">
                  
                 <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.category')}} *</label>
                      <div class="col-sm-8">
                            <select class="form-control select2" name="category" id="category_id">   
                               <option value="">{{trans('words.select_category')}}</option>                            
                              @foreach($cat_list as $cat_data)  
                                <option value="{{$cat_data->id}}" @if(isset($info->id) AND $cat_data->id==$info->cat_id) selected @endif>{{$cat_data->category_name}}</option>
                              @endforeach   
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.locations')}} *</label>
                      <div class="col-sm-8">
                            <select class="form-control select2" name="location" id="location_id">   
                               <option value="">{{trans('words.select_location')}}</option>                            
                              @foreach($location_list as $location_data)  
                                <option value="{{$location_data->id}}" @if(isset($info->id) AND $location_data->id==$info->location_id) selected @endif>{{$location_data->name}}</option>
                              @endforeach   
                            </select>
                      </div>
                  </div>
 

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.job_title')}} *</label>
                    <div class="col-sm-8">
                      <input type="text" name="job_title" value="{{ isset($info->title) ? stripslashes($info->title) : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.description')}} *</label>
                    <div class="col-sm-8"> 
                    <textarea name="description" class="form-control elm1_editor" placeholder="">{{ isset($info->description) ? stripslashes($info->description) : null }}</textarea>                      
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.job_type')}} *</label>
                      <div class="col-sm-8">
                            <select class="form-control select2" name="job_type" id="job_type">   
                               <option value="">{{trans('words.select_type')}}</option>                            
                               <option value="Contract" @if(isset($info->id) AND $info->job_type=="Contract") selected @endif>Contract</option>
                               <option value="Freelance" @if(isset($info->id) AND $info->job_type=="Freelance") selected @endif>Freelance</option>
                               <option value="Full Time" @if(isset($info->id) AND $info->job_type=="Full Time") selected @endif>Full Time</option>
                               <option value="Internship" @if(isset($info->id) AND $info->job_type=="Internship") selected @endif>Internship</option>
                               <option value="Part Time" @if(isset($info->id) AND $info->job_type=="Part Time") selected @endif>Part Time</option>
                                
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.designation')}} *</label>
                    <div class="col-sm-8">
                      <input type="text" name="designation" value="{{ isset($info->designation) ? stripslashes($info->designation) : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.salary')}} *</label>
                    <div class="col-sm-8">
                      <input type="number" name="salary" value="{{ isset($info->salary) ? stripslashes($info->salary) : null }}" class="form-control" min="1">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.company_name')}} *</label>
                    <div class="col-sm-8">
                      <input type="text" name="company_name" value="{{ isset($info->company_name) ? stripslashes($info->company_name) : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.phone')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="phone" value="{{ isset($info->phone) ? stripslashes($info->phone) : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.email')}} *</label>
                    <div class="col-sm-8">
                      <input type="text" name="email" value="{{ isset($info->email) ? stripslashes($info->email) : null }}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.website')}}</label>
                    <div class="col-sm-8">
                      <input type="url" name="website" value="{{ isset($info->website) ? stripslashes($info->website) : null }}" class="form-control">

                      <small class="form-text text-muted">(https://example.com)</small>
                    </div>
                  </div>
 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.job_work_days')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="job_work_days" value="{{ isset($info->job_work_days) ? stripslashes($info->job_work_days) : null }}" class="form-control">

                      <small class="form-text text-muted">(e.g.Mon-Fri)</small>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.job_work_time')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="job_work_time" value="{{ isset($info->job_work_time) ? stripslashes($info->job_work_time) : null }}" class="form-control">

                      <small class="form-text text-muted">(e.g.9AM-6PM)</small>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.vacancy')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="vacancy" value="{{ isset($info->vacancy) ? stripslashes($info->vacancy) : null }}" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.address')}} *</label>
                    <div class="col-sm-8">
                    <textarea name="address" class="form-control" placeholder="">{{ isset($info->address) ? stripslashes($info->address) : null }}</textarea>      
                       
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.experience')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="experience" value="{{ isset($info->experience) ? stripslashes($info->experience) : null }}" class="form-control" placeholder="2 Years">
                    </div>
                  </div>
                 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.qualification')}} *</label>
                      <div class="col-sm-8">
                            <select class="form-control select2" name="qualification" id="qualification">   
                               <option value="">{{trans('words.select_qualification')}}</option>                            
                               <option value="Bachelors" @if(isset($info->id) AND $info->qualification=="Bachelors") selected @endif>Bachelors</option>
                               <option value="Masters" @if(isset($info->id) AND $info->qualification=="Masters") selected @endif>Masters</option>
                               <option value="MPhil/MS" @if(isset($info->id) AND $info->qualification=="MPhil/MS") selected @endif>MPhil/MS</option>
                               <option value="PHD/Doctorate" @if(isset($info->id) AND $info->qualification=="PHD/Doctorate") selected @endif>PHD/Doctorate</option>
                               <option value="Certification" @if(isset($info->id) AND $info->qualification=="Certification") selected @endif>Certification</option>
                               <option value="Diploma" @if(isset($info->id) AND $info->qualification=="Diploma") selected @endif>Diploma</option>
                               <option value="Short Course" @if(isset($info->id) AND $info->qualification=="Short Course") selected @endif>Short Course</option>
                                
                            </select>
                      </div>
                  </div>

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.skills')}}</label>
                    <div class="col-sm-8">
                      <input type="text" name="skills" value="{{ isset($info->skills) ? stripslashes($info->skills) : null }}" class="form-control" data-role="tagsinput">

                      <small class="form-text text-muted">(Seperate with Comma)</small>
                    </div>
                    
                  </div>
   
                  @if(Auth::User()->usertype =="Company")
              
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.job_image')}} * </label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input type="file" name="job_image" class="form-control">
                  
                      </div>
                      <small class="form-text text-muted">({{trans('words.recommended_resolution')}} : 300x300, 400x400, 500x500 or etc)</small>
                        
                    </div>
                  </div>

                  @else

                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.job_image')}} * </label>
                    <div class="col-sm-8">
                      <div class="input-group">
                        <input type="text" name="job_image" id="job_image" value="{{ isset($info->image) ? stripslashes($info->image) : null }}" class="form-control" readonly>
                        <div class="input-group-append">                           
                          <button type="button" class="btn btn-dark waves-effect waves-light popup_selector" data-input="job_image" data-preview="holder_logo" data-inputid="job_image">Select</button>                        
                        </div>
                      </div>
                      <small class="form-text text-muted">({{trans('words.recommended_resolution')}} : 300x300, 400x400, 500x500 or etc)</small>
                      <div id="image_holder" style="margin-top:5px;max-height:100px;"></div>                     
                    </div>
                  </div>

                  @endif
                    
                  @if(isset($info->image)) 
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">&nbsp;</label>
                    <div class="col-sm-8">                                                                         
                      <img src="{{URL::to('/'.$info->image)}}" alt="image" class="img-thumbnail" width="140">                                               
                    </div>
                  </div>
                  @endif  

                  <div class="form-group row">
                   
                    <label class="col-sm-3 col-form-label">{{trans('words.date')}} *</label>
                    <div class="col-sm-8">
                      <input type="text" id="datepicker-autoclose" name="date" value="{{ isset($info->date) ? date('m/d/Y',$info->date) : null }}" class="form-control" autocomplete="off" placeholder="MM/DD/YYYY">
                    </div>
                  </div>
 
                  <hr/>  
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">{{trans('words.status')}}</label>
                      <div class="col-sm-8">
                            <select class="form-control" name="status">                               
                                <option value="1" @if(isset($info->status) AND $info->status==1) selected @endif>{{trans('words.active')}}</option>
                                <option value="0" @if(isset($info->status) AND $info->status==0) selected @endif>{{trans('words.inactive')}}</option>                            
                            </select>
                      </div>
                  </div>
                  <div class="form-group">
                    <div class="offset-sm-3 col-sm-9 pl-1">
                      <button type="submit" class="btn btn-primary waves-effect waves-light"> {{trans('words.save')}}</button>                      
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
     
     
// function to update the file selected by elfinder
function processSelectedFile(filePath, requestingField) {

//alert(requestingField);

var elfinderUrl = "{{ URL::to('/') }}/";

if(requestingField=="job_image")
{
  var target_preview = $('#image_holder');
  target_preview.html('');
  target_preview.append(
          $('<img>').css('height', '5rem').attr('src', elfinderUrl + filePath.replace(/\\/g,"/"))
        );
  target_preview.trigger('change');
}


//$('#' + requestingField).val(filePath.split('\\').pop()).trigger('change'); //For only filename
$('#' + requestingField).val(filePath.replace(/\\/g,"/")).trigger('change');

}

 
 </script>

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

<script src="{{ URL::asset('admin_assets/js/jquery.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function(e) {
      
     $("#category_id").change(function(){ 
         var cat_id=$("#category_id").val();
          $.ajax({
          type: "GET",
          url: "{{ URL::to('admin/ajax_get_sub_cat') }}/"+cat_id,
          //data: "cat=" + cat,
          success: function(result){

              $("#sub_category_id option").remove();
                
              $("#sub_category_id").html(result);

            }
          });
      
      });

      $("#upload_type").change(function(){         
        var type=$("#upload_type").val();

        if(type=="local")
        {   
            $("#local_upload_id").show();
            $("#server_upload_id").hide();

        }         
        else
        {   
            $("#local_upload_id").hide();
            $("#server_upload_id").show();
        }

      }); 
      
      $("#book_on_rent").change(function(){         
        var on_rent=$("#book_on_rent").val();

        if(on_rent==1)
        {   
            $("#on_rent_sec").show();

        }         
        else
        {   
            $("#on_rent_sec").hide();
        }

      }); 

  });
</script>

 
  
@endsection