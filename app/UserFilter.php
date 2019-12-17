<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFilter extends Model
{
    protected $table = 'user_filter';
    protected $primaryKey = 'user_filter_id';
    protected $fillable = ['user_filter_id', 'name', 'description', ];
}
