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
              <h3 class="card-title pull-left">Logs</h3>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="dataTableLength" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>S No.</th>
                <th>Module</th>
                <th>Action</th>
                <th>Done By</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Data</th>
            </tr>
          </thead>
          <tbody>
            @if (count($logs) > 0)
              @foreach($logs as $logKey=>$log)
                <tr>
                  <td>{{$logKey+1}}</td>
                  <td>{{$log->module}}</td>
                  <td>{{$log->action}}</td>
                  <td>{{$log->user_email}}</td>
                  <td>{{date('Y-m-d, h:i a', strtotime($log->created_at))}}</td>
                  <td>{{date('Y-m-d, h:i a', strtotime($log->updated_at))}}</td>
                  <td>
                    {{--<div class="card col-12 collapsed-card" style="max-width: 41%;">
                      <div class="card-header">
                        <h3 class="card-title">Details</h3>
                        <div class="card-tools">
                          <!-- Collapse Button -->
                          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                        <!-- /.card-tools -->
                      </div>
                      <!-- /.card-header  -->
                      <div class="card-body" >
                        <table >
                          <thead>
                            <tr>
                              <th>Key</th>
                              <th>New Data</th>
                              <th>Old Data</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php 
                              $oldData = json_decode($log->old_data);
                              //print_R($oldData);exit;
                              $newData = json_decode($log->new_data);
                            @endphp
                            @if (isset($newData) && !empty($newData))
                              @foreach($newData as $newDataKey=>$newDataVal)
                                <tr>
                                  <td>{{$newDataKey}}</td>
                                  <td>{{$newDataVal}}</td>
                                  <td>
                                    @if(isset($oldData->$newDataKey) && !empty($oldData->$newDataKey))
                                        {{$oldData->$newDataKey}}
                                    @endif 
                                  </td>
                                </tr>
                              @endforeach
                            @endif
                            
                          </tbody>
                        </table>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    --}}
                    {{--<div class="card">
                      <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                          <thead>
                            <tr>
                              <th>Key</th>
                              <th>New Data</th>
                              <th>Old Data</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php 
                              $oldData = json_decode($log->old_data);
                              //print_R($oldData);exit;
                              $newData = json_decode($log->new_data);
                            @endphp
                            @if (isset($newData) && !empty($newData))
                              @foreach($newData as $newDataKey=>$newDataVal)
                                <tr>
                                  <td>{{$newDataKey}}</td>
                                  <td>{{$newDataVal}}</td>
                                  <td>
                                    @if(isset($oldData->$newDataKey) && !empty($oldData->$newDataKey))
                                        {{$oldData->$newDataKey}}
                                    @endif 
                                  </td>
                                </tr>
                              @endforeach
                            @endif
                            
                          </tbody>
                        </table>
                      </div>
                    </div>--}}
                    @php 
                      $oldData = json_decode($log->old_data);
                      $newData = json_decode($log->new_data);
                    @endphp
                    <button type="button" id="enable" onclick="LogDetails({{$log->id}})" class="btn btn-success" data-toggle="modal" data-target="#modal-info">Detail</button>
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
        <h4 class="modal-title">Log Detail</h4>
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

  
  
  
  function LogDetails(logId) {
    
    
    $.ajax({
      dataType: "json",
      type: "post",
      url: "{{url('admin/logs/log-data')}}",
      data: {
        "_token": "{{ csrf_token() }}",
        'logId': logId
      }
    }).done(function(data) {
      var htmlOption = '';
      if (data.code == 200) {
        $('#modalBody').html('');
        var html = '<table class="table"><thead><tr><th>Key</th><th>New</th><th>Old</th></tr></thead><tbody>';
        let newData = data.newData;
        let olddata = data.olddata;
        for(var keys in newData){
          if(keys != 'created_at' && keys != 'updated_at'){
            html= html+'<tr><td>'+keys+'</td><td>'+newData[keys]+'</td>';
            if(olddata[keys]){
              html= html+'<td>'+olddata[keys]+'</td>';
            }else{
              html= html+'<td>Null</td>';
            }
            html=html+'</tr>';
          }
          
        }
        html = html + '</tbody></table>';
        // if (productData.length > 0) {
        //   for (let k = 0; k < productData.length; k++) {
        //     let product = productData[k];
        //     let product_name = product.product_name;
        //     let colorHexVal = '#' + product.product_color;
        //     let color = ntc.name(colorHexVal);
        //     let product_color = color[1] + ' (' + product.product_color + ')';
        //     let product_size = product.product_size;
        //     let product_count = product.product_count;
        //     html = html + '<tr><td>' + product_name + '</td><td>' + product_size + '</td><td>' + product_count + '</td>'

        //   }
        //   html = html + '</tbody></table>';
        // }
        $('#modalBody').html(html);


      }
    });
  }
  function ChangeOrderStatus(orderId){
    $('.buttonOrderDiv'+orderId).removeClass('d-none');
    $('.inputOrderDiv'+orderId).removeClass('d-none');
    $('.commentOrderDiv'+orderId).addClass('d-none');
     
  }

  function cancelUpdateOrderStatus(orderId){
    $('.buttonOrderDiv'+orderId).addClass('d-none');
    $('.inputOrderDiv'+orderId).addClass('d-none');
    $('.commentOrderDiv'+orderId).removeClass('d-none');
     
  }

  function UpdateOrderStatus(orderId) {
    let seletedVal = $('#updateOrder' + orderId).val();
    if (seletedVal != '') {
      let seletedText = $('#updateOrder' + orderId).children("option").filter(":selected").text();
      let isExecuted = confirm("Are you sure to update order status: " + seletedText + " ?");
      let orderComent = $('#inputOrder'+orderId).val();
      if (isExecuted) {
        $.ajax({
          dataType: "json",
          type: "post",
          url: "{{url('admin/order/update-order-status')}}",
          data: {
            "_token": "{{ csrf_token() }}",
            'orderId': orderId,
            'status': seletedVal,
            'orderComent':orderComent
          }
        }).done(function(data) {
          if (data.code == 200) {
            alert(data.msg);
            $('.commentOrderDiv'+orderId).html('<b>Comment:</b> '+orderComent);
            $('.buttonOrderDiv'+orderId).addClass('d-none');
            $('.inputOrderDiv'+orderId).addClass('d-none');
            $('.commentOrderDiv'+orderId).removeClass('d-none');
          } else {
            alert(data.msg);
            $('.buttonOrderDiv'+orderId).addClass('d-none');
            $('.inputOrderDiv'+orderId).addClass('d-none');
            $('.commentOrderDiv'+orderId).removeClass('d-none');
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
