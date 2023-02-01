@extends('layouts.app')
@section('content')
<link href="{{ asset('css/admin/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/select2-bootstrap4.min.css') }}" rel="stylesheet">
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
          <div class="col-md-6" style="padding: 12px;">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                @if(!empty($userDetails)) Edit @else Add New @endif User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="user_form" id="user_form" method="post" enctype="multipart/form-data" action="store">
              {{ csrf_field() }}
                {{ csrf_field() }}
                @if(isset($userDetails))
                <input type="hidden" name="id" value="{{$userDetails->id}}">
                <input type="hidden" name="nameId" id="nameId" value="{{$userDetails->id}}">
                @endif
                <input type="hidden" name="nameType" id="nameType" value="user-email">
                  <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6">
                      <label for="exampleInputEmail1">User Name*</label>
                      <input type="text" class="form-control required_field" name="name" id="name" autocomplete="off" value="@if(!empty($userDetails['name'])) {{$userDetails['name']}} @endif" placeholder="Enter User Name" maxlength=30 >                    
                        <span class="invalid-feedback" role="alert">
                            <strong id="name-error"></strong>
                        </span>
                    </div>
                    <div class="form-group col-md-6">
                      <label for="exampleInputPassword1">Email Address*</label>
                      <span class="text-danger" id="email_errors"></span>
                      <span class="text-danger" id="email_error"></span>
                      <input type="email" autocomplete="off" class="form-control required_field chkName" name="email" id="email" value="@if(!empty($userDetails['email'])) {{$userDetails['email']}} @endif" placeholder="Enter User Email" maxlength=100 @if(!empty($userDetails)) readonly @endif>                    
                        <span class="invalid-feedback" role="alert">
                            <strong class="chkName-error" id="email-error"></strong>
                        </span>
                    </div>
                    </div>
                    @if(empty($userDetails))
                    <div class="row">
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Password @if(empty($userDetails)) * @endif</label>
                        <input type="password" autocomplete="off" class="form-control @if(empty($userDetails)) required_field @endif" name="password" id="password" placeholder="Enter Password">                    
                          <span class="invalid-feedback" role="alert">
                              <strong id="password-error"></strong>
                          </span>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputPassword1">Confirm Password @if(empty($userDetails)) * @endif</label>
                        <span class="text-danger" id="password_error"></span>
                        <input type="password" autocomplete="off" class="form-control @if(empty($userDetails)) required_field @endif" name="confirm-password" id="confirm-password" placeholder="Enter Confirm Password">                 
                          <span class="invalid-feedback" role="alert">
                              <strong id="confirm-password-error"></strong>
                          </span> 
                      </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="form-group col-md-12">
                          <label>Select Roles*</label>
                          <div class="select2-purple">
                              <select class="select2 required_field required_field_select" multiple="multiple" data-placeholder="Select Roles" name="roles[]" id="roles" style="width: 100%;">
                                @foreach($roleDetails as $roleDetail)
                                  <option value="{{$roleDetail->id}}" @if(isset($data)) @if(in_array($roleDetail->id,$data)) selected="selected" @endif @endif>{{$roleDetail->name}}</option>
                                @endforeach
                              </select>
                          </div>
                          <span class="invalid-feedback-select" role="alert">
                              <strong id="roles-error"></strong>
                          </span>
                        </div>
                    </div>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    
                    <button type="button" class="btn btn-primary float-right nameButton" id="user-submit_form-submit"><i class="fas fa-spinner fa-pulse d-none" id="user-submit_form-submit-spin"></i> Submit</button>
                    <button type="submit" class="d-none btn btn-primary float-right nameButton" id="user-submit_form-store"> Submit</button>
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

<script src="{{ asset('js/admin/select2.full.min.js') }}"></script>
<script>
  // Form Submit
  $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
  $("#user-submit_form-submit").click(function(){ 
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
      $("#user-submit_form-store").click();
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