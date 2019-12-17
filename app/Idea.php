<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    // Mass assigned
    protected $fillable = ['id', 'title', 'main_image', 'second_image', 'title_second_image', 'title_second_level', 'text_left','text_right','third_center_image','title_third_center_image','text_centr','seo_link', 'category_id', 'language_id', 'published', 'created_by', 'modified_by', 'updated_at', 'created_at',];
    // Mutators
  

    /*public function setSlugAttribute($value) {
      $this->attributes['slug'] = Str::slug( mb_substr($this->slug, 0, 40) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }*/
    // Get children category
    public function children() {
      return $this->hasMany(self::class, 'category_id');
    }
}
