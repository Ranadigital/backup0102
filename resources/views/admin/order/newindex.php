@extends('layouts.app')

@section('content')


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-3">
              <h3 class="card-title">Order</h3>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Start Date:</label>
                <div class="input-group date" data-target-input="nearest">
                  <input type="date" class="form-control datetimepicker-input" id="searchStartdate">
                  
                </div>
                
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>End Date:</label>
                <div class="input-group date" data-target-input="nearest">
                  <input type="date" class="form-control datetimepicker-input" id="searchEnddate">
                </div>
                
              </div>
            </div>
            <div class="col-3">
              <button style="cursor: pointer; float: right;" class="btn btn-outline-info" id="downloadCsv" onclick="exportCsv()">Export Order to CSV file</button>
            </div>
          </div>
          
          
          
        </div>
        
      <!-- /.card-header -->
      <div class="card-body">
        <table id="dataTableLength" class="table table-bordered table-striped">
          <thead>
            <tr>
              
              <th>Order No.</th>
              <th>Customer</th>
              <th>Flight Details</th>
              <th>Pickup By</th>
              <th>Cost</th>
              <th class="toggle-button">Payment Status</th>
              <th class="toggle-button">Order Status</th>
              <th>Details</th>
            </tr>
          </thead>
          <tbody>
            @if (count($orders) > 0)
            @foreach($orders as $orderKey=>$order)
            <tr>
              
              <td>Or-{{$order->id}}</td>
              <td>
                Name: </br>{{$order->client_name}}</br>
                Email: </br>{{$order->client_email}}
              </td>
              @php
                $strDate = $order['arrival_or_departure_date'].' '.$order->estimated_time_departure_or_arrival.':00';
                
              @endphp
              <td>
                Flight No: {{$order->flight_no }}</br>
                {{date('Y-m-d, h:i a', strtotime($strDate))}}</br>
                On {{$order->point_of_collection}}
              </td>
              <td>
                @if(isset($order->nominee_name) && !empty($order->nominee_name))
                {{$order->nominee_name}}
                @else
                Self
                @endif
              </td>
              <td>{{number_format($order->order_cost)}}</td>
              @php
                $productDetails = Helper::getOrderDetails($order->id);
              @endphp

              <td id="enable{{$order->id}}">
                {{-- @if(!$order->status)
                            <button type="button" id="enable"  class="btn btn-success">Deliverd</button>
                        @else
                            <button type="button" id="disable" onclick="UpdateStatus({{$order->id}}, '0', 'orderStatus')" class="btn btn-info">Pending</button>
                @endif --}}
                @if($order->orderStatus == 'SUCCESS')
                <span class="right badge badge-success">Payment Success</span>
                @elseif($order->orderStatus == 'FAILED')
                <span class="right badge badge-danger">Payment Failed</span>
                @elseif($order->orderStatus == 'CANCEL')
                <span class="right badge badge-warning">Payment Cancel</span>
                @else
                <span class="right badge badge-info">@if(isset($order->orderStatus) && !empty($order->orderStatus)) {{$order->orderStatus}} @else Pending @endif</span>
                @endif
                </br>
               
              </td>
              <td> <select class="form-control select2bs4 select2-hidden-accessible required_field" id="updateOrder{{$order->id}}" name="updateOrder{{$order->id}}" style="width: 100%;" tabindex="-1" aria-hidden="true" onchange="UpdateOrderStatus({{$order->id}})">
                  <option selected="selected" value="">Select Order Status</option>
                  <option @if(isset($order->status) && $order->status == 2) selected="selected" @endif value="2">Ready For Collection</option>
                  <option @if(isset($order->status) && $order->status == 3) selected="selected" @endif value="3">Cancelled By Sindbad</option>
                  <option @if(isset($order->status) && $order->status == 1) selected="selected" @endif value="4">Customer Delivered</option>
                  <!-- <option @if(isset($order->status) && $order->status == 4) selected="selected" @endif value="5">Payment completed</option> -->
                  <option @if(isset($order->status) && $order->status == 0) selected="selected" @endif value="0">Pending</option>
                </select>
              </td>
              <td>
                @if(isset($productDetails) && !empty($productDetails) && count($productDetails) > 0)
                  <!-- <table>
                    <tbody> -->
                      @foreach($productDetails as $productKey=>$product)
                        <!-- <tr> -->
                          @php 
                            $productName = Helper::getProductName($product->product_id);
                            $productTotalCost = $product->product_cost * $product->product_count;
                          @endphp

                          {{$productName}} ({{$product->product_cost}} * {{$product->product_count}}) = {{$productTotalCost}}</br>
                        <!-- </tr> -->
                      @endforeach
                      
                    <!-- </tbody>
                  </table> -->
                @else

                @endif
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
<div class="modal fade" id="modal-info">
  <div class="modal-dialog">
    <div class="modal-content bg-info">
      <div class="modal-header">
        <h4 class="modal-title">Order Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
      <div class="modal-body" id="modalBody">
      </div>
      <div class="modal-footer justify-content-between">
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script type="text/javascript" src="https://chir.ag/projects/ntc/ntc.js"></script>
<!-- <script type="text/javascript" src="jquery-1.12.0.min.js"></script> -->
<!-- <script src="{{asset('js/bootstrap.min.js')}}"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
    <!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
   

