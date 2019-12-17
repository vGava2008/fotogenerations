<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option'; 
    protected $primaryKey = 'option_id';
    protected $fillable = ['option_id', 'type', 'sort_order',];


}

