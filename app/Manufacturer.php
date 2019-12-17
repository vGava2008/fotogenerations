<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
	// public $table = "manufacturer";
	protected $table = 'manufacturer';
	protected $primaryKey = 'id';
    protected $fillable = ['id', 'image', 'title', 'seo_link', 'published', 'language_id'];
}
