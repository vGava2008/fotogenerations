<?php

namespace App\Http\Controllers\Admin;

use App\Manufacturer;
use App\Langs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
 
use DB; 
class ManufacturerController extends Controller
{
    protected $table = 'manufacturer';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manufacturers.index', [
            'manufacturers' => Manufacturer::paginate(10),
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
        return view('admin.manufacturers.create', [
          'manufacturer'   => [],
          'manufacturers' => Manufacturer::where(['language_id'=>1])->get(),
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
        //Узнаём поледнее ID записи в таблице "Категорий"
        $latest = Manufacturer::latest()->first();
        //dd ( $latest);
        $latest_ID = $latest['id'];
        //Повышаем его на единицу
        $latest_ID++;
         //dd ( $latest['manufacturer_id']);
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //$rules = ['slug' => 'required|string|max:255|unique:categories',];
        if($request->file('image') != null)
        {
            $image_upload = $request->file('image')->store('uploads', 'public');
        }
        else
        {
           //Ничего не делаем
        }
        //Запускаем цикл не превышающий кол-ва языков
        for($i=1; $i<=$langs_count; $i++)
        {
            //Вынимаем значения с переданных данных, а именно с titlte 1-5
            $data_title = $request->get('title'.$i);
            //$image_upload = $request->file('image')->store('uploads', 'public');
            //Проверка на заполненные поля
            //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
            $rules = [
                'title'.$i => 'required|string|max:255',
                'seo_link' => [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('manufacturer')->ignore($latest_ID),],
                //'parent_id' => 'required|integer|max:11',
                'published' => 'required|integer|max:11',
                //'language_id' => 'required|integer|max:11',
            ];
            $customMessages = [
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);
            if(isset($image_upload))
            {
                //Записываем в БД
                Manufacturer::create([
                    'id' => $latest_ID,
                    'image' => $image_upload,
                    'title' => $data_title,
                    'seo_link' => $request['seo_link'],
                    'published' => $request['published'],
                    'language_id' => $i,
                ]);


            }
            else
            {
                //Записываем в БД
                Manufacturer::create([
                    'id' => $latest_ID,
                    //'image' => $image_upload,
                    'title' => $data_title,
                    'seo_link' => $request['seo_link'],
                    'published' => $request['published'],
                    'language_id' => $i,
                ]);
                
            }
            
        }
        return redirect()->route('admin.manufacturer.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturer $manufacturer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer $manufacturer)
    {
        //Узнаём поледнее ID записи в таблице "Категорий"
        $latest = Manufacturer::latest()->first();
        $latest_ID = $latest['id'];
        
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //Берем категории только с переданным нам ID
        $choose_manufacturer = Manufacturer::where('id', $manufacturer['id'])->get();

        return view('admin.manufacturers.edit', [
          'manufacturer'   => $manufacturer,
          'choose_manufacturer'   => $choose_manufacturer,
          'manufacturers' => Manufacturer::where(['language_id'=>1])->get(),
          'languages' => Langs::get(),
          'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufacturer $manufacturer)
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
                \Illuminate\Validation\Rule::unique('manufacturer')->ignore($manufacturer->id),],
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
                Manufacturer::where(['id'=>$request['id'], 'language_id'=>$data_language])->update([
                    'image' => $image_upload, 
                    'title' => $data_title,
                    'seo_link' => $request['seo_link'],
                    'published' => $request['published'],
                ]);

            }
            else
            {
                Manufacturer::where(['id'=>$request['id'], 'language_id'=>$data_language])->update([
                    'title' => $data_title,
                    'seo_link' => $request['seo_link'],
                    'published' => $request['published'],
                ]);
                
            }
        }

        return redirect()->route('admin.manufacturer.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manufacturer  $manufacturer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();
        return redirect()->route('admin.manufacturer.index');
    }
}
