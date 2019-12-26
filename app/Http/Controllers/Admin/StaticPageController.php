<?php

namespace App\Http\Controllers\Admin;

use App\StaticPage;
use App\Langs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaticPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.static_pages.index', [
            'static_pages' => StaticPage::where(['language_id'=>1])->paginate(10),
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
        return view('admin.static_pages.create', [
          'static_page'   => [],
          'languages' => Langs::get(),
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
        //dd($request);
        //Узнаём поледнее ID записи в таблице "Категорий"
        $latest_ID = StaticPage::max('id');
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
            $data_text = $request->get('text'.$i);
            //Проверка на заполненные поля
            //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
            $rules = [
                'title'.$i => 'required|string|max:255',
                //'text'.$i => 'text',
            ];
            $customMessages = [
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);
            //Записываем в БД
           
            $getLocale = Langs::where('id', mb_strtolower($i))->first();
            StaticPage::create([
                'static_page_id' => $latest_ID,
                'title' => $data_title,
                'text' => $data_text,
                'language_id' => $i,
                'locale' => $getLocale->locale,
            ]);
        }
        return redirect()->route('admin.static_page.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StaticPage  $staticPage
     * @return \Illuminate\Http\Response
     */
    public function show(StaticPage $staticPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\StaticPage  $staticPage
     * @return \Illuminate\Http\Response
     */
    public function edit(StaticPage $staticPage)
    {

        $langs_count = Langs::count();
        //Берем категории только с переданным нам ID
       // dd($menuFooter);
        $choose_static_page = StaticPage::where('static_page_id', $staticPage['static_page_id'])->get();
        
        //dd($choose_top_menu);
        return view('admin.static_pages.edit', [
          'static_page'   => $staticPage,
          'choose_static_page'   => $choose_static_page,
          'languages' => Langs::get(), 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StaticPage  $staticPage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaticPage $staticPage)
    {
        //dd($request);
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //$rules = ['slug' => 'required|string|max:255|unique:categories',];
        //Запускаем цикл не превышающий кол-ва языков
        for($i=1; $i<=$langs_count; $i++)
        {
    

            //Вынимаем значения с переданных данных, а именно с titlte 1-5
            $data_title = $request->get('title'.$i);
            $data_text = $request->get('text'.$i);
            $data_language = $request->get('language'.$i);
            //Проверка на заполненные поля
            //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
            $rules = [
                'title'.$i => 'required|string|max:255',
                //'text'.$i => 'text',
            ];
            $customMessages = [
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);
            //Записываем в БД
            $getLocale = Langs::where('id', mb_strtolower($i))->first();
            StaticPage::where(['static_page_id'=>$request['static_page_id'], 'language_id'=>$data_language])->update([
                'title' => $data_title,
                'text' => $data_text,
            ]);
        }
        return redirect()->route('admin.static_page.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StaticPage  $staticPage
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaticPage $staticPage)
    {
        $staticPage->delete();
        return redirect()->route('admin.static_page.index');
    }
}
