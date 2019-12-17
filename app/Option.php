<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $table = 'option'; 
    protected $primaryKey = 'option_id';
    protected $fillable = ['option_id', 'type', 'sort_order',];

	

    public static function getOptions($data = array()) {

    	function escape_like($string)
    	{
	        $search = array('%', '_');
	        $replace   = array('\%', '\_');
	        return str_replace($search, $replace, $string);
   		}

		$sql = "SELECT * FROM `option` o LEFT JOIN option_description od ON (o.option_id = od.option_id) WHERE od.language_id = '1'";

		//Products::where('name', 'LIKE', '%' . escape_like($data['filter_name']) . '%')
		if (!empty($data['filter_name'])) {
			$sql .= " AND od.name LIKE '" . escape_like($data['filter_name']) . "%'";
		}

		$sort_data = array(
			'od.name',
			'o.type',
			'o.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY od.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		//$query = $this->db->query($sql);
		$query = DB::select($sql);
		//dd($query);
		return $query;
		//return $query->rows;
	}
	public static function getOptionValue($option_value_id) {
		$query =  DB::query("SELECT * FROM option_value ov LEFT JOIN option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE ov.option_value_id = '" . (int)$option_value_id . "' AND ovd.language_id = '1'");

		return $query;
	}
	public static function getOptionValues($option_id) {
		$option_value_data = array();

		$option_value_query = DB::select("SELECT * FROM option_value ov LEFT JOIN option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE ov.option_id = '" . (int)$option_id . "' AND ovd.language_id = '1' ORDER BY ov.sort_order, ovd.name");
		


		foreach ($option_value_query as $option_value) {
			//dd($option_value);
			$option_value_data[] = array(
				'option_value_id' => $option_value->option_value_id,
				'name'            => $option_value->name,
				'image'           => $option_value->image,
				'sort_order'      => $option_value->sort_order
			);
		}

		return $option_value_data;
	}
}

