@extends('layouts.app')
@section('content')  
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
              <h3 class="card-title">Roles Table</h3>
            </div>
            <div class="card-header">
              <p>
                <a href="{{ url('admin/role/create') }}" class="btn btn-success float-left">
                @lang('Add New Role')</a>
              </p>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Name</th>
                  <th>Last Modified</th>
                  <th class="action-button">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roleDetails as $rolesKey=>$roles)
                <tr>
                  <td>{{$rolesKey+1}}</td>
                  <td>{{$roles->name}}</td>
                  <td>{{date('Y-m-d, h:i a', strtotime($roles['updated_at']))}}</td>
                  <td>
                    <a href="{{ url('admin/role/edit') }}?role={{$roles->id}}" class="btn btn-warning pull-left">Edit</a>
                    
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>
    </section>
@endsection 