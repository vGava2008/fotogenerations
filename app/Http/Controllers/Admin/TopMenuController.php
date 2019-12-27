<?php 

namespace App\Http\Controllers\Admin;

use App\TopMenu;
use App\Langs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TopMenuController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.top_menus.index', [
            'top_menus' => TopMenu::where(['language_id'=>1])->paginate(10),
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
        return view('admin.top_menus.create', [
          'top_menu'   => [],
          'menus' => TopMenu::with('children')->where(['parent_id' => 0, 'language_id' => 1] )->get(),
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
        //dd($request);
        //Узнаём поледнее ID записи в таблице "Категорий"
        $latest_ID = TopMenu::max('id');
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
            $data_name = $request->get('name'.$i);
            $data_url = $request->get('url');
            $data_status = $request->get('status');
            $data_parent = $request->get('parent_id');
            $data_sort_order = $request->get('sort_order');
            //Проверка на заполненные поля
            //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
            $rules = [
                'name'.$i => 'required|string|max:255',
                'url' => 'string|max:255',
                
                'status' => 'required|integer|max:11',
                'sort_order' => 'required|integer|max:11',
            ];
            $customMessages = [
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);
            //Записываем в БД

            TopMenu::create([
                'top_menu_id' => $latest_ID,
                'name' => $data_name,
                'url' => $data_url,
                'parent_id' => $data_parent,
                'status' => $data_status,
                'sort_order'=>$data_sort_order,
                'language_id' => $i,
            ]);
        }
        return redirect()->route('admin.top_menu.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TopMenu  $topMenu
     * @return \Illuminate\Http\Response
     */
    public function show(TopMenu $topMenu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TopMenu  $topMenu
     * @return \Illuminate\Http\Response
     */
    public function edit(TopMenu $topMenu)
    {
        $langs_count = Langs::count();
        //Берем категории только с переданным нам ID
       // dd($menuFooter);
        $choose_top_menu = TopMenu::where('top_menu_id', $topMenu['top_menu_id'])->get();
        //dd($choose_top_menu);
        return view('admin.top_menus.edit', [
          'top_menu'   => $topMenu,
          'choose_top_menu'   => $choose_top_menu,
          'menus' => TopMenu::with('children')->where(['parent_id' => 0, 'language_id' => 1] )->get(),
          'languages' => Langs::get(),
          'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TopMenu  $topMenu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TopMenu $topMenu)
    {
        //dd($request);
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //$rules = ['slug' => 'required|string|max:255|unique:categories',];
        //Запускаем цикл не превышающий кол-ва языков
        for($i=1; $i<=$langs_count; $i++)
        {
    

            //Вынимаем значения с переданных данных, а именно с titlte 1-5
            $data_name = $request->get('name'.$i);
            $data_url = $request->get('url');
            $data_status = $request->get('status');
            $data_parent = $request->get('parent_id');
            $data_sort_order = $request->get('sort_order');
            $data_language = $request->get('language'.$i);
            //Проверка на заполненные поля
            //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
            $rules = [
                'name'.$i => 'required|string|max:255',
                'url' => 'string|max:255',
                
                'status' => 'required|integer|max:11',
                'sort_order' => 'required|integer|max:11',
            ];
            $customMessages = [
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);
            //Записываем в БД
            TopMenu::where(['top_menu_id'=>$request['top_menu_id'], 'language_id'=>$data_language])->update([
                'name' => $data_name,
                'url' => $data_url,
                'status' => $data_status,
                'parent_id' => $data_parent,
                'sort_order' => $data_sort_order,
            ]);
        }
        return redirect()->route('admin.top_menu.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TopMenu  $topMenu
     * @return \Illuminate\Http\Response
     */
    public function destroy(TopMenu $topMenu)
    {
        TopMenu::where('top_menu_id', $topMenu['top_menu_id'])->delete();
        return redirect()->route('admin.top_menu.index');
    }
}
