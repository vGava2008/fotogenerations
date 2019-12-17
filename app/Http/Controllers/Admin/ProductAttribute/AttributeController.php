<?php

namespace App\Http\Controllers\Admin\ProductAttribute;

use App\Langs;
use App\Attribute;
use App\AttributeDescription;
use App\AttributeGroup;
use App\AttributeGroupDescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.attributes.index', [
            'attributes' => Attribute::paginate(10),
            'attribute_descriptions' => AttributeDescription::where(['language_id'=>1])->get(),
            'attribute_groups' => AttributeGroup::paginate(10),
            'attribute_group_descriptions' => AttributeGroupDescription::where(['language_id'=>1])->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $count=0;
    return view('admin.attributes.create', [
      'attribute'   => [],
      'attribute_description'   => [],
      'count' => $count,
      'attribute_groups' => AttributeGroup::get(),
      'attribute_group_descriptions' => AttributeGroupDescription::where(['language_id'=>1])->get(),
      //'manufacturers' => Manufacturer::where(['language_id'=>1])->get(),
      ///'products' => Product::with('children')->where('parent_id', '0')->get(),
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
        //dd ( $request);
        //Узнаём поледнее ID записи в таблице "Категорий"
        $latestAttribute = Attribute::latest()->first();
        $latest_ID_Attribute = $latestAttribute['attribute_id'];
        $latestAttributeDescription = AttributeDescription::latest()->first();
        $latest_ID_AttributeDescription = $latestAttributeDescription['attribute_id'];

        //Повышаем его на единицу
        $latest_ID_Attribute++;
        $latest_ID_AttributeDescription++;
         //dd ( $request);
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //$rules = ['slug' => 'required|string|max:255|unique:categories',];


        $attribute_group_id = $request->get('attribute_group_id');
        $sort_order = $request->get('sort_order');
        $rules = [
            //Данные
            'sort_order' => 'integer',
        ];
        $customMessages = [
            'required' => 'Поле :attribute должно быть заполнено.',
            'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
        ];
        $this->validate($request, $rules, $customMessages);
            //Записываем в БД
        Attribute::create([
            'attribute_id' => $latest_ID_Attribute,
            'attribute_group_id' => $attribute_group_id,
            'sort_order' => $sort_order,
        ]);

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
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            
            AttributeDescription::create([
                'attribute_id' => $latest_ID_AttributeDescription,
                'name' => $name,
                'language_id' => $language,
            ]);
        }
        return redirect()->route('admin.attribute.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function show(Attribute $attribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function edit(Attribute $attribute)
    {
        $count=0;
        //Берем категории только с переданным нам ID
        $choose_attribute = Attribute::where('attribute_id', $attribute['attribute_id'])->get();
        $choose_attribute_group = AttributeGroup::where('attribute_group_id', $attribute['attribute_group_id'])->get();
        //Узнаём колличество языков
        $langs_count = Langs::count();
    
        $choose_attribute_description = AttributeDescription::where('attribute_id', $attribute['attribute_id'])->get();
        $choose_attribute_group_description = AttributeGroupDescription::where('attribute_group_id', $attribute['attribute_group_id'])->get();

        return view('admin.attributes.edit', [
          'attribute'   => $attribute,
          'choose_attribute'   => $choose_attribute,
          'choose_attribute_group'   => $choose_attribute_group,
          'choose_attribute_description'   => $choose_attribute_description,
          'choose_attribute_group_description'   => $choose_attribute_group_description,
          'attribute_group_descriptions' => AttributeGroupDescription::where(['language_id'=>1])->get(),
          'count' => $count,
          'languages' => Langs::get(),
          'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attribute $attribute)
    {
        //dd ( $request);
         //Узнаём колличество языков
        $langs_count = Langs::count();
        //Данные
        $attribute_group_id = $request->get('attribute_group_id');
        $sort_order = $request->get('sort_order');
        $rules = [
            //Данные
            'sort_order' => 'integer',
        ];
        $customMessages = [
            'required' => 'Поле :attribute должно быть заполнено.',
            'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
        ];
        $this->validate($request, $rules, $customMessages);
            //Записываем в БД
        Attribute::where('attribute_id', $request['attribute_id'])->update([
            'attribute_group_id' => $attribute_group_id,
            'sort_order' => $sort_order,
        ]);

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
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            
            AttributeDescription::where(['attribute_id'=>$request['attribute_id'], 'language_id'=>$language])->update([
                'name' => $name,
            ]);
        }
 
        return redirect()->route('admin.attribute.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attribute  $attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        $attribute_description = AttributeDescription::where('attribute_id', $attribute['attribute_id'])->delete();
        return redirect()->route('admin.attribute.index');
    }
}
