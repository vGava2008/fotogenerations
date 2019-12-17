<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'attribute';
    protected $primaryKey = 'attribute_id';
    protected $fillable = ['attribute_id', 'attribute_group_id', 'sort_order', ];
}
