@extends('layouts.app')

@section('content') 
<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
          <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">User Table</h3>
                </div>
            <div class="card-header">
                <p>
                @if($btnStatus == '1')
                  <a href="{{ url('admin/user/index') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Users')</a>
                @else
                <a href="{{ url('admin/user/index') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Users')</a>
                @endif
                  <a href="{{  url('admin/user/create') }}" class="btn btn-success" style="float: left;">@lang('Add New User')</a>
                </p>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTableLength" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Last Modified</th>
                      <th class="toggle-button">Status</th>
                      <th class="action-button">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($userDetails as $userKey=>$users)
                <tr>
                  <td>{{$userKey+1}}</td>
                  <td>{{$users->name}}</td>
                  <td>{{$users->email}}</td>
                  @php $roles = explode(',',$users->role); @endphp
                  <td>
                  @foreach($roles as $role)
                  <button class="btn btn-secondary">{{$role}}</button>
                  @endforeach
                  </td>
                  <td>{{date('Y-m-d, h:i a', strtotime($users['updated_at']))}}</td>
                  <td id="enable{{$users->id}}">
                      @if($users->status)
                          <button type="button" id="enable" onclick="UpdateStatus({{$users->id}}, '0','userStatus')" class="btn btn-success">Active</button>
                      @else
                          <button type="button" id="disable" onclick="UpdateStatus({{$users->id}}, '1', 'userStatus')" class="btn btn-danger">Inactive</button>
                      @endif
                  </td> 

                  <td>
                    
                    <a href="{{ url('admin/user/edit') }}?user={{$users->id}}" class="btn btn-warning pull-left">Edit</a>
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