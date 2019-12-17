<?php

namespace App\Http\Controllers\Admin\ProductAttribute;

use App\AttributeGroup;
use App\AttributeGroupDescription;
use App\Langs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttributeGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.attribute_groups.index', [
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
        return view('admin.attribute_groups.create', [
          'attribute_group'   => [],
          'attribute_group_description'   => [],
          'count' => $count,
          //'categories' => Category::with('children')->where(['parent_id'=>0, 'language_id'=>1])->get(),
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
        $latestGroup = AttributeGroup::latest()->first();
        $latest_ID_Group = $latestGroup['attribute_group_id'];
        $latestGroupDescription = AttributeGroupDescription::latest()->first();
        $latest_ID_GroupDescription = $latestGroupDescription['attribute_group_id'];

        //Повышаем его на единицу
        $latest_ID_Group++;
        $latest_ID_GroupDescription++;
         //dd ( $request);
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //$rules = ['slug' => 'required|string|max:255|unique:categories',];


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
        AttributeGroup::create([
            'attribute_group_id' => $latest_ID_Group,
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
            
            AttributeGroupDescription::create([
                'attribute_group_id' => $latest_ID_GroupDescription,
                'name' => $name,
                'language_id' => $language,
            ]);
        }
        return redirect()->route('admin.attribute_group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function show(AttributeGroup $attributeGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(AttributeGroup $attributeGroup)
    {
        $count=0;
        //Узнаём поледнее ID записи в таблице "Категорий"
        //$latest = Product::latest()->first();
        //$latest_ID = $latest['product_id'];
        
        //Берем категории только с переданным нам ID
        $choose_attribute_group = AttributeGroup::where('attribute_group_id', $attributeGroup['attribute_group_id'])->get();
        //Узнаём колличество языков
        $langs_count = Langs::count();
    
        $choose_attribute_group_description = AttributeGroupDescription::where('attribute_group_id', $attributeGroup['attribute_group_id'])->get();

        return view('admin.attribute_groups.edit', [
          'attribute_group'   => $attributeGroup,
          'choose_attribute_group'   => $choose_attribute_group,
          'choose_attribute_group_description'   => $choose_attribute_group_description,
          'count' => $count,
          'languages' => Langs::get(),
          'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AttributeGroup $attributeGroup)
    {
        //dd ( $request);
         //Узнаём колличество языков
        $langs_count = Langs::count();
        //Данные
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
        AttributeGroup::where('attribute_group_id', $request['attribute_group_id'])->update([
            'sort_order' => $sort_order,
        ]);

        //Запускаем цикл не превышающий кол-ва языков
        for($i=1; $i<=$langs_count; $i++)
        {

            //Основное
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
            
           AttributeGroupDescription::where(['attribute_group_id'=>$request['attribute_group_id'], 'language_id'=>$language])->update([
                'name' => $name,
            ]);
           
        }
 
        return redirect()->route('admin.attribute_group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AttributeGroup  $attributeGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttributeGroup $attributeGroup)
    {
        $attributeGroup->delete();
        $attribute_group_description = AttributeGroupDescription::where('attribute_group_id', $attributeGroup['attribute_group_id'])->delete();
        return redirect()->route('admin.attribute_group.index');
    }
}
