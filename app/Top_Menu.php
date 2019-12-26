<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Top_Menu extends Model
{
    protected $table = 'top_menu';
    //protected $primaryKey = 'top_menu_id';
    protected $fillable = ['top_menu_id', 'name', 'url', 'column', 'status', 'sort_order', 'language_id'];
}
