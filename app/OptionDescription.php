<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionDescription extends Model
{
    protected $table = 'option_description'; 
    protected $primaryKey = 'option_id';
    protected $fillable = ['option_id', 'language_id', 'name',];

}
