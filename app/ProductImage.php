<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    //
    protected $table = 'product_image';
    protected $primaryKey = 'product_image_id';
    protected $fillable = ['product_image_id', 'product_id', 'image', 'sort_order',];
}
