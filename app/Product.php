<?php

namespace App;
use DB;

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

    public static function getProductOptions($product_id) {
		$product_option_data = array();

		$product_option_query = DB::select("SELECT * FROM `product_option` po LEFT JOIN `option` o ON (po.option_id = o.option_id) LEFT JOIN `option_description` od ON (o.option_id = od.option_id) WHERE po.product_id = '" . (int)$product_id . "' AND od.language_id = '1'");

		foreach ($product_option_query as $product_option) {
			$product_option_value_data = array();

			$product_option_value_query = DB::select("SELECT * FROM `product_option_value` pov LEFT JOIN `option_value` ov ON(pov.option_value_id = ov.option_value_id) WHERE pov.product_option_id = '" . (int)$product_option->product_option_id . "' ORDER BY ov.sort_order ASC");

			foreach ($product_option_value_query as $product_option_value) {
				$product_option_value_data[] = array(
					'product_option_value_id' => $product_option_value->product_option_value_id,
					'option_value_id'         => $product_option_value->option_value_id,
					'quantity'                => $product_option_value->quantity,
					'subtract'                => $product_option_value->subtract,
					'price'                   => $product_option_value->price,
					'price_prefix'            => $product_option_value->price_prefix,
					'points'                  => $product_option_value->points,
					'points_prefix'           => $product_option_value->points_prefix,
					'weight'                  => $product_option_value->weight,
					'weight_prefix'           => $product_option_value->weight_prefix
				);
			}

			$product_option_data[] = array(
				'product_option_id'    => $product_option->product_option_id,
				'product_option_value' => $product_option_value_data,
				'option_id'            => $product_option->option_id,
				'name'                 => $product_option->name,
				'type'                 => $product_option->type,
				'value'                => $product_option->option_value,
				'required'             => $product_option->required
			);
		}

		return $product_option_data;
	}
}
