<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Langs;
use App\Category;
use App\Manufacturer;
use App\Option;

use App\ProductDescription;
use App\ProductAttribute;
use App\AttributeDescription;
use App\AttributeGroupDescription;
use App\ProductImage;
use App\ProductDiscount;
use App\ProductSpecial;
use App\CustomerGroup;
use App\ProductOption;
use App\ProductOptionValue;



use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$product_descriptions = ProductDescription::where(['language_id'=>1])->get();
        //$attribute_descriptions = AttributeDescription::where(['language_id'=>1])->get();
        //dd($product_descriptions);
        return view('admin.products.index', [
            'products' => Product::paginate(10),
            'product_descriptions' => ProductDescription::where(['language_id'=>1])->get(),   
        ]);
    }
    
/******************************* ГЛУПОСТЬ АВТОРОВ LARAVEL ************************************/

    public function autocomplete(Request $request)
    {
       /* return view('admin.products.index', [
            'products' => Product::paginate(10)
        ]);*/
        echo '000';
    }
/****************/


    /*public function autocomplete()
    {
        $json = array();

        if (isset($this->request->get['filter_name'])) {
            //$this->load->language('catalog/option');

            //$this->load->model('catalog/option');

            //$this->load->model('tool/image');

            $filter_data = array(
                'filter_name' => $this->request->get['filter_name'],
                'start'       => 0,
                'limit'       => 5
            );

            $options = $this->model_catalog_option->getOptions($filter_data);

            foreach ($options as $option) {
                $option_value_data = array();

                if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox' || $option['type'] == 'image') {
                    $option_values = $this->model_catalog_option->getOptionValues($option['option_id']);

                    foreach ($option_values as $option_value) {
                        if (is_file(DIR_IMAGE . $option_value['image'])) {
                            $image = $this->model_tool_image->resize($option_value['image'], 50, 50);
                        } else {
                            $image = $this->model_tool_image->resize('no_image.png', 50, 50);
                        }

                        $option_value_data[] = array(
                            'option_value_id' => $option_value['option_value_id'],
                            'name'            => strip_tags(html_entity_decode($option_value['name'], ENT_QUOTES, 'UTF-8')),
                            'image'           => $image
                        );
                    }

                    $sort_order = array();

                    foreach ($option_value_data as $key => $value) {
                        $sort_order[$key] = $value['name'];
                    }

                    array_multisort($sort_order, SORT_ASC, $option_value_data);
                }

                $type = '';

                if ($option['type'] == 'select' || $option['type'] == 'radio' || $option['type'] == 'checkbox') {
                    $type = $this->language->get('text_choose');
                }

                if ($option['type'] == 'text' || $option['type'] == 'textarea') {
                    $type = $this->language->get('text_input');
                }

                if ($option['type'] == 'file') {
                    $type = $this->language->get('text_file');
                }

                if ($option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
                    $type = $this->language->get('text_date');
                }

                $json[] = array(
                    'option_id'    => $option['option_id'],
                    'name'         => strip_tags(html_entity_decode($option['name'], ENT_QUOTES, 'UTF-8')),
                    'category'     => $type,
                    'type'         => $option['type'],
                    'option_value' => $option_value_data
                );
            }
        }

        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    
    }  */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count=0;
        return view('admin.products.create', [
          'product'   => [],
          'product_description'   => [],
          'product_discount'   => [],
          'product_special'   => [],
          'count' => $count,
          'categories' => Category::with('children')->where(['parent_id'=>0, 'language_id'=>1])->get(),
          'customer_groups' => CustomerGroup::get(),
          'attribute_descriptions' => AttributeDescription::where(['language_id'=>1])->get(),
          'manufacturers' => Manufacturer::where(['language_id'=>1])->get(),
          'languages' => Langs::get(),
          'delimiter'  => '',
          'product_options' => [],
          'option_values' =>  [],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd ( $request);
        //Узнаём поледнее ID записи в таблице "Категорий"
        $latest_ID = Product::max('product_id');
        //Повышаем его на единицу
        $latest_ID++;
        //Узнаём колличество языков
        $langs_count = Langs::count();

        /********** Опции **********/
        //  dd($request);

        $option_row_count = $request->get('option_row_count');
        $option_value_row_count = $request->get('option_value_row_count');
        for($i=1; $i<$option_row_count; $i++)
        {
            $product_option = $request->get('product_option'.$i);
            //dd($product_option);
            $option_active = $product_option['active'];
            $product_option_id = $product_option['product_option_id'];
            $option_id = $product_option['option_id'];
            //1 Только что созданный - create
            if($option_active == 1)
            {
                $option_name = $product_option['name'];
                $option_type = $product_option['type'];
                $option_required = $product_option['required'];

                if($option_type == 'text' || $option_type == 'textarea')
                {
                    $option_value = $product_option['value'];
                    ProductOption::create([
                    'product_id' => $latest_ID,
                    'option_id' => $option_id,
                    'option_value' => $option_value,
                    'required' => $option_required,
                    ]);
                }
                if($option_type == 'select' || $option_type == 'radio' || $option_type == 'checkbox')
                {
                    $product_option_value = $product_option['product_option_value'];
                    ProductOption::create([
                    'product_id' => $latest_ID,
                    'option_id' => $option_id,
                    'required' => $option_required,
                    ]);

                    for($j=1; $j<$option_value_row_count; $j++)
                    {
                        if(isset($product_option_value[''.$j.'']))
                        {
                            $option_value_active = $product_option_value[''.$j.'']['active'];
                            if($option_value_active == 1)
                            {
                                $product_option_id_get = ProductOption::where(['product_id' => $latest_ID, 'option_id' => $option_id])->get();
                                $get_product_option_id;
                                foreach ($product_option_id_get as $product_option_id_one) {
                                    $get_product_option_id = $product_option_id_one->product_option_id;
                                }

                                //dd($product_option_id);
                                $option_value_id = $product_option_value[''.$j.'']['option_value_id'];
                                $option_value_quantity = $product_option_value[''.$j.'']['quantity'];
                                $option_value_subtract = $product_option_value[''.$j.'']['subtract'];
                                $option_value_price_prefix = $product_option_value[''.$j.'']['price_prefix'];
                                $option_value_price = $product_option_value[''.$j.'']['price'];
                                $option_value_points_prefix = $product_option_value[''.$j.'']['points_prefix'];
                                $option_value_points = $product_option_value[''.$j.'']['points'];
                                $option_value_weight_prefix = $product_option_value[''.$j.'']['weight_prefix'];
                                $option_value_weight = $product_option_value[''.$j.'']['weight'];
                                ProductOptionValue::create([
                                'product_option_id'=>$get_product_option_id,
                                'product_id' => $latest_ID,
                                'option_id' => $option_id,
                                'option_value_id' => $option_value_id,
                                'quantity' => $option_value_quantity,
                                'subtract' => $option_value_subtract,
                                'price' => $option_value_price,
                                'price_prefix' => $option_value_price_prefix,
                                'points' => $option_value_points,
                                'points_prefix' => $option_value_points_prefix,
                                'weight' => $option_value_weight,
                                'weight_prefix' => $option_value_weight_prefix,
                                ]);

                            }
                            if($option_value_active == 2)
                            {
                                $option_value_id = $product_option_value[''.$j.'']['option_value_id'];
                                $product_option_value_id = $product_option_value[''.$j.'']['product_option_value_id'];
                                $option_value_quantity = $product_option_value[''.$j.'']['quantity'];
                                $option_value_subtract = $product_option_value[''.$j.'']['subtract'];
                                $option_value_price_prefix = $product_option_value[''.$j.'']['price_prefix'];
                                $option_value_price = $product_option_value[''.$j.'']['price'];
                                $option_value_points_prefix = $product_option_value[''.$j.'']['points_prefix'];
                                $option_value_points = $product_option_value[''.$j.'']['points'];
                                $option_value_weight_prefix = $product_option_value[''.$j.'']['weight_prefix'];
                                $option_value_weight = $product_option_value[''.$j.'']['weight'];
                                ProductOptionValue::where(['product_option_value_id'=>$product_option_value_id, 'product_option_id'=>$product_option_id, 'product_id'=>$latest_ID, 'option_id'=>$option_id, 'option_value_id'=>$option_value_id])->update([
                                    'quantity' => $option_value_quantity,
                                    'subtract' => $option_value_subtract,
                                    'price' => $option_value_price,
                                    'price_prefix' => $option_value_price_prefix,
                                    'points' => $option_value_points,
                                    'points_prefix' => $option_value_points_prefix,
                                    'weight' => $option_value_weight,
                                    'weight_prefix' => $option_value_weight_prefix,
                                ]);
                            }
                            if($option_value_active == 3)
                            {
                                $product_option_value_id = $product_option_value[''.$j.'']['product_option_value_id'];

                                if (isset($product_option_value_id)) 
                                {
                                    ProductOptionValue::where(['product_option_value_id'=>$product_option_value_id, 'product_id'=>$latest_ID, 'product_option_id'=>$product_option_id, 'option_id'=>$option_id])->delete();
                                }
                                else{
                                //print_r('del'); 
                                }
                            }
                        }
                        else
                        {

                        }
                    }
                }
            }
            //2 Отредактирована - update
            if($option_active == 2)
            {
                $option_name = $product_option['name'];
                $option_type = $product_option['type'];
                $option_required = $product_option['required'];
                if($option_type == 'text' || $option_type == 'textarea')
                {
                    $option_value = $product_option['value'];
                    ProductOption::where(['product_id'=>$latest_ID, 'product_option_id'=>$product_option_id, 'option_id'=>$option_id])->update([
                    'option_value' => $option_value,
                    'required' => $option_required,
                ]);
                }
                if($option_type == 'select' || $option_type == 'radio' || $option_type == 'checkbox')
                {
                    $product_option_value = $product_option['product_option_value'];
                    ProductOption::where(['product_id'=>$latest_ID, 'product_option_id'=>$product_option_id, 'option_id'=>$option_id])->update([
                    'required' => $option_required,
                    ]);
                    //dd($product_option_value);
                    for($j=1; $j<$option_value_row_count; $j++)
                    {
                        //$product_option_value[''.$i.''];
                        //dd($product_option_value);
                        //dd($product_option_value['2']);


                        //print_r($j);
                         //print_r($product_option);
                        if(isset($product_option_value[''.$j.'']))
                        {
                            $option_value_active = $product_option_value[''.$j.'']['active'];
                            if($option_value_active == 1)
                            {

                            
                                $option_value_id = $product_option_value[''.$j.'']['option_value_id'];
                                $option_value_quantity = $product_option_value[''.$j.'']['quantity'];
                                $option_value_subtract = $product_option_value[''.$j.'']['subtract'];
                                $option_value_price_prefix = $product_option_value[''.$j.'']['price_prefix'];
                                $option_value_price = $product_option_value[''.$j.'']['price'];
                                $option_value_points_prefix = $product_option_value[''.$j.'']['points_prefix'];
                                $option_value_points = $product_option_value[''.$j.'']['points'];
                                $option_value_weight_prefix = $product_option_value[''.$j.'']['weight_prefix'];
                                $option_value_weight = $product_option_value[''.$j.'']['weight'];
                                ProductOptionValue::create([
                                'product_option_id'=>$product_option_id,
                                'product_id' => $latest_ID,
                                'option_id' => $option_id,
                                'option_value_id' => $option_value_id,
                                'quantity' => $option_value_quantity,
                                'subtract' => $option_value_subtract,
                                'price' => $option_value_price,
                                'price_prefix' => $option_value_price_prefix,
                                'points' => $option_value_points,
                                'points_prefix' => $option_value_points_prefix,
                                'weight' => $option_value_weight,
                                'weight_prefix' => $option_value_weight_prefix,
                                ]);

                            }
                            if($option_value_active == 2)
                            {
                                $option_value_id = $product_option_value[''.$j.'']['option_value_id'];
                                $product_option_value_id = $product_option_value[''.$j.'']['product_option_value_id'];
                                $option_value_quantity = $product_option_value[''.$j.'']['quantity'];
                                $option_value_subtract = $product_option_value[''.$j.'']['subtract'];
                                $option_value_price_prefix = $product_option_value[''.$j.'']['price_prefix'];
                                $option_value_price = $product_option_value[''.$j.'']['price'];
                                $option_value_points_prefix = $product_option_value[''.$j.'']['points_prefix'];
                                $option_value_points = $product_option_value[''.$j.'']['points'];
                                $option_value_weight_prefix = $product_option_value[''.$j.'']['weight_prefix'];
                                $option_value_weight = $product_option_value[''.$j.'']['weight'];
                                ProductOptionValue::where(['product_option_value_id'=>$product_option_value_id, 'product_option_id'=>$product_option_id, 'product_id'=>$latest_ID, 'option_id'=>$option_id, 'option_value_id'=>$option_value_id])->update([
                                    'quantity' => $option_value_quantity,
                                    'subtract' => $option_value_subtract,
                                    'price' => $option_value_price,
                                    'price_prefix' => $option_value_price_prefix,
                                    'points' => $option_value_points,
                                    'points_prefix' => $option_value_points_prefix,
                                    'weight' => $option_value_weight,
                                    'weight_prefix' => $option_value_weight_prefix,
                                ]);
                            }
                            if($option_value_active == 3)
                            {
                                $product_option_value_id = $product_option_value[''.$j.'']['product_option_value_id'];

                                if (isset($product_option_value_id)) 
                                {
                                    ProductOptionValue::where(['product_option_value_id'=>$product_option_value_id, 'product_id'=>$latest_ID, 'product_option_id'=>$product_option_id, 'option_id'=>$option_id])->delete();
                                }
                                else{
                                //print_r('del'); 
                                }
                            }
                        }
                        else
                        {

                        }
                    }
                }
            }
            //3 Удалена - delete
            if($option_active == 3)
            {
                //Если есть id скидки
                if (isset($product_option['product_option_id'])) 
                {
                    ProductOption::where(['product_id'=>$latest_ID, 'product_option_id'=>$product_option_id, 'option_id'=>$option_id])->delete();
                }
                else{
                    //print_r('del'); 
                }
            }
            //dd($product_option_value);
        }
        /********** END: Опции **********/

        /********** Скидки **********/
        $discount_row_count = $request->get('discount_row_count');
        for($i=1; $i<$discount_row_count; $i++)
        {
            $product_discount = $request->get('product_discount'.$i);

            $discount_active = $product_discount['active'];
            if (isset($product_discount['product_discount_id'])) 
            {
                $discount_product_discount_id = $product_discount['product_discount_id'];
            }
            if (isset($product_discount['customer_group_id']))
            {
                $discount_customer_group_id = $product_discount['customer_group_id'];
                $discount_quantity = $product_discount['quantity'];
                $discount_priority = $product_discount['priority'];
                $discount_price = $product_discount['price'];
                $discount_date_start = $product_discount['date_start'];
                $discount_date_end = $product_discount['date_end'];

            }
            
            $rules = [
                //Основное
                'product_discount'.$i.'[customer_group_id]' => 'integer',
                'product_discount'.$i.'[quantity]' => 'integer',
                'product_discount'.$i.'[priority]' => 'integer',
                'product_discount'.$i.'[price]' => 'integer',
                /*'product_discount'.$i.'[date_start]' => 'integer',
                'product_discount'.$i.'[date_end]' => 'integer',*/
            ];
            $customMessages = [
                'integer' => 'Поле :attribute должно быть целочисленным.',
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);

            //1 Только что созданный - create
            if($discount_active == 1)
            {
               // dd($request);
                ProductDiscount::create([
                    'product_id' => $latest_ID,
                    'customer_group_id' => $discount_customer_group_id,
                    'quantity' => $discount_quantity,
                    'priority' => $discount_priority,
                    'price' => $discount_price,
                    'date_start' => $discount_date_start,
                    'date_end' => $discount_date_end,
                ]);
            }
            //2 Отредактирована - update
            if($discount_active == 2)
            {
                //print_r(2);

                ProductDiscount::where(['product_id'=>$latest_ID, 'product_discount_id'=>$discount_product_discount_id])->update([
                    'customer_group_id' => $discount_customer_group_id,
                    'quantity' => $discount_quantity,
                    'priority' => $discount_priority,
                    'price' => $discount_price,
                    'date_start' => $discount_date_start,
                    'date_end' => $discount_date_end,
                ]);
            }
            //3 Удалена - delete
            if($discount_active == 3)
            {
                //Если есть id скидки
                if (isset($product_discount['product_discount_id'])) 
                {
                    ProductDiscount::where(['product_id'=>$latest_ID, 'product_discount_id'=>$discount_product_discount_id])->delete();
                }
                //Если нет, значит скидка отсутсвует в БД
                else
                {
                    //print_r('del');
                }
                //
            }
        }
        /********** END: Скидки **********/

        /********** Акции **********/
        $special_row_count = $request->get('special_row_count');
        for($i=1; $i<$special_row_count; $i++)
        {
            $product_special = $request->get('product_special'.$i);

            $special_active = $product_special['active'];
            if (isset($product_special['product_special_id'])) 
            {
                $special_product_special_id = $product_special['product_special_id'];
            }
            if (isset($product_special['customer_group_id']))
            {
                $special_customer_group_id = $product_special['customer_group_id'];
                $special_priority = $product_special['priority'];
                $special_price = $product_special['price'];
                $special_date_start = $product_special['date_start'];
                $special_date_end = $product_special['date_end'];

            }
            
            $rules = [
                //Основное
                'product_special'.$i.'[customer_group_id]' => 'integer',
                'product_special'.$i.'[priority]' => 'integer',
                'product_special'.$i.'[price]' => 'integer',
                /*'product_discount'.$i.'[date_start]' => 'integer',
                'product_discount'.$i.'[date_end]' => 'integer',*/
            ];
            $customMessages = [
                'integer' => 'Поле :attribute должно быть целочисленным.',
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);

            //1 Только что созданный - create
            if($special_active == 1)
            {
               // dd($request);
                ProductSpecial::create([
                    'product_id' => $latest_ID,
                    'customer_group_id' => $special_customer_group_id,
                    'priority' => $special_priority,
                    'price' => $special_price,
                    'date_start' => $special_date_start,
                    'date_end' => $special_date_end,
                ]);
            }
            //2 Отредактирована - update
            if($special_active == 2)
            {
                //print_r(2);

                ProductSpecial::where(['product_id'=>$latest_ID, 'product_special_id'=>$special_product_special_id])->update([
                    'customer_group_id' => $discount_customer_group_id,
                    'priority' => $special_priority,
                    'price' => $special_price,
                    'date_start' => $special_date_start,
                    'date_end' => $special_date_end,
                ]);
            }
            //3 Удалена - delete
            if($special_active == 3)
            {
                //Если есть id скидки
                if (isset($product_special['product_special_id'])) 
                {
                    ProductSpecial::where(['product_id'=>$latest_ID, 'product_special_id'=>$special_product_special_id])->delete();
                }
                //Если нет, значит скидка отсутсвует в БД
                else
                {
                    //print_r('del');
                }
                //
            }
        }
        /********** END: Акции **********/

        /********** Атрибуты **********/
        //dd ( $request);
        $attribute_row_count = $request->get('attribute_row_count');
        for($i=1; $i<$attribute_row_count; $i++)
        {
            //Принимаем атрибут
            $product_attributes = $request->get('product_attribute'.$i);
            //dd ( $product_attributes);
            //Узнаем id атрибута
            $attribute_id =    $request->get('attribute_id'.$i);
            $attribute_active = $request->get('attribute_active'.$i);
            //print_r( $attribute_active);
            for($j=1; $j<=$langs_count; $j++)
            {

                //Текст атрибута
                $product_attribute_text = $product_attributes['product_attribute_text'.$j];
                $language = $request->get('language'.$j);

                //Проверка на заполненные поля
                //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
                $rules = [
                    //Основное
                    'product_attribute_text'.$j => 'required|string',
                ];
                $customMessages = [
                    'required' => 'Поле :attribute должно быть заполнено.',
                    'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
                ];
                
                
                //1 Только что созданный - create
                if($attribute_active == 1)
                {
                   // dd ( $request);
                   // print_r('1');
                    ProductAttribute::create([
                        'product_id' => $latest_ID,
                        'attribute_id' => $attribute_id,
                        'language_id' => $language,
                        'text' => $product_attribute_text,
                    ]);
                }
                //2 Отредактирована - update
                if($attribute_active == 2)
                {

                    ProductAttribute::where(['product_id'=>$latest_ID, 'attribute_id'=>$attribute_id, 'language_id'=>$language])->update([
                        'text' => $product_attribute_text,
                    ]);
                }
                //3 Удалена - delete
                if($attribute_active == 3)
                {
                   
                    ProductAttribute::where(['product_id'=>$latest_ID, 'attribute_id'=>$attribute_id])->delete();
                }
            }
        }
        /********** END: Атрибуты **********/

        $image_row_count = $request->get('image_row_count');
        for($i=1; $i<$image_row_count; $i++)
        {
            $rules = [
                //Основное
                'product_image'.$i.'[sort_order]' => 'integer',
            ];
            $customMessages = [
                'integer' => 'Поле :attribute должно быть целочисленным.',
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            //name="product_image'+ image_row + '[image]"
            
            $image_id = $request->get('product_image_id'.$i);
            $image_active = $request->get('image_active'.$i);

            if($image_active == 1)
            {

                if($request->file('product_image'.$i) != null)
                {
                    $file_array = $request->file('product_image'.$i);
                    $image_upload = $file_array['image']->store('uploads', 'public');
                }
                else
                {
                   //Ничего не делаем
                }
            
                //Порядок сортировки
                $sort_array = $request->get('product_image'.$i);
                $sort_image = $sort_array['sort_order'];
                $this->validate($request, $rules, $customMessages);
                //Записываем в БД
                if(isset($image_upload))
                {
                    ProductImage::create([
                        'product_id' => $latest_ID,
                        'image' => $image_upload,
                        'sort_order' => $sort_image,
                    ]);
                }
                else
                {
                   // print_r('else');
                   // print_r($sort_image);

                    ProductImage::where( ['product_id'=>$latest_ID, 'product_image_id'=>$image_id])->update([
                        'sort_order' => $sort_image,
                    ]);
                }
            }
            if($image_active == 0)
            {
                ProductImage::where(['product_id'=>$latest_ID, 'product_image_id'=>$image_id])->delete();
            }
        }
        /********** END: Изображения **********/



        //dd ( $request);
        //Данные
            $model = $request->get('model');
            $sku = $request->get('sku');
            $quantity = $request->get('quantity');
            $price = $request->get('price');
            $category = $request->get('category_id');
            $manufacturer = $request->get('manufacturer_id');


         $rules = [
                //Данные
                'model' => 'required|string|max:255',
                'sku' => 'required|string|max:255',
                'quantity' => 'required|integer',
                'price' => 'required|integer',
                'category_id' => 'required|integer',
                'manufacturer_id' => 'required|integer',
            ];
        $customMessages = [
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
        $this->validate($request, $rules, $customMessages);
            //Записываем в БД
            Product::create([
                'model' => $model,
                'sku' => $sku,
                'quantity' => $quantity,
                'price' => $price,
                'category_id' => $category,
                'manufacturer_id' => $manufacturer,
            ]);



        //Запускаем цикл не превышающий кол-ва языков
        for($i=1; $i<=$langs_count; $i++)
        {

            //Основное
            $name = $request->get('name'.$i);
            $language = $request->get('language'.$i);
            $description = $request->get('description'.$i);
            $meta_description = $request->get('meta_description'.$i);
            $meta_keyword = $request->get('meta_keyword'.$i);
            $tag = $request->get('tag'.$i);
            
            
            
            //Проверка на заполненные поля
            //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
            $rules = [
                //Основное
                'name'.$i => 'required|string|max:255',
                'description'.$i => 'required|string',
                'meta_description'.$i => 'required|string|max:255',
                'meta_keyword'.$i => 'required|string|max:255',
                'tag'.$i => 'required|string|max:255',
            ];
            $customMessages = [
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            
           
            ProductDescription::create([
                'product_id' => $latest_ID,
                'name' => $name,
                'language_id' => $language,
                'description' => $description,
                'meta_description' => $meta_description,
                'meta_keyword' => $meta_keyword,
                'tag' => $tag,
            ]);
        }
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $count=0;
        //Берем категории только с переданным нам ID
        $choose_product = Product::where('product_id', $product['product_id'])->get();
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //$choose_product_attributes
        $choose_product_description = ProductDescription::where('product_id', $product['product_id'])->get();

        //$choose_product_description = ProductDescription::where(['product_id' => $product['product_id']])->get();
        $data['product_options'] = Product::getProductOptions($product['product_id']);
        //dd($ee);


        $data['option_values'] = array();
        foreach ($data['product_options'] as $product_option) {
            if ($product_option['type'] == 'select' || $product_option['type'] == 'radio' || $product_option['type'] == 'checkbox') {
                if (!isset($data['option_values'][$product_option['option_id']])) {
                    $data['option_values'][$product_option['option_id']] = Option::getOptionValues($product_option['option_id']);
                }
            }
        }

        return view('admin.products.edit', [
          'product'   => $product,
          'choose_product'   => $choose_product,
          'choose_discounts' => ProductDiscount::where(['product_id'=>$product['product_id']])->get(),
          'choose_specials' => ProductSpecial::where(['product_id'=>$product['product_id']])->get(),
          'customer_groups' => CustomerGroup::get(),
 
          //'product_description' => $product_description,
          'choose_product_description'   => $choose_product_description,
          'count' => $count,
          'attribute_descriptions' => AttributeDescription::where(['language_id'=>1])->get(),
          'categories' => Category::with('children')->where(['parent_id'=>0, 'language_id'=>1])->get(),
          'customer_groups' => CustomerGroup::get(),
          'manufacturers' => Manufacturer::where(['language_id'=>1])->get(),
          'product_attributes' => ProductAttribute::where(['product_id'=>$product['product_id']])->get(),
          'choose_product_attributes' => ProductAttribute::where(['product_id'=>$product['product_id'], 'language_id'=>1])->get(),
          'product_images' => ProductImage::where(['product_id'=>$product['product_id']])->get(),
          //'products' => Product::with('children')->where(['parent_id'=>0, 'language_id'=>1])->get(),
          'product_options' => Product::getProductOptions($product['product_id']),
          'option_values' =>  $data['option_values'],

          
          'languages' => Langs::get(),
          'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        /********** Опции **********/
        //  dd($request);

        $option_row_count = $request->get('option_row_count');
        $option_value_row_count = $request->get('option_value_row_count');
        for($i=1; $i<$option_row_count; $i++)
        {
            $product_option = $request->get('product_option'.$i);
            //dd($product_option);
            $option_active = $product_option['active'];
            $product_option_id = $product_option['product_option_id'];
            $option_id = $product_option['option_id'];
            //1 Только что созданный - create
            if($option_active == 1)
            {
                $option_name = $product_option['name'];
                $option_type = $product_option['type'];
                $option_required = $product_option['required'];

                if($option_type == 'text' || $option_type == 'textarea')
                {
                    $option_value = $product_option['value'];
                    ProductOption::create([
                    'product_id' => $request['product_id'],
                    'option_id' => $option_id,
                    'option_value' => $option_value,
                    'required' => $option_required,
                    ]);
                }
                if($option_type == 'select' || $option_type == 'radio' || $option_type == 'checkbox')
                {
                    $product_option_value = $product_option['product_option_value'];
                    ProductOption::create([
                    'product_id' => $request['product_id'],
                    'option_id' => $option_id,
                    'required' => $option_required,
                    ]);

                    for($j=1; $j<$option_value_row_count; $j++)
                    {
                        if(isset($product_option_value[''.$j.'']))
                        {
                            $option_value_active = $product_option_value[''.$j.'']['active'];
                            if($option_value_active == 1)
                            {
                                $product_option_id_get = ProductOption::where(['product_id' => $request['product_id'], 'option_id' => $option_id])->get();
                                $get_product_option_id;
                                foreach ($product_option_id_get as $product_option_id_one) {
                                    $get_product_option_id = $product_option_id_one->product_option_id;
                                }

                                //dd($product_option_id);
                                $option_value_id = $product_option_value[''.$j.'']['option_value_id'];
                                $option_value_quantity = $product_option_value[''.$j.'']['quantity'];
                                $option_value_subtract = $product_option_value[''.$j.'']['subtract'];
                                $option_value_price_prefix = $product_option_value[''.$j.'']['price_prefix'];
                                $option_value_price = $product_option_value[''.$j.'']['price'];
                                $option_value_points_prefix = $product_option_value[''.$j.'']['points_prefix'];
                                $option_value_points = $product_option_value[''.$j.'']['points'];
                                $option_value_weight_prefix = $product_option_value[''.$j.'']['weight_prefix'];
                                $option_value_weight = $product_option_value[''.$j.'']['weight'];
                                ProductOptionValue::create([
                                'product_option_id'=>$get_product_option_id,
                                'product_id' => $request['product_id'],
                                'option_id' => $option_id,
                                'option_value_id' => $option_value_id,
                                'quantity' => $option_value_quantity,
                                'subtract' => $option_value_subtract,
                                'price' => $option_value_price,
                                'price_prefix' => $option_value_price_prefix,
                                'points' => $option_value_points,
                                'points_prefix' => $option_value_points_prefix,
                                'weight' => $option_value_weight,
                                'weight_prefix' => $option_value_weight_prefix,
                                ]);

                            }
                            if($option_value_active == 2)
                            {
                                $option_value_id = $product_option_value[''.$j.'']['option_value_id'];
                                $product_option_value_id = $product_option_value[''.$j.'']['product_option_value_id'];
                                $option_value_quantity = $product_option_value[''.$j.'']['quantity'];
                                $option_value_subtract = $product_option_value[''.$j.'']['subtract'];
                                $option_value_price_prefix = $product_option_value[''.$j.'']['price_prefix'];
                                $option_value_price = $product_option_value[''.$j.'']['price'];
                                $option_value_points_prefix = $product_option_value[''.$j.'']['points_prefix'];
                                $option_value_points = $product_option_value[''.$j.'']['points'];
                                $option_value_weight_prefix = $product_option_value[''.$j.'']['weight_prefix'];
                                $option_value_weight = $product_option_value[''.$j.'']['weight'];
                                ProductOptionValue::where(['product_option_value_id'=>$product_option_value_id, 'product_option_id'=>$product_option_id, 'product_id'=>$request['product_id'], 'option_id'=>$option_id, 'option_value_id'=>$option_value_id])->update([
                                    'quantity' => $option_value_quantity,
                                    'subtract' => $option_value_subtract,
                                    'price' => $option_value_price,
                                    'price_prefix' => $option_value_price_prefix,
                                    'points' => $option_value_points,
                                    'points_prefix' => $option_value_points_prefix,
                                    'weight' => $option_value_weight,
                                    'weight_prefix' => $option_value_weight_prefix,
                                ]);
                            }
                            if($option_value_active == 3)
                            {
                                $product_option_value_id = $product_option_value[''.$j.'']['product_option_value_id'];

                                if (isset($product_option_value_id)) 
                                {
                                    ProductOptionValue::where(['product_option_value_id'=>$product_option_value_id, 'product_id'=>$request['product_id'], 'product_option_id'=>$product_option_id, 'option_id'=>$option_id])->delete();
                                }
                                else{
                                //print_r('del'); 
                                }
                            }
                        }
                        else
                        {

                        }
                    }
                }
            }
            //2 Отредактирована - update
            if($option_active == 2)
            {
                $option_name = $product_option['name'];
                $option_type = $product_option['type'];
                $option_required = $product_option['required'];
                if($option_type == 'text' || $option_type == 'textarea')
                {
                    $option_value = $product_option['value'];
                    ProductOption::where(['product_id'=>$request['product_id'], 'product_option_id'=>$product_option_id, 'option_id'=>$option_id])->update([
                    'option_value' => $option_value,
                    'required' => $option_required,
                ]);
                }
                if($option_type == 'select' || $option_type == 'radio' || $option_type == 'checkbox')
                {
                    $product_option_value = $product_option['product_option_value'];
                    ProductOption::where(['product_id'=>$request['product_id'], 'product_option_id'=>$product_option_id, 'option_id'=>$option_id])->update([
                    'required' => $option_required,
                    ]);
                    //dd($product_option_value);
                    for($j=1; $j<$option_value_row_count; $j++)
                    {
                        //$product_option_value[''.$i.''];
                        //dd($product_option_value);
                        //dd($product_option_value['2']);


                        //print_r($j);
                         //print_r($product_option);
                        if(isset($product_option_value[''.$j.'']))
                        {
                            $option_value_active = $product_option_value[''.$j.'']['active'];
                            if($option_value_active == 1)
                            {

                            
                                $option_value_id = $product_option_value[''.$j.'']['option_value_id'];
                                $option_value_quantity = $product_option_value[''.$j.'']['quantity'];
                                $option_value_subtract = $product_option_value[''.$j.'']['subtract'];
                                $option_value_price_prefix = $product_option_value[''.$j.'']['price_prefix'];
                                $option_value_price = $product_option_value[''.$j.'']['price'];
                                $option_value_points_prefix = $product_option_value[''.$j.'']['points_prefix'];
                                $option_value_points = $product_option_value[''.$j.'']['points'];
                                $option_value_weight_prefix = $product_option_value[''.$j.'']['weight_prefix'];
                                $option_value_weight = $product_option_value[''.$j.'']['weight'];
                                ProductOptionValue::create([
                                'product_option_id'=>$product_option_id,
                                'product_id' => $request['product_id'],
                                'option_id' => $option_id,
                                'option_value_id' => $option_value_id,
                                'quantity' => $option_value_quantity,
                                'subtract' => $option_value_subtract,
                                'price' => $option_value_price,
                                'price_prefix' => $option_value_price_prefix,
                                'points' => $option_value_points,
                                'points_prefix' => $option_value_points_prefix,
                                'weight' => $option_value_weight,
                                'weight_prefix' => $option_value_weight_prefix,
                                ]);

                            }
                            if($option_value_active == 2)
                            {
                                $option_value_id = $product_option_value[''.$j.'']['option_value_id'];
                                $product_option_value_id = $product_option_value[''.$j.'']['product_option_value_id'];
                                $option_value_quantity = $product_option_value[''.$j.'']['quantity'];
                                $option_value_subtract = $product_option_value[''.$j.'']['subtract'];
                                $option_value_price_prefix = $product_option_value[''.$j.'']['price_prefix'];
                                $option_value_price = $product_option_value[''.$j.'']['price'];
                                $option_value_points_prefix = $product_option_value[''.$j.'']['points_prefix'];
                                $option_value_points = $product_option_value[''.$j.'']['points'];
                                $option_value_weight_prefix = $product_option_value[''.$j.'']['weight_prefix'];
                                $option_value_weight = $product_option_value[''.$j.'']['weight'];
                                ProductOptionValue::where(['product_option_value_id'=>$product_option_value_id, 'product_option_id'=>$product_option_id, 'product_id'=>$request['product_id'], 'option_id'=>$option_id, 'option_value_id'=>$option_value_id])->update([
                                    'quantity' => $option_value_quantity,
                                    'subtract' => $option_value_subtract,
                                    'price' => $option_value_price,
                                    'price_prefix' => $option_value_price_prefix,
                                    'points' => $option_value_points,
                                    'points_prefix' => $option_value_points_prefix,
                                    'weight' => $option_value_weight,
                                    'weight_prefix' => $option_value_weight_prefix,
                                ]);
                            }
                            if($option_value_active == 3)
                            {
                                $product_option_value_id = $product_option_value[''.$j.'']['product_option_value_id'];

                                if (isset($product_option_value_id)) 
                                {
                                    ProductOptionValue::where(['product_option_value_id'=>$product_option_value_id, 'product_id'=>$request['product_id'], 'product_option_id'=>$product_option_id, 'option_id'=>$option_id])->delete();
                                }
                                else{
                                //print_r('del'); 
                                }
                            }
                        }
                        else
                        {

                        }
                    }
                }
            }
            //3 Удалена - delete
            if($option_active == 3)
            {
                //Если есть id скидки
                if (isset($product_option['product_option_id'])) 
                {
                    ProductOption::where(['product_id'=>$request['product_id'], 'product_option_id'=>$product_option_id, 'option_id'=>$option_id])->delete();
                }
                else{
                    //print_r('del'); 
                }
            }
            //dd($product_option_value);
        }
        /********** END: Опции **********/
        /********** Скидки **********/
        $discount_row_count = $request->get('discount_row_count');
        for($i=1; $i<$discount_row_count; $i++)
        {
            $product_discount = $request->get('product_discount'.$i);

            $discount_active = $product_discount['active'];
            if (isset($product_discount['product_discount_id'])) 
            {
                $discount_product_discount_id = $product_discount['product_discount_id'];
            }
            if (isset($product_discount['customer_group_id']))
            {
                $discount_customer_group_id = $product_discount['customer_group_id'];
                $discount_quantity = $product_discount['quantity'];
                $discount_priority = $product_discount['priority'];
                $discount_price = $product_discount['price'];
                $discount_date_start = $product_discount['date_start'];
                $discount_date_end = $product_discount['date_end'];

            }
            
            $rules = [
                //Основное
                'product_discount'.$i.'[customer_group_id]' => 'integer',
                'product_discount'.$i.'[quantity]' => 'integer',
                'product_discount'.$i.'[priority]' => 'integer',
                'product_discount'.$i.'[price]' => 'integer',
                /*'product_discount'.$i.'[date_start]' => 'integer',
                'product_discount'.$i.'[date_end]' => 'integer',*/
            ];
            $customMessages = [
                'integer' => 'Поле :attribute должно быть целочисленным.',
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);

            //1 Только что созданный - create
            if($discount_active == 1)
            {
               // dd($request);
                ProductDiscount::create([
                    'product_id' => $request['product_id'],
                    'customer_group_id' => $discount_customer_group_id,
                    'quantity' => $discount_quantity,
                    'priority' => $discount_priority,
                    'price' => $discount_price,
                    'date_start' => $discount_date_start,
                    'date_end' => $discount_date_end,
                ]);
            }
            //2 Отредактирована - update
            if($discount_active == 2)
            {
                //print_r(2);

                ProductDiscount::where(['product_id'=>$request['product_id'], 'product_discount_id'=>$discount_product_discount_id])->update([
                    'customer_group_id' => $discount_customer_group_id,
                    'quantity' => $discount_quantity,
                    'priority' => $discount_priority,
                    'price' => $discount_price,
                    'date_start' => $discount_date_start,
                    'date_end' => $discount_date_end,
                ]);
            }
            //3 Удалена - delete
            if($discount_active == 3)
            {
                //Если есть id скидки
                if (isset($product_discount['product_discount_id'])) 
                {
                    ProductDiscount::where(['product_id'=>$request['product_id'], 'product_discount_id'=>$discount_product_discount_id])->delete();
                }
                //Если нет, значит скидка отсутсвует в БД
                else
                {
                    //print_r('del');
                }
                //
            }
        }
        /********** END: Скидки **********/
        
        /********** Акции **********/
        $special_row_count = $request->get('special_row_count');
        for($i=1; $i<$special_row_count; $i++)
        {
            $product_special = $request->get('product_special'.$i);

            $special_active = $product_special['active'];
            if (isset($product_special['product_special_id'])) 
            {
                $special_product_special_id = $product_special['product_special_id'];
            }
            if (isset($product_special['customer_group_id']))
            {
                $special_customer_group_id = $product_special['customer_group_id'];
                $special_priority = $product_special['priority'];
                $special_price = $product_special['price'];
                $special_date_start = $product_special['date_start'];
                $special_date_end = $product_special['date_end'];

            }
            
            $rules = [
                //Основное
                'product_special'.$i.'[customer_group_id]' => 'integer',
                'product_special'.$i.'[priority]' => 'integer',
                'product_special'.$i.'[price]' => 'integer',
                /*'product_discount'.$i.'[date_start]' => 'integer',
                'product_discount'.$i.'[date_end]' => 'integer',*/
            ];
            $customMessages = [
                'integer' => 'Поле :attribute должно быть целочисленным.',
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);

            //1 Только что созданный - create
            if($special_active == 1)
            {
               // dd($request);
                ProductSpecial::create([
                    'product_id' => $request['product_id'],
                    'customer_group_id' => $special_customer_group_id,
                    'priority' => $special_priority,
                    'price' => $special_price,
                    'date_start' => $special_date_start,
                    'date_end' => $special_date_end,
                ]);
            }
            //2 Отредактирована - update
            if($special_active == 2)
            {
                //print_r(2);

                ProductSpecial::where(['product_id'=>$request['product_id'], 'product_special_id'=>$special_product_special_id])->update([
                    'customer_group_id' => $discount_customer_group_id,
                    'priority' => $special_priority,
                    'price' => $special_price,
                    'date_start' => $special_date_start,
                    'date_end' => $special_date_end,
                ]);
            }
            //3 Удалена - delete
            if($special_active == 3)
            {
                //Если есть id скидки
                if (isset($product_special['product_special_id'])) 
                {
                    ProductSpecial::where(['product_id'=>$request['product_id'], 'product_special_id'=>$special_product_special_id])->delete();
                }
                //Если нет, значит скидка отсутсвует в БД
                else
                {
                    //print_r('del');
                }
                //
            }
        }
        /********** END: Акции **********/

        //Узнаём колличество языков
        $langs_count = Langs::count();

        /********** Изображения **********/
        //dd ( $request);
        $image_row_count = $request->get('image_row_count');
        for($i=1; $i<$image_row_count; $i++)
        {
            $rules = [
                //Основное
                'product_image'.$i.'[sort_order]' => 'integer',
            ];
            $customMessages = [
                'integer' => 'Поле :attribute должно быть целочисленным.',
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);
            //name="product_image'+ image_row + '[image]"
            
            $image_id = $request->get('product_image_id'.$i);
            $image_active = $request->get('image_active'.$i);

            if($image_active == 1)
            {

                if($request->file('product_image'.$i) != null)
                {
                    //Порядок сортировки
                $image_array = $request->file('product_image'.$i);
                $puth_image = $image_array['image'];
                
                    //dd($puth_image);
                    //dd($request->file('product_image'.$i.'[image]'));

                    //$file_array = $request->file('product_image'.$i);
                    //$image_upload = $file_array['image']->store('uploads', 'public');

/*
$request->file('image')->move(public_path('images/category'), 
$image_upload = $request->file('image')->getClientOriginalName()); 
*/
// Желаемая структура папок
$structure = 'images/products/'.$request['product_id'];

// Для создания вложенной структуры необходимо указать параметр
// $recursive в mkdir().
if (!is_dir($structure)) {
    mkdir($structure, 0777, true);



/*$image = $request->file('image');
            $ext = '.'.$request->image->getClientOriginalExtension();
            $fileName = str_replace($ext, date('d-m-Y-H-i') . $ext, $request->image->getClientOriginalName());
            $location = public_path('images/' . $fileName);
            Image::make($image)->resize(500, 400)->save($location);

           $article->image = $fileName;*/



   
    $ext = '.'.$puth_image->getClientOriginalExtension();
    $puth_image->move(public_path('images/products/'.$request['product_id']),
    $image_upload = str_replace($ext, date('d-m-Y-H-i') . $ext, $puth_image->getClientOriginalName()));

    //$image_upload = $puth_image->date("Y-m-d H:i:s").getClientOriginalName()); 
}
else
{
    // dd($puth_image);
 $ext = '.'.$puth_image->getClientOriginalExtension();
    $puth_image->move(public_path('images/products/'.$request['product_id']),
    $image_upload = str_replace($ext, date('d-m-Y-H-i') . $ext, $puth_image->getClientOriginalName()));
                   /* $puth_image->move(public_path('images/products/'.$request['product_id']), 
                    //$image_upload = $puth_image->date("Y-m-d H:i:s").getClientOriginalName()); 
                     $ext = '.'.$puth_image->getClientOriginalExtension();
    $image_upload = str_replace($ext, date('d-m-Y-H-i') . $ext, $puth_image->getClientOriginalName());*/
}
                   
                }
                else
                {
                   //Ничего не делаем
                }
            
                //Порядок сортировки
                $sort_array = $request->get('product_image'.$i);
                $sort_image = $sort_array['sort_order'];
                
                //Записываем в БД
                if(isset($image_upload))
                {
                    ProductImage::create([
                        'product_id' => $request['product_id'],
                        'image' => $image_upload,
                        'sort_order' => $sort_image,
                    ]);
                }
                else
                {
                   // print_r('else');
                   // print_r($sort_image);

                    ProductImage::where( ['product_id'=>$request['product_id'], 'product_image_id'=>$image_id])->update([
                        'sort_order' => $sort_image,
                    ]);
                }
            }
            if($image_active == 0)
            {
                ProductImage::where(['product_id'=>$request['product_id'], 'product_image_id'=>$image_id])->delete();
            }
        }
        /********** END: Изображения **********/

        /********** Атрибуты **********/
        //dd ( $request);
        $attribute_row_count = $request->get('attribute_row_count');
        for($i=1; $i<$attribute_row_count; $i++)
        {
            //Принимаем атрибут
            $product_attributes = $request->get('product_attribute'.$i);
            //dd ( $product_attributes);
            //Узнаем id атрибута
            $attribute_id =    $request->get('attribute_id'.$i);
            $attribute_active = $request->get('attribute_active'.$i);
            //print_r( $attribute_active);
            for($j=1; $j<=$langs_count; $j++)
            {

                //Текст атрибута
                $product_attribute_text = $product_attributes['product_attribute_text'.$j];
                $language = $request->get('language'.$j);

                //Проверка на заполненные поля
                //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
                $rules = [
                    //Основное
                    'product_attribute_text'.$j => 'required|string',
                ];
                $customMessages = [
                    'required' => 'Поле :attribute должно быть заполнено.',
                    'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
                ];
                
                
                //1 Только что созданный - create
                if($attribute_active == 1)
                {
                   // dd ( $request);
                   // print_r('1');
                    ProductAttribute::create([
                        'product_id' => $request['product_id'],
                        'attribute_id' => $attribute_id,
                        'language_id' => $language,
                        'text' => $product_attribute_text,
                    ]);
                }
                //2 Отредактирована - update
                if($attribute_active == 2)
                {

                    ProductAttribute::where(['product_id'=>$request['product_id'], 'attribute_id'=>$attribute_id, 'language_id'=>$language])->update([
                        'text' => $product_attribute_text,
                    ]);
                }
                //3 Удалена - delete
                if($attribute_active == 3)
                {
                   
                    ProductAttribute::where(['product_id'=>$request['product_id'], 'attribute_id'=>$attribute_id])->delete();
                }
            }
        }
        /********** END: Атрибуты **********/

        /********** Название товара и т.п. **********/
        //Запускаем цикл не превышающий кол-ва языков
        for($i=1; $i<=$langs_count; $i++)
        {
            //Основное
            $name = $request->get('name'.$i);
            $language = $request->get('language'.$i);
            $description = $request->get('description'.$i);
            $meta_description = $request->get('meta_description'.$i);
            $meta_keyword = $request->get('meta_keyword'.$i);
            $tag = $request->get('tag'.$i);
            //Проверка на заполненные поля
            //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
            $rules = [
                //Основное
                'name'.$i => 'required|string|max:255',
                'description'.$i => 'required|string',
                'meta_description'.$i => 'required|string|max:255',
                'meta_keyword'.$i => 'required|string|max:255',
                'tag'.$i => 'required|string|max:255',
            ];
            $customMessages = [
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            ProductDescription::where(['product_id'=>$request['product_id'], 'language_id'=>$language])->update([
                'name' => $name,
                'description' => $description,
                'meta_description' => $meta_description,
                'meta_keyword' => $meta_keyword,
                'tag' => $tag,
            ]);
        }
        /********** END: Название товара и т.п. **********/

        /********** Данные **********/
        $model = $request->get('model');
        $sku = $request->get('sku');
        $quantity = $request->get('quantity');
        $price = $request->get('price');
        $category = $request->get('category_id');
        $manufacturer = $request->get('manufacturer_id');
        $rules = 
        [
            //Данные
            'model' => 'required|string|max:255',
            'sku' => 'required|string|max:255',
            'quantity' => 'required|integer|max:255',
            'price' => 'required|integer',
            'category_id' => 'required|integer',
            'manufacturer_id' => 'required|integer',
        ];
        $customMessages = 
        [
            'required' => 'Поле :attribute должно быть заполнено.',
            'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
        ];
        $this->validate($request, $rules, $customMessages);
        //Обновляем в БД
        Product::where('product_id', $request['product_id'])->update([
            'model' => $model,
            'sku' => $sku,
            'quantity' => $quantity,
            'price' => $price,
            'category_id' => $category,
            'manufacturer_id' => $manufacturer,
        ]);
        /********** END: Данные **********/
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        ProductDescription::where('product_id', $product['product_id'])->delete();
        ProductAttribute::where('product_id',$product['product_id'])->delete();
        ProductImage::where('product_id',$product['product_id'])->delete(); 
        ProductSpecial::where('product_id',$product['product_id'])->delete(); 
        ProductDiscount::where('product_id',$product['product_id'])->delete();
        ProductOption::where('product_id',$product['product_id'])->delete();
        ProductOptionValue::where('product_id',$product['product_id'])->delete();

        return redirect()->route('admin.product.index');
    }
}