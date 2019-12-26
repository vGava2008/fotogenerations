<?php

namespace App\Http\Controllers\Admin;

use App\Blog;
use App\Langs;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.blogs.index', [
            'blogs' => Blog::where(['language_id'=>1])->paginate(10),
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
        return view('admin.blogs.create', [
          'blog'   => [],
          'categories' => Category::with('children')->where(['parent_id'=>0, 'language_id'=>1])->get(),
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
        //dd();
        if($request->file('main_image') != null)
        {
            //$image_upload = $request->file('main_image')->store('uploads', 'public');
            $request->file('main_image')->move(public_path('images/blog'), 
            $image_upload = $request->file('main_image')->getClientOriginalName()); 
        }
        else
        {
           //Ничего не делаем
        }
        if($request->file('second_image') != null)
        {
            //$image_upload2 = $request->file('second_image')->store('uploads', 'public');
            $request->file('second_image')->move(public_path('images/blog'), 
            $image_upload2 = $request->file('second_image')->getClientOriginalName()); 
        }
        else
        {
           //Ничего не делаем
        }
        if($request->file('third_center_image') != null)
        {
            //$image_upload3 = $request->file('third_center_image')->store('uploads', 'public');
            $request->file('third_center_image')->move(public_path('images/blog'), 
            $image_upload3 = $request->file('third_center_image')->getClientOriginalName());
        }
        else
        {
           //Ничего не делаем
        }
        //Узнаём поледнее ID записи в таблице "Категорий"
        $latest = Blog::latest()->first();
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
            //$image_upload = $request->file('main_image')->store('uploads', 'public');
            //$image_upload->move(public_path() . '/images/blog','main_image');
            //$image_upload2 = $request->file('second_image')->store('uploads', 'public');
            $data_title_second_image = $request->get('title_second_image'.$i);
            $data_title_second_level = $request->get('title_second_level'.$i);
            $data_text_left = $request->get('text_left'.$i);
            $data_text_right = $request->get('text_right'.$i);
            //$image_upload3 = $request->file('third_center_image')->store('uploads', 'public');
            $data_title_third_center_image = $request->get('title_third_center_image'.$i);
            $data_text_centr = $request->get('text_centr'.$i);
            //Проверка на заполненные поля
            //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
            $rules = [
                'title'.$i => 'required|string|max:255',
                'main_image' => 'required',
                'second_image' => 'required',
                'title_second_image'.$i => 'required|string|max:255',
                'title_second_level'.$i => 'required|string|max:255',
                'text_left'.$i => 'required|string',
                'text_right'.$i => 'required|string',
                'third_center_image' => 'required',
                'title_third_center_image'.$i => 'string|max:255',
                'text_centr'.$i => 'string',
                'seo_link' => [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('blogs')->ignore($latest_ID),],
                //'categoey_id' => 'required|integer|max:11',
                'published' => 'required|integer|max:11',
                'status' => 'required|integer|max:11',
                //'language_id' => 'required|integer|max:11',
            ];
            $customMessages = [
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);
            //Записываем в БД

            Blog::create([
                'id' => $latest_ID,
                'title' => $data_title,
                'main_image' => $image_upload,
                'second_image' => $image_upload2,
                'title_second_image' => $data_title_second_image,
                'title_second_level' => $data_title_second_level,
                'text_left' => $data_text_left,
                'text_right' => $data_text_right,
                'third_center_image' => $image_upload3,
                'title_third_center_image' => $data_title_third_center_image,
                'text_centr' => $data_text_centr,
                'seo_link' => $request['seo_link'],
                'category_id' => $request['category_id'],
                'published' => $request['published'],
                'status' => $request['status'],
                'language_id' => $i,
            ]);
        }
        return redirect()->route('admin.blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //Узнаём поледнее ID записи в таблице "Категорий"
        $latest = Blog::latest()->first();
        $latest_ID = $latest['id'];
        
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //Берем категории только с переданным нам ID
        $choose_blog = Blog::where('id', $blog['id'])->get();

        return view('admin.blogs.edit', [
          'blog'   => $blog,
          'choose_blog'   => $choose_blog,
          'categories' => Category::with('children')->where(['parent_id'=>0, 'language_id'=>1])->get(),
          'languages' => Langs::get(),
          'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        /*echo "---------------Request---------------";           
        dd($request);
        echo "---------------END: Request---------------";*/
        /*echo "---------------Category---------------";           
        dd($blog);
        echo "---------------END: Category---------------";*/
        //dd ( $request);
        //dd ( $request->file('image'));
        if($request->file('main_image') != null)
        {
            //$image_upload = $request->file('main_image')->store('uploads', 'public');
            $request->file('main_image')->move(public_path('images/blog'), 
            $image_upload = $request->file('main_image')->getClientOriginalName()); 
        }
        else
        {
           //Ничего не делаем
        }
        if($request->file('second_image') != null)
        {
            //$image_upload2 = $request->file('second_image')->store('uploads', 'public');
            $request->file('second_image')->move(public_path('images/blog'), 
            $image_upload2 = $request->file('second_image')->getClientOriginalName()); 
        }
        else
        {
           //Ничего не делаем
        }
        if($request->file('third_center_image') != null)
        {
            //$image_upload3 = $request->file('third_center_image')->store('uploads', 'public');
            $request->file('third_center_image')->move(public_path('images/blog'), 
            $image_upload3 = $request->file('third_center_image')->getClientOriginalName());
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
            //$image_upload = $request->file('main_image')->store('uploads', 'public');
            //$image_upload2 = $request->file('second_image')->store('uploads', 'public');
            $data_title_second_image = $request->get('title_second_image'.$i);
            $data_title_second_level = $request->get('title_second_level'.$i);
            $data_text_left = $request->get('text_left'.$i);
            $data_text_right = $request->get('text_right'.$i);
            //$image_upload3 = $request->file('third_center_image')->store('uploads', 'public');
            $data_title_third_center_image = $request->get('title_third_center_image'.$i);
            $data_text_centr = $request->get('text_centr'.$i);
            $data_language = $request->get('language'.$i);
            //$image_upload;
            //dd($request);
            
            
            //Проверка на заполненные поля с исключением seo_link
            if(isset($image_upload))
            {
                $rules = [
                    'title'.$i => 'required|string|max:255',
                    //'main_image' => 'required',
                    //'second_image' => 'required',
                    'title_second_image'.$i => 'required|string|max:255',
                    'title_second_level'.$i => 'required|string|max:255',
                    'text_left'.$i => 'required|string',
                    'text_right'.$i => 'required|string',
                    //'third_center_image' => 'required',
                    'title_third_center_image'.$i => 'string|max:255',
                    'text_centr'.$i => 'string',
                    'seo_link' => [
                    'required',
                    'string',
                    'max:255',
                    \Illuminate\Validation\Rule::unique('blogs')->ignore($blog->id),],
                    //'categoey_id' => 'required|integer|max:11',
                    'published' => 'required|integer|max:11',
                    //'language_id' => 'required|integer|max:11',
                ];
                $customMessages = [
                    'required' => 'Поле :attribute должно быть заполнено.',
                    'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
                ];
            }
            else
            {
                $rules = [
                    'title'.$i => 'required|string|max:255',
                    'title_second_image'.$i => 'required|string|max:255',
                    'title_second_level'.$i => 'required|string|max:255',
                    'text_left'.$i => 'required|string',
                    'text_right'.$i => 'required|string',
                    'title_third_center_image'.$i => 'string|max:255',
                    'text_centr'.$i => 'string',
                    'seo_link' => [
                    'required',
                    'string',
                    'max:255',
                    \Illuminate\Validation\Rule::unique('blogs')->ignore($blog->id),],
                    //'categoey_id' => 'required|integer|max:11',
                    'published' => 'required|integer|max:11',
                    'status' => 'required|integer|max:11',
                    //'language_id' => 'required|integer|max:11',
                ];
                $customMessages = [
                    'required' => 'Поле :attribute должно быть заполнено.',
                    'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
                ];
            }
            
            $this->validate($request, $rules, $customMessages);
            //Записываем в БД
            if(isset($image_upload) || isset($image_upload2) || isset($image_upload3))
            {
                if(isset($image_upload))
                {
                    Blog::where(['id'=>$request['blog_id'], 'language_id'=>$data_language])->update([
                    'main_image' => $image_upload,
                    ]);
                }
                if(isset($image_upload2))
                {
                    Blog::where(['id'=>$request['blog_id'], 'language_id'=>$data_language])->update([
                    'second_image' => $image_upload2,
                    ]);
                }
                if(isset($image_upload3))
                {
                    Blog::where(['id'=>$request['blog_id'], 'language_id'=>$data_language])->update([
                    'third_center_image' => $image_upload3,
                    ]);
                }

                Blog::where(['id'=>$request['blog_id'], 'language_id'=>$data_language])->update([
                    'title' => $data_title,
                    'title_second_image' => $data_title_second_image,
                    'title_second_level' => $data_title_second_level,
                    'text_left' => $data_text_left,
                    'text_right' => $data_text_right,
                    'title_third_center_image' => $data_title_third_center_image,
                    'text_centr' => $data_text_centr,
                    'seo_link' => $request['seo_link'],
                    'category_id' => $request['category_id'],
                    'published' => $request['published'],
                    'status' => $request['status'],
                ]);

            }
            else
            {
                Blog::where(['id'=>$request['blog_id'], 'language_id'=>$data_language])->update([
                    'title' => $data_title,
                    'title_second_image' => $data_title_second_image,
                    'title_second_level' => $data_title_second_level,
                    'text_left' => $data_text_left,
                    'text_right' => $data_text_right,
                    'title_third_center_image' => $data_title_third_center_image,
                    'text_centr' => $data_text_centr,
                    'seo_link' => $request['seo_link'],
                    'category_id' => $request['category_id'],
                    'published' => $request['published'],
                    'status' => $request['status'],
                ]);
                
            }
        }

        return redirect()->route('admin.blog.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blog.index');
    }
}