<script type="text/javascript">

  // $(document).ready(function() {
  //   $('#orderDataTableLength').DataTable({
  //      buttons: [
  //       'copy', 'excel', 'pdf'
  //     ]
  //   });

    
  //   //Date picker
  //   // $('#searchEnddate').datetimepicker({
  //   //     format: 'L'
  //   // });

  //   // //Date picker
  //   // $('#searchStartdate').datetimepicker({
  //   //     format: 'L'
  //   // });
  // });

  
  
  function exportCsv() {
    let startDate = $('#searchStartdate').val();
    let endDate = $('#searchEnddate').val();
    if(startDate && endDate){
      let url = '/admin/order/download-csv?startDate='+startDate+'&endDate='+endDate;
        window.open(url);
    }else{
      alert('Please select Start & End Date');
    }
  }
  function getOrderDetails(orderId) {
    $.ajax({
      dataType: "json",
      type: "post",
      url: "{{url('admin/order/order-data')}}",
      data: {
        "_token": "{{ csrf_token() }}",
        'orderId': orderId
      }
    }).done(function(data) {
      var htmlOption = '';
      if (data.code == 200) {
        $('#modalBody').html('');
        let productData = data.data.product;
        let order_comments = data.data.order_comments;
        var html = '<p>' + order_comments + '</p>';
        html = html + '<table class="table"><thead><tr><th>Name</th><th>Size</th><th>Count</th></tr></thead><tbody>';
        if (productData.length > 0) {
          for (let k = 0; k < productData.length; k++) {
            let product = productData[k];
            let product_name = product.product_name;
            let colorHexVal = '#' + product.product_color;
            let color = ntc.name(colorHexVal);
            let product_color = color[1] + ' (' + product.product_color + ')';
            let product_size = product.product_size;
            let product_count = product.product_count;
            html = html + '<tr><td>' + product_name + '</td><td>' + product_size + '</td><td>' + product_count + '</td>'

          }
          html = html + '</tbody></table>';
        }
        $('#modalBody').html(html);


      }
    });
  }

  function UpdateOrderStatus(orderId) {
    let seletedVal = $('#updateOrder' + orderId).val();
    if (seletedVal != '') {
      let seletedText = $('#updateOrder' + orderId).children("option").filter(":selected").text();
      let isExecuted = confirm("Are you sure to update order status: " + seletedText + " ?");
      if (isExecuted) {
        $.ajax({
          dataType: "json",
          type: "post",
          url: "{{url('admin/order/update-order-status')}}",
          data: {
            "_token": "{{ csrf_token() }}",
            'orderId': orderId,
            'status': seletedVal
          }
        }).done(function(data) {
          if (data.code == 200) {
            alert(data.msg);
          } else {
            alert(data.msg);
          }
        });
      } else {
        return false;
      }
    } else {
      return false;
    }

  }

</script>

@endpush