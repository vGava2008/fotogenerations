<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeDescription extends Model
{
    //
	protected $table = 'attribute_description';
    protected $primaryKey = 'attribute_id';
    protected $fillable = ['attribute_id', 'language_id', 'name', ];
}
