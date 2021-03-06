<?php
//Cat
//Cat2
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Category extends Model
{
    // Mass assigned
    protected $fillable = ['id', 'image', 'image_show', 'title', 'sub_title', 'description', 'seo_link', 'parent_id', 'sort_order', 'language_id', 'published',];
    // Mutators
  

    /*public function setSlugAttribute($value) {
      $this->attributes['slug'] = Str::slug( mb_substr($this->slug, 0, 40) . "-" . \Carbon\Carbon::now()->format('dmyHi'), '-');
    }*/
    // Get children category
    public function children() {
      return $this->hasMany(self::class, 'parent_id')->where(['language_id' => 1]);
    }

    public function articles()
    {
        return $this->morphedByMany('App\Category', 'categoryable');
    }
}
