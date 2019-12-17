<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionValueDescription extends Model
{
    protected $table = 'option_value_description'; 
    protected $primaryKey = 'option_value_id';
    protected $fillable = ['option_value_id', 'language_id', 'option_id', 'name',];
}
