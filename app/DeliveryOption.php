<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeliveryOption extends Model
{
    protected $table = 'delivery_options';
    protected $fillable = ['heading','delivery_options_description', 'status'];
}
