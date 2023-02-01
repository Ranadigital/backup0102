@extends('layouts.app')
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Permission Table</h3>
            </div>
            <div class="card-header">
              <p>
                <button type="button"  onclick="addPermission()" class="btn btn-success float-left">Add New Permission</button>
              </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <td>S.No.</td>
                  <th>Permission Name</th>
                  <th>Description</th>
                  <!-- <th class="action-button">Action</th> -->
                </tr>
                </thead>
                <tbody>
                @foreach($permissionDetails as $permissionKey=>$permission)
                <tr>
                  <td>{{$permissionKey+1}}</td>
                  <td>{{$permission->name}}</td>
                  <td>{{$permission->description}}</td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>
    <div class="modal fade" id="myPermisionModal">
      @include('admin.permission.create')
    </div>
    </section>
  <script>
    function addPermission(){
        $("#myPermisionModal").modal("show");
    }
  </script> 
@endsection    