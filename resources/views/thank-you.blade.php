<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/compiled-4.20.0.min.css">
<link href="{{asset('/css/style.css')}}" rel="stylesheet">
<style>
    div#productSeleteds .item {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        background-color: #f4f4f4;
        margin-bottom: 5px;
        /* border: 1px solid; */
    }

    li.breadcrumb-item.active.thank_bread::before {
        position: relative;
        top: 7px;
    }

    @media screen and (max-width: 767px) {
        div#productSeleteds .item {
            display: grid;
        }
    }
</style>
</head>

<body>
    @include('layouts.frontendTopbar')
    <div class="page-wrap bg-white">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb py-2  d-flex align-items-center">
                    <li class="breadcrumb-item"><a href="{{ url('') }}"><img src="{{asset('/images/home-icon.svg')}}" class="img-fluid"> Home</a></li>
                    <li class="breadcrumb-item active thank_bread" aria-current="page">Order</li>
                </ol>
            </nav>

            <div class=" py-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="my-checkout">
                            <h1 class="mb-3">Order Detail </h1>

                            <div class="col-md-12">
                                <div class="order-summary-wrapper p-3">
                                    <div class="order-details">
                                        <div class="title">
                                            <span><img src="{{asset('/images/cart.svg')}}" class="img-fluid"></span>
                                            Your Order Details
                                        </div>
                                        <div class="order-info">
                                            <div class="title mt-3 mb-3">Your Order</div>
                                            <div class="item">
                                                <span>Product</span>
                                                <span>Miles</span>
                                            </div>
                                            <div id="productSeleted">
                                                @if(isset($orderData['product']) && !empty($orderData['product']))
                                                @foreach($orderData['product'] as $orderDataKey=>$orderDataVal)
                                                <div class="item">
                                                    <span>
                                                        {{$orderDataVal['product_name']}} ({{number_format($orderDataVal['product_cost'])}} miles * {{$orderDataVal['product_count']}} )
                                                    </span>
                                                    <span>
                                                        @php
                                                        $prodTotalCost = $orderDataVal['product_cost'] * $orderDataVal['product_count'];
                                                        @endphp
                                                        {{number_format($prodTotalCost)}} miles
                                                    </span>
                                                </div>
                                                @endforeach
                                                @endif
                                                <div class="item">
                                                    <span class="fw-600"><b>Total</b></span>
                                                    <span class="fw-600"><b>
                                                            @if(isset($orderDetails->order_cost) && !empty($orderDetails->order_cost))
                                                            {{number_format($orderDetails->order_cost)}} miles
                                                            @else
                                                            0 miles
                                                            @endif
                                                        </b>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-details">
                                        <div class="title">
                                            <span><img src="{{asset('/images/cart.svg')}}" class="img-fluid"></span>
                                            Order Delivery Information
                                        </div>
                                        <div id="productSeleteds">
                                            @if(isset($orderDetails->arrival_or_departure_date) && !empty($orderDetails->arrival_or_departure_date))
                                            <div class="item">
                                                <span> Arrival/ Departure Date : </span>
                                                <span class="pull-right">
                                                    {{date('Y-m-d', strtotime($orderDetails->arrival_or_departure_date))}}
                                                </span>
                                            </div>
                                            @endif
                                            @if(isset($orderDetails->estimated_time_departure_or_arrival) && !empty($orderDetails->estimated_time_departure_or_arrival))
                                            <div class="item">
                                                <span> Estimated Time : </span>
                                                <span class="pull-right"> {{$orderDetails->estimated_time_departure_or_arrival}}</span>
                                            </div>
                                            @endif
                                            @if(isset($orderDetails->flight_no) && !empty($orderDetails->flight_no))
                                            <div class="item">
                                                <span> Flight Number : </span>
                                                <span class="pull-right"> {{$orderDetails->flight_no}}</span>
                                            </div>
                                            @endif
                                            @if(isset($orderDetails->is_transict_customer))
                                            <div class="item">
                                                <span> Transit Customer : </span>
                                                <span class="pull-right"> @if($orderDetails->is_transict_customer == 1) Yes @else No @endif</span>
                                            </div>
                                            @endif
                                            <!-- @if(isset($orderDetails->arrival_or_departure_date))
                                                <div class="item">
                                                    <span class="pull-right"> Transit Customer : </span>
                                                    <span class="pull-right"> @if($orderDetails->arrival_or_departure_date == 1) Yes @else No @endif</span>
                                                </div>
                                            @endif -->
                                            @if(isset($orderDetails->point_of_collection) && !empty($orderDetails->point_of_collection))
                                            <div class="item">
                                                <span> Point Of Collection : </span>
                                                <span class="pull-right"> {{$orderDetails->point_of_collection}}</span>
                                            </div>
                                            @endif
                                            @if(isset($orderDetails->pickup_person) && !empty($orderDetails->pickup_person))
                                            <div class="item">
                                                <span> Pickup : </span>
                                                <span class="pull-right"> {{$orderDetails->pickup_person}}</span>
                                            </div>
                                            @endif
                                            @if(isset($orderDetails->nominee_name) && !empty($orderDetails->nominee_name))
                                            <div class="item">
                                                <span> Nominee : </span>
                                                <span class="pull-right"> {{$orderDetails->nominee_name}}</span>
                                            </div>
                                            @endif
                                            @if(isset($orderDetails->order_comments) && !empty($orderDetails->order_comments))
                                            <div class="item">
                                                <span> <b>Order Comment : </b></span>
                                                <span class="pull-right"> {{$orderDetails->order_comments}}</span>
                                            </div>
                                            @endif
                                            @if(isset($orderRequest) && !empty($orderRequest))
                                            <form name="storeOrder" id="storeOrder" method="post" enctype="multipart/form-data" action="{{$postUrl}}">
                                                {{--<form name="storeOrder" id="storeOrder" method="post" enctype="multipart/form-data" action="{{url('payment')}}"> --}}

                                                @foreach($orderRequest as $orderKey=>$orderval)

                                                @if($orderKey != 'items')
                                                <input type="hidden" id="{{$orderKey}}" name="{{$orderKey}}" value="{{$orderval}}">
                                                @else
                                                <input type="hidden" id="items" name="items" value="{{$orderval}}">
                                                @endif

                                                @endforeach
                                                {{--@foreach($orderRequest['items'] as $itemKey=>$itemval)
                                                        <input type="hidden" id="items" name="items[]" value="{{$itemval}}">
                                                @endforeach--}}
                                                <button class="btn btn-primary" type="submit" id="order_form-submit">Submit Order</button>
                                                <button onclick="redirectionOnOrders()" class="btn btn-primary" type="button" id="order_form-submit">Edit Information</button>

                                            </form>
                                            <form name="editOrder" id="editOrder" method="post" enctype="multipart/form-data" action="{{url('/orders')}}">
                                                {{ csrf_field() }}
                                                <input type="hidden" class="form-control" name="editorderData" id="editorderData" value="">
                                                <input type="hidden" class="form-control" name="editOrderId" id="editOrderId" @if(isset($orderRequest['orderID']) && !empty($orderRequest['orderID'])) value="{{$orderRequest['orderID']}}" @else value="" @endif>
                                                <button type="submit" class="d-none btn btn-primary float-right nameButton" id="order_edit-store"> Submit</button>
                                            </form>
                                            @endif

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
    <!--  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> -->
    <script>
        function redirectionOnOrders() {
            if ($.cookie("rewardSbCart")) {
                let cartData = $.cookie("rewardSbCart");
                $('#editorderData').val(cartData);
                let orderData = $('#editorderData').val();
                if (orderData != '') {
                    $("#order_edit-store").click();
                }
            }



        }
    </script>
</body>

</html>