@include('layouts.frontendTopbar')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/compiled-4.20.0.min.css">
    <link href="{{asset('/css/style.css')}}" rel="stylesheet">
    </head>
    <body>
        <div class="page-wrap bg-white">
            <div class="container">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                    <ol class="breadcrumb py-2  d-flex align-items-center">
                      <li class="breadcrumb-item"><a href="{{ url('') }}"><img src="{{asset('/images/home-icon.svg')}}" class="img-fluid"> Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Order</li>
                    </ol>
                  </nav>
                 
                  <div class=" py-3">
                        <div class="row">
                          <div class="col-md-12">
                           <div class="my-checkout">
                            <h1 class="mb-3">Order </h1>
                           
                           <div class="col-md-12">
                                <div class="order-summary-wrapper p-3">
                                    <div class="order-details">
                                        <div class="title">
                                            <span><img src="{{asset('/images/cart.svg')}}" class="img-fluid"></span>
                                            Your Order Status:{{$response['orderStatus']}} 

                                            @if(isset($response['orderStatus']) && $response['orderStatus'] == 'SUCCESS')
                                                <h1 style="font-size:18px;margin:0 0 20px 0;font-family:Arial,sans-serif;text-align: left; text-transform:uppercase;"> Congratulations! Your order has been placed successfully. You will shortly receive the order confirmation by email. Thank you for shopping with us. </h1>
                                                <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"> Your order is submitted. Your order details can be found below.</p>
                                              @else
                                                <!-- <p style="margin:0 0 12px 0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"> Sorry that we could not process your order.</p> -->
                                                <h1 style="font-size:18px;margin:0 0 20px 0;font-family:Arial,sans-serif;text-align: left; text-transform:uppercase;">Sorry that we could not process your order. Please try after sometime or contact sindbad@omanair.com for further assistance. Your inconvenience is regretted.</h1>
                                                
                                              @endif
                                        </div>
                                        <div class="order-info">
                                            <div class="title mt-3 mb-3">Your Order</div>
                                            <div class="item">
                                                <span>Product</span>
                                                <!-- <span>Redemption Code</span> -->
                                            </div>
                                            <div id="productSeleted">
                                                @if(isset($orderDetails) && !empty($orderDetails))
                                                    @foreach($orderDetails as $detailKey=>$detailVal)

                                                        @php
                                                            $productId = $detailVal->product_id;
                                                            $productName =  Helper::getProductName($productId);
                                                        @endphp
                                                        <div class="item">
                                                            <span>
                                                                {{$productName}} 
                                                            </span>
                                                            {{--<span>
                                                                {{$detailVal->redemptionActivityCode}}  
                                                            </span>--}}
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-details">
                                        <div class="title">
                                            <span><img src="{{asset('/images/cart.svg')}}" class="img-fluid"></span>
                                            Order Delivery Information
                                        </div>
                                        <div id="productSeleted">
                                            <div class="item">
                                                <span>Name:</span>
                                                <span class="pull-right"> {{$order->client_name}}</span>
                                            </div>
                                            <div class="item">
                                                <span> Arrival/ Departure Date:</span>
                                                <span class="pull-right"> {{$order->arrival_or_departure_date}}</span>
                                            </div>
                                            <div class="item">
                                                <span> Flight No:</span>
                                                <span class="pull-right"> {{$order->flight_no}}</span>
                                            </div>
                                            <div class="item">
                                                <span> Flight Time</span>
                                                <span class="pull-right"> {{$order->estimated_time_departure_or_arrival}}</span>
                                            </div>
                                            
                                        </div>

                                    </div>
                                </div>
                           </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.frontendFooter')
        <!-- <script src="{{asset('js/jquery-3.6.1.min.js')}}"></script> -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <script src="{{asset('js/bootstrap.min.js')}}"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script> -->
        <!-- <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
        <script type="text/javascript">
            $.cookie('rewardSbCart', '', { expires: 7, path: '/' });
        </script>
    </body>
</html>


