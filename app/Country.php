<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Country extends Model
{
	public $timestamps = false;
    // Mass assigned
    protected $fillable = ['country_name', 'language_id',];
    
    
}
