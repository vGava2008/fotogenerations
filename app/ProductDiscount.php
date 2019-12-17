<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
	protected $table = 'product_discount';
	public $timestamps = false;
    protected $primaryKey = 'product_discount_id';
    protected $fillable = ['product_discount_id', 'product_id', 'customer_group_id', 'quantity', 'priority', 'price', 'date_start', 'date_end'];
  
}
