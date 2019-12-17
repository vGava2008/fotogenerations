<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Langs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB; 

class CategoryController extends Controller
{
    //Отображение списка
    public function index()
    {
        //
        return view('admin.categories.index', [
            'categories' => Category::paginate(10),
            'languages' => Langs::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    //Открытие формы создания категорий
    public function create()
    {
        return view('admin.categories.create', [
          'category'   => [],
          'categories' => Category::with('children')->where('parent_id', '0')->get(),
          'languages' => Langs::get(),
          'delimiter'  => ''
        ]);
    }

    //Создаёт записи в таблице
    public function store(Request $request)
    {

        //Узнаём поледнее ID записи в таблице "Категорий"
        $latest = Category::latest()->first();
        $latest_ID = $latest['id'];
        //Повышаем его на единицу
        $latest_ID++;
         //dd ( $request);
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //$rules = ['slug' => 'required|string|max:255|unique:categories',];
        
        //Запускаем цикл не превышающий кол-ва языков
        for($i=1; $i<=$langs_count; $i++)
        {
            //Вынимаем значения с переданных данных, а именно с titlte 1-5
            $data_title = $request->get('title'.$i);
            $data_description = $request->get('description'.$i);

            $image_upload = $request->file('image')->store('uploads', 'public');
            //Проверка на заполненные поля
            //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
            $rules = [
                'title'.$i => 'required|string|max:255',
                'seo_link' => [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('categories')->ignore($latest_ID),],
                //'parent_id' => 'required|integer|max:11',
                'published' => 'required|integer|max:11',
                //'language_id' => 'required|integer|max:11',
            ];
            $customMessages = [
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);
            //Записываем в БД
            Category::create([
                'id' => $latest_ID,
                'image' => $image_upload,
                'title' => $data_title,
                'description' => $data_description,

                'seo_link' => $request['seo_link'],
                'parent_id' => $request['parent_id'],
                'published' => $request['published'],
                'language_id' => $i,
            ]);
        }
        return redirect()->route('admin.category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    //Отображение записи
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    //Открытие формы обновления
    public function edit(Category $category)
    {
        //Узнаём поледнее ID записи в таблице "Категорий"
        $latest = Category::latest()->first();
        $latest_ID = $latest['id'];
        
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //Берем категории только с переданным нам ID
        $choose_category = Category::where('id', $category['id'])->get();

        return view('admin.categories.edit', [
          'category'   => $category,
          'choose_category'   => $choose_category,
          'categories' => Category::with('children')->where('parent_id', '0')->get(),
          'languages' => Langs::get(),
          'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    //Обновление
    public function update(Request $request, Category $category)
    {
        /*echo "---------------Request---------------";           
        dd($request);
        echo "---------------END: Request---------------";/*
        echo "---------------Category---------------";           
        dd($category);
        echo "---------------END: Category---------------";*/
         //dd ( $request);
        //dd ( $request->file('image'));
        if($request->file('image') != null)
        {
            $image_upload = $request->file('image')->store('uploads', 'public');
        }
        else
        {
           //Ничего не делаем
        }
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //Запускаем цикл не превышающий кол-ва языков
        for($i=1; $i<=$langs_count; $i++)
        {
            //Вынимаем значения с переданных данных, а именно с titlte 1-5 и с languages 1-5
            $data_title = $request->get('title'.$i);
            $data_language = $request->get('language'.$i);
            //$image_upload;
            //dd($request);
            
            
            //Проверка на заполненные поля с исключением seo_link
            $rules = [
                'title'.$i => 'required|string|max:255',
                'seo_link' => [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('categories')->ignore($category->id),],
                'published' => 'required|integer|max:11',
            ];
            $customMessages = [
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);
            //Записываем в БД
            if(isset($image_upload))
            {
                Category::where(['id'=>$request['category_id'], 'language_id'=>$data_language])->update(['image' => $image_upload, 'title' => $data_title,
                    'seo_link' => $request['seo_link'],
                    'parent_id' => $request['parent_id'],
                    'published' => $request['published'],
                ]);

            }
            else
            {
                Category::where(['id'=>$request['category_id'], 'language_id'=>$data_language])->update(['title' => $data_title,
                    'seo_link' => $request['seo_link'],
                    'parent_id' => $request['parent_id'],
                    'published' => $request['published'],
                ]);
                
            }
        }

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    //удаление
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index');
    }
}
