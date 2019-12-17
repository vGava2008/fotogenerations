<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    protected $table = 'option_value'; 
    protected $primaryKey = 'option_value_id';
    protected $fillable = ['option_value_id', 'option_id', 'image', 'sort_order',];
}
