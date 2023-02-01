<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';
    protected $fillable = ['first_heading','second_heading', 'button_link', 'baneer_image_name', 'status'];
}
