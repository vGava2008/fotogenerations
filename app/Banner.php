<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    //
 	protected $table = 'banners';
    protected $primaryKey = 'banner_id';
    protected $fillable = ['name', 'image', 'sort_order'];
}
