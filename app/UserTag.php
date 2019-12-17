<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTag extends Model
{
    //
	protected $table = 'user_tag';
    protected $primaryKey = 'user_tag_id';
    protected $fillable = ['user_tag_id', 'name', 'description', ];
}
