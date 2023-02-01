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
              @if(isset($categoryDetails) && !empty($categoryDetails)) Edit @else Add New @endif Category
            </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form name="category_form" id="category_form" method="post" enctype="multipart/form-data" action="store">      
            {{ csrf_field() }}
            @if(isset($categoryDetails))
              <input type="hidden" name="id" value="{{$categoryDetails->id}}">
            @endif
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputBlogName">Category Name*</label>
                    <input type="text" class="form-control required_field" name="category_name" id="category_name" autocomplete="off" value="@if(isset($categoryDetails['category_name']) && !empty($categoryDetails['category_name'])) {{$categoryDetails['category_name']}} @endif" placeholder="Enter Category Name" maxlength=30 >                    
                    <span class="invalid-feedback" role="alert">
                      <strong id="category_name-error"></strong>
                    </span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputBlogName">Category Image*</label>
                    <input type="file" class="form-control @if(!isset($categoryDetails->category_image_name) && empty($categoryDetails->category_image_name)) required_field @endif" name="category_image" id="category_image" accept="image/*" >
                    <span class="invalid-feedback" role="alert">
                      <strong id="category_image-error"></strong>
                    </span>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>  
            <div class="card-footer">
              <div class="col-md-6">
                <button type="button" class="btn btn-primary float-right nameButton" id="category_form-submit"><i class="fas fa-spinner fa-pulse d-none" id="category_form-submit-spin"></i> Submit</button>
                <button type="submit" class="d-none btn btn-primary float-right nameButton" id="category_form-store"> Submit</button>
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
  $("#category_form-submit").click(function(){ 
    var url = "{{ url('admin/master/category/store') }}";
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
      $("#category_form-store").click();
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