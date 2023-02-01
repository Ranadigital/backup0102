<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookedOrderProduct extends Model
{
    protected $table = 'booked_order_products';
    protected $fillable = ['product_id','order_id', 'count', 'status'];
}
