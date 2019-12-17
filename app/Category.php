<?php
//Cat
//Cat2
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Category extends Model
{
    // Mass assigned
    protected $fillable = ['id', 'image', 'image_show', 'title', 'seo_link', 'parent_id', 'language_id', 'published',];
    // Mutators
  

    /*public function setSlugAttribute($value) {
      $this->attributes['slug'] = Str::slug( mb_substr($this->slug, 0, 40) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }*/
    // Get children category
    public function children() {
      return $this->hasMany(self::class, 'parent_id');
    }
}
