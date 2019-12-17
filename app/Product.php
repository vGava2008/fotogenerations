<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'product_id';
    protected $fillable = ['product_id', 'model', 'sku', 'quantity', 'price', 'category_id',];

    // Get children category
    public function children() {
      return $this->hasMany(self::class, 'category_id');
    }
}
