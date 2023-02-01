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
              @if(isset($deliveryDetails) && !empty($deliveryDetails)) Edit @else Add New @endif Delivery Option
            </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form name="deliveryDetails_form" id="deliveryDetails_form" method="post" enctype="multipart/form-data" action="store">      
            {{ csrf_field() }}
            @if(isset($deliveryDetails))
              <input type="hidden" name="id" value="{{$deliveryDetails->id}}">
            @endif
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputBlogName">Heading*</label>
                    <input type="text" class="form-control required_field" name="heading" id="heading" autocomplete="off" value="@if(isset($deliveryDetails['heading']) && !empty($deliveryDetails['heading'])) {{$deliveryDetails['heading']}} @endif" placeholder="Enter Category Name" maxlength=30 >                    
                    <span class="invalid-feedback" role="alert">
                      <strong id="heading-error"></strong>
                    </span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="exampleInputBlogName">Description*</label>
                    <textarea id="delivery_options_description" name="delivery_options_description" class="form-control ckeditor required_field">
                        @if(isset($deliveryDetails['delivery_options_description']) && !empty($deliveryDetails['delivery_options_description'])) {{$deliveryDetails['delivery_options_description']}} @endif
                      </textarea>   
                    <span class="invalid-feedback" role="alert">
                      <strong id="delivery_options_description-error"></strong>
                    </span>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>  
            <div class="card-footer">
              <div class="col-md-6">
                <button type="button" class="btn btn-primary float-right nameButton" id="deliveryDetails_form-submit"><i class="fas fa-spinner fa-pulse d-none" id="deliveryDetails_form-submit-spin"></i> Submit</button>
                <button type="submit" class="d-none btn btn-primary float-right nameButton" id="deliveryDetails_form-store"> Submit</button>
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
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script type="text/javascript">

   $(document).ready(function() {
     $('.ckeditor').ckeditor();  
    
  });
  
  // Form Submit
  $("#deliveryDetails_form-submit").click(function(){ 
   // var url = "{{ url('admin/master/category/store') }}";
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
      $("#deliveryDetails_form-store").click();
    }
  
  });
  function setRequired(id){
    if( id == 'delivery_options_description'){
      var idVal = CKEDITOR.instances[id].getData();
      console.log(idVal);
    }else{
      var idVal = $.trim($('#'+id).val());    
    }    
        
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