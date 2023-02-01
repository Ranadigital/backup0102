<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogDetail extends Model
{
    protected $table = 'log_details';
    protected $fillable = [ 'status', 'old_data', 'new_data', 'action', 'module', 'user_id', 'user_email'];
}
