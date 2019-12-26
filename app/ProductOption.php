<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    protected $table = 'product_option';
    protected $primaryKey = 'product_option_id';
    protected $fillable = ['product_option_id', 'product_id', 'option_id', 'option_value', 'required'];
}
