<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['product_name', 'product_category_id','product_subcategory_id', 'product_brand_id', 'status', 'product_description', 'product_cost', 'product_color', 'product_size', 'parent_product_id', 'is_prime'];
}
