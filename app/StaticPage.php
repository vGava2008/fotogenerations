<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaticPage extends Model
{
	protected $table = 'static_page';
    //protected $primaryKey = 'id';
    protected $fillable = ['static_page_id', 'title', 'text', 'language_id', 'locale'];
}
