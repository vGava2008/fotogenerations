<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSpecial extends Model
{
    protected $table = 'product_special';
	public $timestamps = false;
    protected $primaryKey = 'product_special_id';
    protected $fillable = ['product_special_id', 'product_id', 'customer_group_id', 'priority', 'price', 'date_start', 'date_end'];
}
