<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopMenu extends Model
{
    protected $table = 'top_menu';
    //protected $primaryKey = 'top_menu_id';
    protected $fillable = ['top_menu_id', 'name', 'url', 'parent_id', 'status', 'sort_order', 'language_id'];

    public function children() {
      return $this->hasMany(self::class, 'parent_id')->where(['language_id' => 1]);
    }
}
