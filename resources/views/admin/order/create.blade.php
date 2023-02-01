@extends('layouts.app')
@section('content')
@if ($errors->count() > 0)
  <p class="help-block" style="color: red;">
    @foreach($errors->all() as $error)
      <div class="alert alert-danger col-md-6">
        {{ $error }}  
      </div>
    @endforeach
  </p>
@endif
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- left column -->
      <div class="col-md-12" style="padding: 12px;">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              @if(isset($bannerDetails) && !empty($bannerDetails)) Edit @else Add New @endif Banner
            </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form name="banner_form" id="banner_form" method="post" enctype="multipart/form-data" action="store">      
            {{ csrf_field() }}
            @if(isset($bannerDetails))
              <input type="hidden" name="id" value="{{$bannerDetails->id}}">
            @endif
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputBlogName">First Heading*</label>
                    <input type="text" class="form-control required_field" name="first_heading" id="first_heading" autocomplete="off" value="@if(isset($bannerDetails['first_heading']) && !empty($bannerDetails['first_heading'])) {{$bannerDetails['first_heading']}} @endif" placeholder="Enter Heading" >                    
                    <span class="invalid-feedback" role="alert">
                      <strong id="first_heading-error"></strong>
                    </span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputBlogName">Second Heading*</label>
                    <input type="text" class="form-control required_field" name="second_heading" id="second_heading" autocomplete="off" value="@if(isset($bannerDetails['second_heading']) && !empty($bannerDetails['second_heading'])) {{$bannerDetails['second_heading']}} @endif" placeholder="Enter Heading"  >                    
                    <span class="invalid-feedback" role="alert">
                      <strong id="second_heading-error"></strong>
                    </span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputBlogName">Banner Image*</label>
                    <input type="file" class="form-control @if(!isset($bannerDetails->baneer_image_name) && empty($bannerDetails->baneer_image_name)) required_field @endif" name="baneer_image_name" id="baneer_image_name" accept="image/*" >
                    <span class="invalid-feedback" role="alert">
                      <strong id="baneer_image_name-error"></strong>
                    </span>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>  
            <div class="card-footer">
              <div class="col-md-6">
                <button type="button" class="btn btn-primary float-right nameButton" id="banner_form-submit"><i class="fas fa-spinner fa-pulse d-none" id="banner_form-submit-spin"></i> Submit</button>
                <button type="submit" class="d-none btn btn-primary float-right nameButton" id="banner_form-store"> Submit</button>
              </div>
            </div>  
          </form>
        </div>            
        <!-- /.card -->
      </div><!--/.col (right) -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
    

@endsection

@push('js')


<script type="text/javascript">

  // Form Submit
  $("#banner_form-submit").click(function(){ 
    var url = "{{ url('admin/master/banner/store') }}";
    var server_error_msg = "Server error, please contact to admin.";
    var errorArray = [];
    $('.required_field').each(function(){
            var id = $(this).attr("id");console.log(id);
            var status = setRequired(id);
            if(status == false){
              errorArray.push(id);
            }        
    });
    if(errorArray.length){
      return false;
    }else{
      $("#banner_form-store").click();
    }
  
  });
  function setRequired(id){
        var idVal = $.trim($('#'+id).val());    
        
        if(idVal == ''){
          $('#'+id).addClass('is-invalid');
          $(`#${id}-error`).html(`The ${id} field is required.`);
          $(`#${id}-icon`).removeClass('text-success');
          return false;
        }else{
          $('#'+id).removeClass('is-invalid');
          $(`#${id}-icon`).addClass('text-success');
          $(`#${id}-error`).html('');
          return true;
        }
    }
  function removeDisabled(storeType){
        $(`#${storeType}-submit-spin`).addClass('d-none');     
        $(`#${storeType}-submit`).prop('disabled', false);
    }

</script>

@endpush