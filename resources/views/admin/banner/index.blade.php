@extends('layouts.app')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
          <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Banner</h3>
                </div>
            <div class="card-header">
                <p>
                    @if($btnStatus == '1')
                      <a href="{{ url('admin/master/banner') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Banner')</a>
                    @else
                      <a href="{{ url('admin/master/banner') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Banner')</a>
                    @endif
                    <a href="{{ url('admin/master/banner/create') }}" class="btn btn-success" style="float: left;">@lang('Add New Banner')</a>
                  
                </p>
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTableLength" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>First Line</th>
                      <th>Second Line</th>
                      <th>Image</th>
                      <th>Last Modified</th>
                      <th class="toggle-button">Status</th>
                      <th class="action-button">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if (count($banners) > 0)
                  @foreach($banners as $bannersKey=>$banner)
                  <tr>
                    <td>{{$bannersKey+1}}</td>
                    <td>{{$banner->first_heading}}</td>
                    <td>{{$banner->second_heading}}</td>
                    <?php 
                      $image_name = $banner->baneer_image_name;
                      $imgUrl = 'images/banner/'.$image_name;
                      $imageUrl = asset($imgUrl);
                    ?>
                    <td>
                      <img src="{{$imageUrl}}" class="user-image img-circle elevation-2" alt="{{$image_name}}" style="max-width: 20%;max-height: 2%;">
                    </td>
                    <td>{{date('Y-m-d, h:i a', strtotime($banner['updated_at']))}}</td>
                    <td id="enable{{$banner->id}}">
                        @if($banner->status)
                            <button type="button" id="enable" onclick="UpdateStatus({{$banner->id}}, '0','bannerStatus')" class="btn btn-success">Active</button>
                        @else
                            <button type="button" id="disable" onclick="UpdateStatus({{$banner->id}}, '1', 'bannerStatus')" class="btn btn-danger">Inactive</button>
                        @endif
                    </td> 
                      <td><a href="{{ url('admin/master/banner/edit') }}?banner={{$banner->id}}" class="btn btn-warning">Edit</a></td>
                    
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