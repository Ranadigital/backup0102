<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProductMapping extends Model
{
    protected $table = 'order_product_mappings';
    protected $fillable = ['order_id','product_id', 'product_cost', 'product_count', 'status'];
}
