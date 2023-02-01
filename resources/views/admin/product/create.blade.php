@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('/css/admin/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('/css/admin/select2-bootstrap4.min.css')}}">
@if ($errors->count() > 0)
<p class="help-block" style="color: red;">
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
      <div class="col-md-12" style="padding: 12px;">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">
              @if(isset($productDetails) && !empty($productDetails)) Edit @else Add New @endif Product
            </h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form name="product_form" id="product_form" method="post" enctype="multipart/form-data" action="store">
            {{ csrf_field() }}
            @if(isset($productDetails))
            <input type="hidden" name="id" id="id" value="{{$productDetails->id}}">
            @else
            <input type="hidden" name="id" id="id" value="0">
            @endif
            <div class="card-body">
              <div class="row">



                <div class="col-md-7">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputBlogName">Product Name*</label>
                        <input type="text" class="form-control required_field" name="product_name" id="product_name" autocomplete="off" value="@if(isset($productDetails['product_name']) && !empty($productDetails['product_name'])) {{$productDetails['product_name']}} @endif" placeholder="Enter Product Name" maxlength=30>
                        <span class="invalid-feedback" role="alert">
                          <strong id="product_name-error"></strong>
                        </span>
                      </div>
                    </div>



                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Category*</label>
                        <select class="form-control select2bs4 select2-hidden-accessible required_field" id="product_category_id" name="product_category_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                          <option selected="selected">Select Category</option>
                          @if (count($categories) > 0)
                          @foreach($categories as $categoryKey=>$category)
                          <option @if(isset($productDetails->product_category_id) && $productDetails->product_category_id == $category->id) selected="selected" @endif value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                          @endif
                        </select>
                        <span class="invalid-feedback" role="alert">
                          <strong id="product_category_id-error"></strong>
                        </span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Product</label>

                        <select class="form-control select2bs4 select2-hidden-accessible required_field" id="parent_product_id" name="parent_product_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                          <option selected="selected">Select Product</option>
                          <option @if(isset($productDetails->parent_product_id) && $productDetails->parent_product_id ==0) selected="selected" @endif value="0">Parent</option>
                          @if (count($products) > 0)
                          @foreach($products as $productsKey=>$product)
                          <option @if(isset($productDetails->parent_product_id) && $productDetails->parent_product_id == $product->id) selected="selected" @endif value="{{$product->id}}">{{$product->name}} </option>
                          @endforeach
                          @endif
                        </select>
                        <span class="invalid-feedback" role="alert">
                          <strong id="parent_product_id-error"></strong>
                        </span>
                      </div>
                    </div>



                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputBlogName">Upload Image want?*</label>
                        @if(isset($productDetails))
                        <input type="number" class="form-control required_field" name="imageCount" id="imageCount" value="0" placeholder="0" max=30 min="0">
                        @else
                        <input type="number" class="form-control required_field" name="imageCount" id="imageCount" value="0" placeholder="0" max=30 min="1">
                        @endif

                        <span class="invalid-feedback" role="alert">
                          <strong id="imageCount-error"></strong>
                        </span>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Brand*</label>
                        <select class="form-control select2bs4 select2-hidden-accessible required_field" id="product_brand_id" name="product_brand_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                          <option selected="selected">Select Brand</option>
                          @if (count($brands) > 0)
                          @foreach($brands as $brandKey=>$brand)
                          <option @if(isset($productDetails->product_brand_id) && $productDetails->product_brand_id == $brand->id) selected="selected" @endif value="{{$brand->id}}">{{$brand->name}}</option>
                          @endforeach
                          @endif
                        </select>
                        <span class="invalid-feedback" role="alert">
                          <strong id="product_brand_id-error"></strong>
                        </span>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Sub Category*</label>
                        <select class="form-control select2bs4 select2-hidden-accessible required_field" id="product_subcategory_id" name="product_subcategory_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
                          <option selected="selected">Select Sub Category</option>
                          @if (count($subCategories) > 0)
                          @foreach($subCategories as $subCategoyKey=>$subCategoy)
                          <option @if(isset($productDetails->product_subcategory_id) && $productDetails->product_subcategory_id == $subCategoy->id) selected="selected" @endif value="{{$subCategoy->id}}">{{$subCategoy->name}}</option>
                          @endforeach
                          @endif
                        </select>
                        <span class="invalid-feedback" role="alert">
                          <strong id="product_subcategory_id-error"></strong>
                        </span>
                      </div>
                    </div>



                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputBlogName">Product Color*</label>
                        <input type="text" class="form-control" name="product_color" id="product_color" autocomplete="off" value="@if(isset($productDetails['product_color']) && !empty($productDetails['product_color'])) {{$productDetails['product_color']}} @endif" placeholder="Enter Product Color Code" maxlength=30>
                        <span class="invalid-feedback" role="alert">
                          <strong id="product_color-error"></strong>
                        </span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputBlogName">Product Size*</label>
                        <input type="text" class="form-control" name="product_size" id="product_size" autocomplete="off" value="@if(isset($productDetails['product_size']) && !empty($productDetails['product_size'])) {{$productDetails['product_size']}} @endif" placeholder="Enter Product Size" maxlength=30>
                        <span class="invalid-feedback" role="alert">
                          <strong id="product_size-error"></strong>
                        </span>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="exampleInputBlogName">Product Cost*</label>
                        <input type="text" class="form-control required_field currency" name="product_cost" id="product_cost" autocomplete="off" value="@if(isset($productDetails['product_cost']) && !empty($productDetails['product_cost'])) {{$productDetails['product_cost']}} @endif" placeholder="Enter Product Cost" maxlength=30>
                        <span class="invalid-feedback" role="alert">
                          <strong id="product_cost-error"></strong>
                        </span>
                      </div>
                    </div>

                  </div>

                  <div id="inputImageDiv">

                  </div>



                </div>

                <div class="col-md-5">
                  <div class="row col-md-12">
                    <div class="form-group">
                      <label for="exampleInputBlogName">Product Desc*</label>
                      <textarea id="product_description" name="product_description" class="form-control ckeditor required_field">
                        @if(isset($productDetails['product_description']) && !empty($productDetails['product_description'])) {{$productDetails['product_description']}} @endif
                      </textarea>
                      <span class="invalid-feedback" role="alert">
                        <strong id="product_description-error"></strong>
                      </span>
                    </div>
                  </div>

                </div>




              </div>





              <!-- /.card-body -->
            </div>

            <div class="card-footer">
              <div class="col-md-12">
                <button type="button" class="btn btn-primary float-right nameButton" id="product_form-submit"><i class="fas fa-spinner fa-pulse d-none" id="product_form-submit-spin"></i> Submit</button>
                <button type="submit" class="d-none btn btn-primary float-right nameButton" id="product_form-store"> Submit</button>
              </div>
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

<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script src="{{asset('/js/admin/select2.full.min.js')}}"></script>
<!-- <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script> -->
<script>
  $(document).ready(function() {
    //apply on typing and focus
    $('input.currency').on('blur', function() {
      $(this).manageCommas();
    });
    //then sanatize on leave
    // if sanitizing needed on form submission time, 
    //then comment beloc function here and call in in form submit function.
    $('input.currency').on('focus', function() {
      $(this).santizeCommas();
    });
  });

  String.prototype.addComma = function() {
    return this.replace(/(.)(?=(.{3})+$)/g, "$1,").replace(',.', '.');
  }
  //Jquery global extension method
  $.fn.manageCommas = function() {
    return this.each(function() {
      $(this).val($(this).val().replace(/(,|)/g, '').addComma());
    });
  }

  $.fn.santizeCommas = function() {
    return $(this).val($(this).val().replace(/(,| )/g, ''));
  }
</script>

<script>
  $(document).ready(function() {
    $('.select2').select2();
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    $('.ckeditor').ckeditor();

  });
</script>
<script type="text/javascript">
  $("#product_category_id").change(function() {
    let productCatId = $('#product_category_id').val();
    $.ajax({
      dataType: "json",
      type: "post",
      url: "{{url('admin/data')}}",
      data: {
        "_token": "{{ csrf_token() }}",
        'id': productCatId,
        'type': 'productCatId'
      }
    }).done(function(data) {
      var htmlOption = '';
      if (data.code == 200) {
        let subCategories = data.categories;
        let brands = data.brands;
        let products = data.products;
        let brandHtml = '<option selected="selected" value="">Select Brand</option>';
        let subCategoryHtml = '<option selected="selected" value="">Select sub Category</option>';
        let productsHtml = '<option selected="selected" value="">Select Product</option><option value="0" >Parent</option>';
        if (brands.length) {
          for (let k = 0; k < brands.length; k++) {
            let brand = brands[k]
            let brandId = brand.id;
            let brandname = brand.name;
            brandHtml = brandHtml + '<option value="' + brandId + '">' + brandname + '</option>';
          }


        }
        if (products.length) {
          for (let m = 0; m < products.length; m++) {
            let product = products[m]
            let productId = product.id;
            let productname = product.name;
            productsHtml = productsHtml + '<option value="' + productId + '">' + productname + '</option>';
          }


        }
        if (subCategories.length) {
          for (let l = 0; l < subCategories.length; l++) {
            let subCategory = subCategories[l]
            let subCategoryId = subCategory.id;
            let sbCatname = subCategory.name;
            subCategoryHtml = subCategoryHtml + '<option value="' + subCategoryId + '">' + sbCatname + '</option>';
          }


        }
        $('#product_subcategory_id').html(subCategoryHtml);
        $('#product_brand_id').html(brandHtml);
        $('#parent_product_id').html(productsHtml);

      }
    });




  });
  $("#imageCount").change(function() {

    let imageCount = $("#imageCount").val();
    let editVal = $("#id").val();
    let classVar = "";
    if (editVal == 0) {
      classVar = 'required_field';
    } else {
      classVar = '';
    }
    console.log(classVar);
    let imageDivHtml = '<div class="row">';
    for (let i = 1; i <= imageCount; i++) {
      imageDivHtml = imageDivHtml + '<div class="col-md-4"><div class="form-group"><label for="exampleInputBlogName">Product Image ' + i + ' *</label><input type="file" class="form-control ' + classVar + '" name="productImage[]" id="productImage' + i + '" accept="image/*" ><span class="invalid-feedback" role="alert"><strong id="productImage' + i + '-error"></strong></span></div></div>';
    }
    imageDivHtml = imageDivHtml + '</div>';
    $('#inputImageDiv').html(imageDivHtml);

  });
  // Form Submit
  $("#product_form-submit").click(function() {
    var url = "{{ url('admin/master/category/store') }}";
    var server_error_msg = "Server error, please contact to admin.";
    var errorArray = [];
    $('.required_field').each(function() {
      var id = $(this).attr("id");
      console.log(id);
      var status = setRequired(id);
      if (status == false) {
        errorArray.push(id);
      }
    });
    if (errorArray.length) {
      return false;
    } else {
      $("#product_form-store").click();
    }

  });

  function setRequired(id) {

    if (id == 'product_description') {
      var idVal = CKEDITOR.instances[id].getData();
      console.log(idVal);
    } else {
      var idVal = $.trim($('#' + id).val());
    }

    if (idVal == '') {
      $('#' + id).addClass('is-invalid');
      $(`#${id}-error`).html(`The ${id} field is required.`);
      $(`#${id}-icon`).removeClass('text-success');
      return false;
    } else {
      $('#' + id).removeClass('is-invalid');
      $(`#${id}-icon`).addClass('text-success');
      $(`#${id}-error`).html('');
      return true;
    }
  }

  function removeDisabled(storeType) {
    $(`#${storeType}-submit-spin`).addClass('d-none');
    $(`#${storeType}-submit`).prop('disabled', false);
  }
</script>
<script>

</script>
<!-- <script>
  $(document).ready(function() {
    //apply on typing and focus
    $('input.currency').on('blur', function() {
      $(this).manageCommas();
    });
    //then sanatize on leave
    // if sanitizing needed on form submission time, 
    //then comment beloc function here and call in in form submit function.
    $('input.currency').on('focus', function() {
      $(this).santizeCommas();
    });
  });

  String.prototype.addComma = function() {
    return this.replace(/(.)(?=(.{3})+$)/g, "$1,").replace(',.', '.');
  }
  //Jquery global extension method
  $.fn.manageCommas = function() {
    return this.each(function() {
      $(this).val($(this).val().replace(/(,|)/g, '').addComma());
    });
  }

  $.fn.santizeCommas = function() {
    return $(this).val($(this).val().replace(/(,| )/g, ''));
  }
</script> -->

@endpush