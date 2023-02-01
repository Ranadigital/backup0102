@extends('layouts.app')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
          <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Delivery Option</h3>
                </div>
            <div class="card-header">
                <p>
                    @if($btnStatus == '1')
                      <a href="{{ url('admin/master/delivery-option') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Delivery Option')</a>
                    @else
                      <a href="{{ url('admin/master/delivery-option') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Delivery Option')</a>
                    @endif
                    <a href="{{ url('admin/master/delivery-option/create') }}" class="btn btn-success" style="float: left;">@lang('Add New Delivery Option')</a>
                  
                </p>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTableLength" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Heading</th>
                      <th>Last Modified</th>
                      <th class="toggle-button">Status</th>
                      <th class="action-button">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if (count($deliveryOptions) > 0)
                  @foreach($deliveryOptions as $deliveryOptionKey=>$deliveryOption)
                  <tr>
                    <td>{{$deliveryOptionKey+1}}</td>
                    <td>{{$deliveryOption->heading}}</td>
                    <td>{{date('Y-m-d, h:i a', strtotime($deliveryOption['updated_at']))}}</td>
                    <td id="enable{{$deliveryOption->id}}">
                        @if($deliveryOption->status)
                            <button type="button" id="enable" onclick="UpdateStatus({{$deliveryOption->id}}, '0','deliveryStatus')" class="btn btn-success">Active</button>
                        @else
                            <button type="button" id="disable" onclick="UpdateStatus({{$deliveryOption->id}}, '1', 'deliveryStatus')" class="btn btn-danger">Inactive</button>
                        @endif
                    </td> 
                      <td><a href="{{ url('admin/master/delivery-option/edit') }}?delivery={{$deliveryOption->id}}" class="btn btn-warning">Edit</a></td>
                    
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