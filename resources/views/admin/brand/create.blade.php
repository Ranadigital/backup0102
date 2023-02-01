@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('/css/admin/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/admin/select2-bootstrap4.min.css')}}">
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
              @if(!empty($brandDetails)) Edit @else Add New @endif Brand
            </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form name="brand_form" id="brand_form" method="post" enctype="multipart/form-data" action="store">      
            {{ csrf_field() }}
            @if(isset($brandDetails))
              <input type="hidden" name="id" value="{{$brandDetails->id}}">
            @endif
            <div class="card-body row">
              <div class="col-md-6">
                <div class="row">
                  <div class="form-group">
                    <label for="exampleInputBlogName">Brand Name*</label>
                    <input type="text" class="form-control required_field" name="brand_name" id="brand_name" autocomplete="off" value="@if(isset($brandDetails['brand_name']) && !empty($brandDetails['brand_name'])) {{$brandDetails['brand_name']}} @endif" placeholder="Enter Brand Name" maxlength=30 >                    
                    <span class="invalid-feedback" role="alert">
                      <strong id="brand_name-error"></strong>
                    </span>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Category*</label>
                      <select class="form-control select2bs4 select2-hidden-accessible required_field" id="brands_category_id" name="brands_category_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected="selected" >Select Category</option>
                        @if (count($categories) > 0)
                          @foreach($categories as $categoryKey=>$category)
                            <option  @if(isset($brandDetails->brands_category_id) && $brandDetails->brands_category_id == $category->id) selected="selected" @endif value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                        @endif
                      </select>
                      <span class="invalid-feedback" role="alert">
                        <strong id="brands_category_id-error"></strong>
                      </span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>  
            <div class="card-footer">
              <div class="col-md-3">
                <button type="button" class="btn btn-primary float-right nameButton" id="brand_form-submit"><i class="fas fa-spinner fa-pulse d-none" id="brand_form-submit-spin"></i> Submit</button>
                <button type="submit" class="d-none btn btn-primary float-right nameButton" id="brand_form-store"> Submit</button>
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

<script src="{{asset('/js/admin/select2.full.min.js')}}"></script>

<script type="text/javascript">

  $(document).ready(function() {
    $('.select2').select2()
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  });

 
  // Form Submit
  $("#brand_form-submit").click(function(){ 
    var url = "{{ url('admin/master/brand/store') }}";
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
      $("#brand_form-store").click();
    }
  
  });
  function setRequired(id){
      console.log(id);
        var idVal = $.trim($('#'+id).val());    
        if((id == 'brands_category_id' && idVal == 'Select Category')||idVal == ''){
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