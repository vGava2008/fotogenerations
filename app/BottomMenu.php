<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BottomMenu extends Model
{
    protected $table = 'bottom_menu';
    //protected $primaryKey = 'top_menu_id';
    protected $fillable = ['bottom_menu_id', 'name', 'url', 'column', 'status', 'sort_order', 'language_id'];
}
