<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';
    protected $fillable = ['arrival_or_departure_date','estimated_time_departure_or_arrival', 'flight_no', 'is_transict_customer', 'point_of_collection', 'pickup_person', 'nominee_name', 'order_comments', 'order_cost', 'orderStatus', 'status', 'client_email', 'client_name', 'client_number', 'comment'];
}
