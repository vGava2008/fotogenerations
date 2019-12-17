<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDescription extends Model
{
    protected $table = 'product_description';
    //protected $primaryKey = 'product_id';
    protected $fillable = ['product_id', 'language_id', 'name', 'description', 'meta_description', 'meta_keyword', 'tag', ];
}
