<?php

namespace App\Http\Controllers\Admin;

use App\Option;
use App\OptionDescription;
use App\OptionValue;
use App\OptionValueDescription;
use App\Langs;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.options.index', [
            'options' => Option::paginate(10),
            'option_descriptions' => OptionDescription::where(['language_id'=>1])->get(),
            'languages' => Langs::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.options.create', [
          'option'   => [],
          'option_descriptiom'   => [],
          'count' => 0,
          'languages' => Langs::get(),
          'delimiter'  => ''
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
        //dd ( $data);
       
        $latest_ID = Option::max('option_id');
        //Повышаем его на единицу
        $latest_ID++;
        //Узнаём колличество языков
        $langs_count = Langs::count();


        /********** Option - сортировка и тип **********/
        $type = $request->get('type');
        $sort_order = $request->get('sort_order');
        $rules = 
        [
            'type' => 'required|string',
            'sort_order' => 'integer',
        ];
        $customMessages = [
            'integer' => 'Поле :attribute должно быть целочисленным.',
            'required' => 'Поле :attribute должно быть заполнено.',
            'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
        ];
        $this->validate($request, $rules, $customMessages);
        //Обновляем в БД
        Option::create([
            'option_id' => $latest_ID,
            'type' => $type,
            'sort_order' => $sort_order,
        ]);
        /********** END: Option - сортировка и тип **********/

        /********** OptionDescription - Название опции **********/
        //Запускаем цикл не превышающий кол-ва языков
        for($i=1; $i<=$langs_count; $i++)
        {
            //Основное
            $name = $request->get('name'.$i);
            $language = $request->get('language'.$i);
           
            //Проверка на заполненные поля
            //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
            $rules = [
                //Основное
                'name'.$i => 'required|string|max:255',
            ];
            $customMessages = [
                'integer' => 'Поле :attribute должно быть целочисленным.',
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            OptionDescription::create([
                'option_id' => $latest_ID,
                'language_id' => $language,
                'name' => $name,
            ]);
        }
        /********** END: OptionDescription - Название опции **********/

        /********** OptionValue - сортировка и тип **********/

        
        $option_row_count = $request->get('option_row_count');
        for($i=1; $i<$option_row_count; $i++)
        {
            $latest_option_value_id = OptionValue::max('option_value_id');
            //Повышаем его на единицу
            $latest_option_value_id++;
            //Принимаем опцию
            $option_values = $request->get('option_value'.$i);
            //Узнаем id опции
            $option_id =  $request->get('option_id'.$i);
            $option_value_id = $request->get('option_value_id'.$i);
            $option_value_active = $request->get('option_value_active'.$i);
            //Узнаём порядок сортировки и изображение
            $option_value_sort_order =  $option_values['sort_order'];

            if($request->file('option_value'.$i) != null)
            {
                $file_array = $request->file('option_value'.$i);
                $image_upload = $file_array['image']->store('uploads', 'public');
            }
            else
            {
               //Ничего не делаем
                $image_upload='';
            }
            //1 Только что созданный - create
            if($option_value_active == 1)
            {
               // dd ( $request);
               // print_r('1');
                OptionValue::create([
                    'option_value_id' => $latest_option_value_id,
                    'option_id' => $latest_ID,
                    'image' => $image_upload,
                    'sort_order' => $option_value_sort_order,
                ]);
            }
            //2 Отредактирована - update
            if($option_value_active == 2)
            {

                OptionValue::where(['option_value_id'=>$latest_option_value_id, 'option_id'=> $latest_ID])->update([
                    'sort_order' => $option_value_sort_order,
                ]);
            }
            //3 Удалена - delete
            if($option_value_active == 3)
            {
               
                OptionValue::where(['option_value_id'=>$latest_option_value_id, 'option_id'=> $latest_ID])->delete();
            }

            for($j=1; $j<=$langs_count; $j++)
            {

                //Текст атрибута
                $option_value_description_text = $option_values['option_value_description_name'.$j];
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
                if($option_value_active == 1)
                {
                   // dd ( $request);
                   // print_r('1');
                    OptionValueDescription::create([
                        'option_value_id' => $latest_option_value_id,
                        'language_id' => $language,
                        'option_id' => $latest_ID,
                        'name' => $option_value_description_text,
                    ]);
                }
                //2 Отредактирована - update
                if($option_value_active == 2)
                {

                    OptionValueDescription::where(['option_value_id'=>$latest_option_value_id, 'option_id'=> $latest_ID, 'language_id'=>$language])->update([
                        'name' => $option_value_description_text,
                    ]);
                }
                //3 Удалена - delete
                if($option_value_active == 3)
                {
                   
                    OptionValueDescription::where(['option_value_id'=>$latest_option_value_id, 'option_id'=> $latest_ID])->delete();
                }
            }
        }
        return redirect()->route('admin.option.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show(Option $option)
    {
        return Option::find($option);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit(Option $option)
    {
        //Узнаём колличество языков
        $langs_count = Langs::count();
        $latest_option_value_id = OptionValue::max('option_value_id');
        $latest_option_value_id++;
        //Повышаем его на единицу
        
        return view('admin.options.edit', [
          'option'   => $option,
          'choose_option'   => Option::where('option_id', $option['option_id'])->get(),
          'choose_option_description'   => OptionDescription::where('option_id', $option['option_id'])->get(),
          'choose_option_values'   => OptionValue::where('option_id', $option['option_id'])->get(),
          'choose_option_value_descriptions'   => OptionValueDescription::where('option_id', $option['option_id'])->get(),
          'latest_option_value_id'   => $latest_option_value_id,

          'count' => 0,
          /*'attribute_descriptions' => AttributeDescription::where(['language_id'=>1])->get(),
          'categories' => Category::with('children')->where(['parent_id'=>0, 'language_id'=>1])->get(),
          'manufacturers' => Manufacturer::where(['language_id'=>1])->get(),
          'product_attributes' => ProductAttribute::where(['product_id'=>$product['product_id']])->get(),
          'choose_product_attributes' => ProductAttribute::where(['product_id'=>$product['product_id'], 'language_id'=>1])->get(),
          'product_images' => ProductImage::where(['product_id'=>$product['product_id']])->get(),
          //'products' => Product::with('children')->where(['parent_id'=>0, 'language_id'=>1])->get(),*/
          'languages' => Langs::get(),
          'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Option $option)
    {
        //dd ( $request);
        //Узнаём колличество языков
        $langs_count = Langs::count();


        /********** Option - сортировка и тип **********/
        $type = $request->get('type');
        $sort_order = $request->get('sort_order');
        $rules = 
        [
            'type' => 'required|string',
            'sort_order' => 'integer',
        ];
        $customMessages = [
            'integer' => 'Поле :attribute должно быть целочисленным.',
            'required' => 'Поле :attribute должно быть заполнено.',
            'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
        ];
        $this->validate($request, $rules, $customMessages);
        //Обновляем в БД
        Option::where('option_id', $request['option_id'])->update([
            'type' => $type,
            'sort_order' => $sort_order,
        ]);
        /********** END: Option - сортировка и тип **********/

        /********** OptionDescription - Название опции **********/
        //Запускаем цикл не превышающий кол-ва языков
        for($i=1; $i<=$langs_count; $i++)
        {
            //Основное
            $name = $request->get('name'.$i);
            $language = $request->get('language'.$i);
           
            //Проверка на заполненные поля
            //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
            $rules = [
                //Основное
                'name'.$i => 'required|string|max:255',
            ];
            $customMessages = [
                'integer' => 'Поле :attribute должно быть целочисленным.',
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);
            OptionDescription::where(['option_id'=>$request['option_id'], 'language_id'=>$language])->update([
                'name' => $name,
            ]);
        }
        /********** END: OptionDescription - Название опции **********/
        
        /********** OptionValue - сортировка и тип **********/

        $option_row_count = $request->get('option_row_count');
        for($i=1; $i<$option_row_count; $i++)
        {
            //Принимаем опцию
            $option_values = $request->get('option_value'.$i);
            //Узнаем id опции
            $option_id =  $request['option_id'];
            $option_value_id = $request->get('option_value_id'.$i);
            $option_value_active = $request->get('option_value_active'.$i);
            //Узнаём порядок сортировки и изображение
            $option_value_sort_order =  $option_values['sort_order'];

            if($request->file('option_value'.$i) != null)
            {
                $file_array = $request->file('option_value'.$i);
                $image_upload = $file_array['image']->store('uploads', 'public');
            }
            else
            {
               //Ничего не делаем
            }
            $rules = [
            //Основное
            
            'sort_order' => 'integer',
            ];
            $customMessages = [
                'integer' => 'Поле :attribute должно быть целочисленным.',
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);
            //1 Только что созданный - create
            if($option_value_active == 1)
            {
               // dd ( $request);
               // print_r('1');
               
                OptionValue::create([
                    'option_value_id' => $option_value_id,
                    'option_id' => $option_id,
                    'image' => $image_upload,
                    'sort_order' => $option_value_sort_order,
                ]);
            }
            //2 Отредактирована - update
            if($option_value_active == 2)
            {
            
                OptionValue::where(['option_value_id'=>$option_value_id, 'option_id'=> $option_id])->update([
                    'sort_order' => $option_value_sort_order,
                ]);
            }
            //3 Удалена - delete
            if($option_value_active == 3)
            {

                OptionValue::where(['option_value_id'=>$option_value_id, 'option_id'=> $option_id])->delete();
            }

            for($j=1; $j<=$langs_count; $j++)
            {

                //Текст атрибута
                $option_value_description_text = $option_values['option_value_description_name'.$j];
                $language = $request->get('language'.$j);

                //Проверка на заполненные поля
                //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
               
                /*$rules = [
                    //Основное
                    'option_value_description_name'.$j => 'required|string',
                    ];
                    $customMessages = [
                        'required' => 'Поле :attribute должно быть заполнено.',
                        'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
                    ];
                    $this->validate($request, $rules, $customMessages);*/
                //1 Только что созданный - create
                if($option_value_active == 1)
                {
                   // dd ( $request);
                   // print_r('1');

                    OptionValueDescription::create([
                        'option_value_id' => $option_value_id,
                        'language_id' => $language,
                        'option_id' => $option_id,
                        'name' => $option_value_description_text,
                    ]);
                }
                //2 Отредактирована - update
                if($option_value_active == 2)
                {

                    OptionValueDescription::where(['option_value_id'=>$option_value_id, 'option_id'=> $option_id, 'language_id'=>$language])->update([
                        'name' => $option_value_description_text,
                    ]);
                }
                //3 Удалена - delete
                if($option_value_active == 3)
                {
                   
                    OptionValueDescription::where(['option_value_id'=>$option_value_id, 'option_id'=> $option_id])->delete();
                }
            }
        }

        /********** END: OptionValue - сортировка и тип **********/

        /********** Изображения **********/
        //dd ( $request);
        /*
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
        /*$attribute_row_count = $request->get('attribute_row_count');
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

        

        /********** Данные **********/
        /*$model = $request->get('model');
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
        return redirect()->route('admin.option.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy(Option $option)
    {
        $option->delete();
        OptionDescription::where('option_id', $option['option_id'])->delete();   
        OptionValue::where('option_id', $option['option_id'])->delete();   
        OptionValueDescription::where('option_id', $option['option_id'])->delete();   
        return redirect()->route('admin.option.index');
    }

    public function autocomplete() {
        $json = array();

        if (isset($this->request->get['filter_name'])) {
            $this->load->language('catalog/option');

            $this->load->model('catalog/option');

            $this->load->model('tool/image');

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
//return response($content, $status)->header('Content-Type', $value);
        $this->response()->addHeader('Content-Type: application/json');
        $this->response()->setOutput(json_encode($json));
    }
}
