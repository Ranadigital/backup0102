<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thank you emailer</title>
  <style>
    table,
    th,
    td,
    p,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    body {
      font-family: Arial, sans-serif !important;
    }
    .table_list th{background-color: #ececec;}
    .table_list table,
    .table_list th,
    .table_list td {
      border: 1px solid #bdbdbd;
      border-collapse: collapse;
    }
    .table_list{ border-collapse: collapse;}
  </style>
</head>

<body>

  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;" style="background-color: rgb(237, 249, 253);" bgcolor="#edf9fd" border="0" cellpadding="0" cellspacing="0">
    <tbody>
      <tr>
        <td align="center" style="padding:0;">
          <table role="presentation" style="max-width:780px;border-collapse:collapse;border-spacing:0;text-align:left;">
            <tbody>
              <tr>
                <td style="padding:0px 0px 0px 0px; ">
                  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;padding:30px; background-color: #fff8f8;">
                    <tbody>
                      <tr>
                        <td style="padding:15px;background-color:#111111; text-align:center; background-color: #ebebeb;">
                          <a href="http://sindbad.omanair.com/" target="_blank"> <img src="{{asset('images/Sindbad_Logo-tem.png')}}" alt="Sindbad" style="max-width: 200px;"></a>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding:30px 30px;color:#111111; border-bottom:1px solid #e5e5e5;">
                          <p style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif; font-weight: bold;"> Dear @if(isset($orderData['client_name']) && !empty($orderData['client_name'])) {{$orderData['client_name']}} @else Customer @endif,</p>

                          @if(isset($orderData['updateStatus']) && !empty($orderData['updateStatus']))
                            <h1 style="font-size:18px;margin:0 0 20px 0;font-family:Arial,sans-serif;text-align: left; text-transform:uppercase;"> WE’VE UPDATE YOUR ORDER! </h1>
                          @else
                            @if(isset($orderData['orderStatus']) && $orderData['orderStatus'] == 'SUCCESS')
                              <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"> Your order is submitted. Your order details can be found below.</p>
                              <h1 style="font-size:18px;margin:0 0 20px 0;font-family:Arial,sans-serif;text-align: left; text-transform:uppercase;"> We’re happy to let you know that we’ve received your order. </h1>
                            @else
                              <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"> Sorry that we could not process your order.</p>
                              <h1 style="font-size:18px;margin:0 0 20px 0;font-family:Arial,sans-serif;text-align: left; text-transform:uppercase;"> Please try after sometime or contact sindbad@omanair.com for further assistance. Your inconvenience is regretted. </h1>
                              
                            @endif
                            <!-- <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"> Your order is submitted. Your order details can be found below.</p> -->
                          @endif



                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 30px 30px;" valign="top">
                          <table align="left" border="0" cellpadding="0" cellspacing="0" width="100%" ">
                            <tbody>
                              <tr>
                                <td valign="top">
                                  <table align="left" border="0" cellspacing="0" width="100%" class="table_list">
                                    <tbody>
                                      <tr>
                                        <th style="padding: 8px 15px;  width: 50%; text-align: left;"> Sindbad Number:</th>
                                        <th style="padding: 8px 15px;  width: 50%; text-align: right;">@if(isset($orderData['client_number']) && !empty($orderData['client_number'])) {{$orderData['client_number']}} @endif</th>
                                      </tr>
                                      <tr>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: left;"> Email:</td>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: right;">@if(isset($orderData['client_email']) && !empty($orderData['client_email'])) {{$orderData['client_email']}} @endif</td>
                                      </tr>
                                      <tr>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: left;"> Order No:</td>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: right;">
                                           @if(isset($orderData['point_of_collection']) && $orderData['point_of_collection'] === 'Arrivals Duty Free Shop')
                                              AOR-{{$orderData['id']}}
                                           @else
                                              DOR-{{$orderData['id']}}
                                           @endif
                                           
                                         </td>
                                      </tr>
                                      <tr>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: left;"> Order Date:</td>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: right;"> {{date('Y-m-d, h:i a', strtotime($orderData['updated_at']))}}</td>
                                      </tr>
                                      <tr>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: left;"> Order Status:</td>
                                        @if(isset($orderData['updateStatus']) && !empty($orderData['updateStatus']))
                                        <td style="padding: 8px 15px;  width: 50%; text-align: right;">
                                          @if(isset($orderData['status']) && $orderData['status'] == 1)
                                          Order Received
                                          @elseif(isset($orderData['status']) && $orderData['status'] == 2)
                                          Ready For Collection
                                          @elseif(isset($orderData['status']) && $orderData['status'] == 3)
                                          Collected by Customer
                                          @elseif(isset($orderData['status']) && $orderData['status'] == 4)
                                          Payment completed
                                          @elseif(isset($orderData['status']) && $orderData['status'] == 0)
                                          Pending
                                          @else
                                          Failed
                                          @endif
                                        </td>
                                        @else
                                        <td style="padding: 8px 15px;  width: 50%; text-align: right;"> @if(isset($orderData['orderStatus']) && $orderData['orderStatus'] == 'SUCCESS') Received @else Failed @endif </td>
                                        @endif


                                      </tr>
                                      <tr>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: left;"> Collection Point:</td>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: right;"> {{$orderData['point_of_collection']}} </td>
                                      </tr>
                                      <tr>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: left;"> Flight No:</td>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: right;"> {{$orderData['flight_no']}}</td>
                                      </tr>
                                      <tr>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: left;"> Collection Date:</td>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: right;">
                                          {{date('Y-m-d', strtotime($orderData['arrival_or_departure_date']))}}
                                        </td>
                                      </tr>
                                      <tr>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: left;"> Arrival Time:</td>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: right;"> {{$orderData['estimated_time_departure_or_arrival']}}</td>
                                      </tr>
                                      <tr>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: left;"> Name:</td>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: right;"> @if(isset($orderData['client_name']) && !empty($orderData['client_name'])) {{$orderData['client_name']}} @endif</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>

                        </td>
                      </tr>
                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td style="padding:0px 30px 30px 30px; background-color: #fff8f8;">
                  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;padding:30px; background-color: #ffffff;">
                    <tbody>
                      <tr>
                        <td style="padding:10px 20px;color:#111111;">
                          <h1 style="font-size:18px;margin:0 0 0px 0;font-family:Arial,sans-serif;text-align: center;"> ORDER BRIEF</h1>
                        </td>
                      </tr>
                      <tr>
                        <td style="padding: 0px 0px;" valign="top">
                          <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width: 100%;" width="100%">
                            <tbody>
                              <tr>
                                <td valign="top">
                                  <table align="left" border="0" cellspacing="10" width="100%" style="padding-top: 20px;" class="table_list">
                                    <tbody>
                                      <tr>
                                        <th style="text-align: left; padding: 8px 15px">ITEMS</th>
                                        <th style="text-align: center; padding: 8px 15px">UNIT PRICE</th>
                                        <th style="text-align: center; padding: 8px 15px">QTY</th>
                                        <th style="text-align: right; padding: 8px 15px">TOTAL </th>
                                      </tr>
                                      @if(isset($orderData['product']) && !empty($orderData['product']))
                                      @foreach($orderData['product'] as $productKey=>$productVal)
                                      <tr>
                                        <td style="padding: 8px 15px;  width: 50%; text-align: left;">
                                          <h4 style="padding: 0px 0px;margin: 0;"> {{$productVal['product_name']}}</h4>
                                          <p style="padding: 5px 0px;margin: 0;"> Item No: {{$productVal['productId']}}</p>
                                          @if(isset($productVal['product_size']) && !empty($productVal['product_size']))
                                          <p style="padding: 0;margin: 0;"> Size: {{$productVal['product_size']}}</p>
                                          @endif

                                        </td>
                                        <td style="padding: 8px 15px;  width: 20%; text-align: center; vertical-align:top;">
                                          <!-- 
                                                <h5 style="color: #ee4c50; padding: 0;margin: 0;"></h5>
                                                <p style="padding: 0;margin: 0;">
                                                  <del></del>
                                                </p> -->
                                          <h4 style="padding: 0;margin: 0; ">{{$productVal['product_cost']}} Miles</h4>
                                        </td>
                                        <td style="padding: 8px 15px;  width: 5%; text-align: center; vertical-align:top;"> {{$productVal['product_count']}}</td>
                                        @php
                                        $productCount = $productVal['product_count'];
                                        $productCost = $productVal['product_cost'];
                                        $totalProdCost = $productCount * $productCost;
                                        @endphp
                                        <td style="padding: 8px 15px;  width: 15%; text-align: end; vertical-align:top;"> {{$totalProdCost}} Miles</td>
                                      </tr>
                                      @endforeach

                                      @endif

                                    </tbody>
                                  </table>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>

                      <tr>
                        <td style="padding:10px 30px;color:#ffffff; background-color: #0e0e0e;">
                          <table align="left" border="0" cellspacing="0" width="100%">
                            <tbody>
                              <tr>
                                <td style="padding: 8px 15px;  width: 50%; text-align: right; font-size: 18px;"> TOTAL</td>
                                <td style="padding: 8px 15px;  width: 50%; text-align: right; font-size: 18px;">{{$orderData['order_cost']}} Miles</td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>

                      <tr>

                    </tbody>
                  </table>
                </td>
              </tr>
              <tr>
                <td style="padding:20px;background-color:#111111; text-align:center; background-color: #ebebeb;">
                  <p style="margin:0 0px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif">If you have any questions, you can reach us at Sindbad@omanair.com or call us on +968 2453 1111.</p>
                  <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif"> We are here to help!</p>
              </tr>
            </tbody>
          </table>
        </td>
      </tr>
    </tbody>
  </table>
</body>

</html>