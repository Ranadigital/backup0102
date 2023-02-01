@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{$data['categoryCount']}}</h3>
                    <p>Category</p>
                </div>
                <div class="icon"> <i class="nav-icon fas fa-table"></i> </div> <a href="{{url('/admin/master/category') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{$data['brandCount']}}</h3>
                    <p>Brand</p>
                </div>
                <div class="icon"> <i class="nav-icon fas fa-tree"></i> </div> <a href="{{url('/admin/master/brand') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{$data['productCount']}}</h3>
                    <p>Product</p>
                </div>
                <div class="icon"> <i class="nav-icon fas fa-columns"></i> </div> <a href="{{url('/admin/product') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{$data['orderCount']}}</h3>
                    <p>Order</p>
                </div>
                <div class="icon"> <i class="nav-icon fas fa-chart-pie"></i> </div> <a href="{{url('/admin/order') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Order</h3>
                </div>
                <div class="card-body p-0">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Order.No.</th>
                                <th>Customer Name</th>
                                <th>Arrival/Departure</th>
                                <th>Flight</th>
                                <th>Collection Point</th>
                                <th>Pickup By</th>
                                <th>Nominee</th>
                                <th>Order Cost</th>
                                <!-- <th>Last Modified</th> -->

                            </tr>
                        </thead>
                        <tbody>
                            @if (count($orders) > 0)
                            @foreach($orders as $orderKey=>$order)
                            <tr>
                                <td>
                                    @if(isset($order->point_of_collection) && $order->point_of_collection === 'Arrivals Duty Free Shop')
                                      AOR-{{$order->id}}
                                    @else
                                      DOR-{{$order->id}}
                                    @endif
                                </td>
                                <td>
                                    Name: {{$order->client_name}}</br>
                                    Email: {{$order->client_email}}
                                </td>
                                <td>
                                    {{date('Y-m-d', strtotime($order['arrival_or_departure_date']))}} / {{$order->estimated_time_departure_or_arrival}}
                                </td>
                                <td>{{$order->flight_no}}</td>
                                <td>{{$order->point_of_collection}}</td>
                                <td>{{$order->pickup_person}}</td>
                                <td> @if(isset($order->nominee_name) && !empty($order->nominee_name))
                                    {{$order->nominee_name}}
                                    @else
                                    Self
                                    @endif
                                </td>
                                <td>{{number_format($order->order_cost)}}</td>
                                <!-- <td>{{date('Y-m-d, h:i a', strtotime($order['updated_at']))}}</td> -->


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
            </div>
        </div>
    </div>
</div>

@endsection
<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="{{ asset('/js/Chart.min.js') }}"></script>
 -->