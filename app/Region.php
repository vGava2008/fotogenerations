<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Region extends Model
{
    public $timestamps = false;
    // Mass assigned
    protected $fillable = ['region_name', 'language_id',];
}
