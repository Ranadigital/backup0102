@extends('layouts.app')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
      <div class="row">
          <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">@if(isset($productDetails->product_name) && !empty($productDetails->product_name)){{$productDetails->product_name}} @endif Images</h3>
                </div>
            <div class="card-header">
                
            </div>
            <!-- /.card-header -->
              <div class="card-body">
                <table id="dataTableLength" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Name</th>
                      <th>Image</th>
                      <th class="toggle-button">Status</th>
                      <th class="action-button">Action</th>
                    </tr>
                  </thead>
                <tbody>
                @if (count($productImages) > 0)
                  
                    @foreach($productImages as $productImageKey=>$productImagesVal)
                      <tr>
                        <td>{{$productImageKey+1}}</td>
                        <td>{{$productImagesVal['image_name']}}</td>
                        <?php 
                          $image_name = $productImagesVal['image_name'];
                          $imgUrl = 'images/product/'.$image_name;
                          $imageUrl = asset($imgUrl);
                        ?>
                        <td>
                          <img src="{{$imageUrl}}" class="user-image img-circle elevation-2" alt="{{$image_name}}" style="max-width: 20%;max-height: 2%;">
                        </td>
                        <td id="enable{{$productImagesVal['id']}}">
                          @if($productImagesVal['status'])
                            <button type="button" id="enable" onclick="UpdateStatus({{$productImagesVal['id']}}, '0','productImageStatus')" class="btn btn-success">Active</button>
                          @else
                            <button type="button" id="disable" onclick="UpdateStatus({{$productImagesVal['id']}}, '1', 'productImageStatus')" class="btn btn-danger">Inactive</button>
                          @endif
                        </td> 
                        <td>
                          <span class="pull-right" id="prime{{$productImagesVal['id']}}">
                            @if($productImagesVal['is_prime'])
                              <button type="button" id="prime" onclick="UpdateStatus({{$productImagesVal['id']}}, '0','productImagePrimeStatus')" class="btn btn-success">Prime</button>
                            @else
                              <button type="button" id="unPrime" onclick="UpdateStatus({{$productImagesVal['id']}}, '1', 'productImagePrimeStatus')" class="btn btn-danger">Non-Prime</button>
                            @endif
                          </span>
                        </td>
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