@extends('layouts.app')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
          <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Brand</h3>
                </div>
            <div class="card-header">
                <p>
                  
                    @if($btnStatus == '1')
                      <a href="{{ url('admin/master/brand') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Brand')</a>
                    @else
                      <a href="{{ url('admin/master/brand') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Brand')</a>
                    @endif
                    <a href="{{ url('admin/master/brand/create') }}" class="btn btn-success" style="float: left;">@lang('Add New Brand')</a>
                  
                </p>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTableLength" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Name</th>
                      <th>Last Modified</th>
                      <th class="toggle-button">Status</th>
                      <th class="action-button">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if (count($brands) > 0)
                  @foreach($brands as $branKey=>$brand)
                  <tr>
                    <td>{{$branKey+1}}</td>
                    <td>{{$brand->brand_name}}</td>
                    <td>{{date('Y-m-d, h:i a', strtotime($brand->updated_at))}}</td>
                    <td id="enable{{$brand->id}}">
                        @if($brand->status)
                            <button type="button" id="enable" onclick="UpdateStatus({{$brand->id}}, '0','brandStatus')" class="btn btn-success">Active</button>
                        @else
                            <button type="button" id="disable" onclick="UpdateStatus({{$brand->id}}, '1', 'brandStatus')" class="btn btn-danger">Inactive</button>
                        @endif
                    </td> 
                    <td><a href="{{ url('admin/master/brand/edit') }}?brand={{$brand->id}}" class="btn btn-warning">Edit</a></td>
                    
                    
                  </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="6">No data available</td>
                  </tr>
                @endif 
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
    </div>
    </section>
   
@endsection   