@extends('layouts.app')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
          <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Sub Category</h3>
                </div>
            <div class="card-header">
                <p>
                  
                    @if($btnStatus == '1')
                      <a href="{{ url('admin/master/sub-category') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Sub Category')</a>
                    @else
                      <a href="{{ url('admin/master/sub-category') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Sub Category')</a>
                    @endif
                    <a href="{{ url('admin/master/sub-category/create') }}" class="btn btn-success" style="float: left;">@lang('Add New Sub Category')</a>
                  
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
                @if (count($subCategories) > 0)
                  @foreach($subCategories as $subCategoryKey=>$subCategory)
                  <tr>
                    <td>{{$subCategoryKey+1}}</td>
                    <td>{{$subCategory->sub_category_name}}</td>
                    <td>{{date('Y-m-d, h:i a', strtotime($subCategory->updated_at))}}</td>
                    <td id="enable{{$subCategory->id}}">
                        @if($subCategory->status)
                            <button type="button" id="enable" onclick="UpdateStatus({{$subCategory->id}}, '0','subCategoryStatus')" class="btn btn-success">Active</button>
                        @else
                            <button type="button" id="disable" onclick="UpdateStatus({{$subCategory->id}}, '1', 'subCategoryStatus')" class="btn btn-danger">Inactive</button>
                        @endif
                    </td> 
                    <td><a href="{{ url('admin/master/sub-category/edit') }}?sub-category={{$subCategory->id}}" class="btn btn-warning">Edit</a></td>
                    
                    
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