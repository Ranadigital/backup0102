@extends('layouts.app')
@section('content')
<link href="{{ asset('css/admin/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('css/admin/select2-bootstrap4.min.css') }}" rel="stylesheet">
@if ($errors->count() > 0)
    <p class="help-block bg-red">
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
          <div class="col-md-4">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">@if(!empty($roleDetails)) Edit @else Add New @endif Role</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form name="role_form" id="role_form" method="post" enctype="multipart/form-data" action="store">
              {{ csrf_field() }}
            
              @if(isset($roleDetails))
              <input type="hidden" name="id" value="{{$roleDetails->id}}">
              <input type="hidden" name="nameId" id="nameId" value="{{$roleDetails->id}}">
              @endif
              <input type="hidden" name="guard_name" id="guard_name" value="web">
              <input type="hidden" name="nameType" id="nameType" value="role-name">
                <div class="card-body">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Name*</label>
                      <input type="text" class="form-control required_field unique_entry chkName" name="name" id="name" data-table="role" data-edit ="@if(!empty($roleDetails['id'])) {{$roleDetails->id}} @endif" value="@if(!empty($roleDetails['name'])) {{$roleDetails['name']}} @endif" placeholder="Enter Role Title" maxlength=30 >
                      <span class="invalid-feedback" role="alert">
                          <strong class="chkName-error" id="name-error"></strong>
                      </span>
                  </div>
                  <div class="form-group">
                      <label>Select Permission*</label>
                      <div class="select2-purple">

                      <select class="select2 select2-hidden-accessible" multiple="multiple" data-placeholder="Select a Permission" name="permission[]" id="permission" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        @foreach($permissionDetails as $permissionKey=> $permissionDetail)
                          <option value="{{$permissionDetail->id}}" @if(isset($data)) @if(in_array($permissionDetail->id,$data)) selected="selected" @endif @endif>{{$permissionDetail->name}}</option>
                        @endforeach
                      </select>
                  </div>
                  <span class="invalid-feedback-select" role="alert">
                      <strong id="permission-error"></strong>
                  </span>
                </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                


                <button type="button" class="btn btn-primary float-right nameButton" id="role-submit_form-submit"><i class="fas fa-spinner fa-pulse d-none" id="role-submit_form-submit-spin"></i> Submit</button>
                <button type="submit" class="d-none btn btn-primary float-right nameButton" id="role-submit_form-store"> Submit</button>

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
<link href="{{ asset('css/admin/select2-bootstrap4.min.css') }}" rel="stylesheet">
<script src="{{ asset('js/admin/select2.full.min.js') }}"></script>

<script>
  // Form Submit
  $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    $("#role-submit_form-submit").click(function(){ 
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
      $("#role-submit_form-store").click();
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

