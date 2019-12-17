<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeGroupDescription extends Model
{
    //
    protected $table = 'attribute_group_description';
    //protected $primaryKey = 'product_id';
    protected $fillable = ['attribute_group_id', 'language_id', 'name', ];
}