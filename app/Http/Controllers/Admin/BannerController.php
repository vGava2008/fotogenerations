<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use App\Langs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.banners.index', [
            'banners' => Banner::paginate(10),
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
        return view('admin.banners.create', [
          'banner'   => [],
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
        $data_name = $request->get('name');
        $request->file('image')->move(public_path('images/banner'), 
        $image_upload = $request->file('image')->getClientOriginalName()); 
        $data_sort_order = $request->get('sort_order');
            //Проверка на заполненные поля
            //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
            $rules = [
                'name' => 'required|string|max:255',
                'sort_order' => 'integer|max:11',
            ];
            $customMessages = [
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);
            //Записываем в БД
            Banner::create([
                'name' => $data_name,
                'image' => $image_upload,
                'sort_order' => $data_sort_order,
            ]);
        
        return redirect()->route('admin.banner.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //Берем категории только с переданным нам ID
        $choose_banner = Banner::where('banner_id', $banner['banner_id'])->get();

        return view('admin.banners.edit', [
          'banner'   => $banner,
          'choose_banner'   => $choose_banner,
          'languages' => Langs::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        if($request->file('image') != null)
        {
            //$image_upload = $request->file('main_image')->store('uploads', 'public');
            $request->file('image')->move(public_path('images/banner'), 
            $image_upload = $request->file('image')->getClientOriginalName()); 
        }
        else
        {
           //Ничего не делаем
        }
        $data_name = $request->get('name');
        $data_sort_order = $request->get('sort_order');
                
        //Проверка на заполненные поля с исключением seo_link
        $rules = [
            'name' => 'required|string|max:255',
            'sort_order' => 'integer|max:11',
        ];
        $customMessages = [
            'required' => 'Поле :attribute должно быть заполнено.',
            'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
        ];
        $this->validate($request, $rules, $customMessages);
        //Записываем в БД
        if(isset($image_upload))
        {
            Banner::where(['banner_id'=>$request['banner_id']])->update([
            'image' => $image_upload,
            'name' => $data_name,
            'sort_order' => $data_sort_order,
            ]);
        }
        else
        {
            Banner::where(['banner_id'=>$request['banner_id']])->update([
            'name' => $data_name,
            'sort_order' => $data_sort_order,
            ]);
            
        }
        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banner.index');
    }
}
