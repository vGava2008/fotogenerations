<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    //
 	protected $table = 'product_attribute';
    //protected $primaryKey = 'product_id';
    protected $fillable = ['product_id', 'attribute_id', 'language_id', 'text', ];
}
