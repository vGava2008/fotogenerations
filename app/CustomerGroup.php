<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $table = 'customer_group';
    protected $primaryKey = 'customer_group_id';
    protected $fillable = ['customer_group_id', 'name', 'description', 'sort_order' ];


 
}
