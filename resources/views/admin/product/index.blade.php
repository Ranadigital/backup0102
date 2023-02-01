@extends('layouts.app')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Product</h3>
        </div>
        <div class="card-header">
          <p>
            @if($btnStatus == '1')
            <a href="{{ url('admin/product') }}?type=1" class="btn btn-outline-info" style="float: right;">@lang('Show Active Product')</a>
            @else
            <a href="{{ url('admin/product') }}?type=0" class="btn btn-outline-info" style="float: right;">@lang('Show Inactive Product')</a>
            @endif
            <a href="{{ url('admin/product/create') }}" class="btn btn-success" style="float: left;">@lang('Add New Product')</a>

          </p>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="dataTableLength" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>S.No.</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Brand</th>
                <th>Miles</th>
                <!-- <th>Color</th>
                      <th>Size</th> -->
                <th>Last Modified</th>
                <th class="toggle-button">Status</th>
                <th class="action-button">Action</th>
              </tr>
            </thead>
            <tbody>
              @if (count($products) > 0)
              @foreach($products as $productKey=>$product)
              <tr>
                <?php
                $image_name = $product->image_name;
                $imgUrl = 'images/product/' . $image_name;
                $imageUrl = asset($imgUrl);
                ?>
                <td>{{$productKey+1}}</td>

                <td>
                  @if(isset($product->image_name) && !empty($product->image_name))
                  <?php
                  $image_name = $product->image_name;
                  $imgUrl = 'images/product/' . $image_name;
                  $imageUrl = asset($imgUrl);
                  ?>
                  <img src="{{$imageUrl}}" class="user-image img-circle elevation-2" alt="{{$image_name}}" style="max-width: 20%;max-height: 2%;">
                  @else
                  NA
                  @endif
                </td>

                <td>{{$product->product_name}}</td>
                <td>{{$product->category_name}}</td>
                <td>{{$product->sub_category_name}}</td>
                <td>{{$product->brand_name}}</td>
                <td>{{number_format($product->product_cost)}}</td>
                {{--<td>{{$product->product_size}}</td>--}}
                <td>{{date('Y-m-d, h:i a', strtotime($product['updated_at']))}}</td>
                <td id="enable{{$product->productId}}">
                  @if($product->status)
                  <button type="button" id="enable" onclick="UpdateStatus({{$product->productId}}, '0','productStatus')" class="btn btn-success">Active</button>
                  @else
                  <button type="button" id="disable" onclick="UpdateStatus({{$product->productId}}, '1', 'productStatus')" class="btn btn-danger">Inactive</button>
                  @endif
                </td>


                <td>
                  <a href="{{ url('admin/product/edit') }}?product={{$product->productId}}" class="btn btn-warning pull-left">Edit</a>

                  <a href="{{ url('admin/product/product-image') }}?product={{$product->productId}}" class="btn btn-info pull-right">Images</a>

                  <span class="pull-left" id="prime{{$product->productId}}">
                    @if($product->is_prime)
                    <button type="button" id="prime" onclick="UpdateStatus({{$product->productId}}, '0','productPrimeStatus')" class="btn btn-success" style="margin-top: 3%;">Prime</button>
                    @else
                    <button type="button" id="unPrime" onclick="UpdateStatus({{$product->productId}}, '1', 'productPrimeStatus')" class="btn btn-danger" style="margin-top: 3%;">Non-Prime</button>
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