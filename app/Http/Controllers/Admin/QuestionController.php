<?php

namespace App\Http\Controllers\Admin;

use App\Question;
use App\Langs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.questions.index', [
            'questions' => Question::where('language_id', '1')->paginate(10), 
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
        return view('admin.questions.create', [
          'question'   => [],
          //'questions' => Category::with('children')->where('parent_id', '0')->get(),
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
        $latest = Question::latest()->first();
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
            $data_text_info = $request->get('text_info'.$i);
           
            //Проверка на заполненные поля
            //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
            $rules = [
                'title'.$i => 'required|string|max:255',
                'text_info'.$i => 'required|string',
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
            Question::create([
                'id' => $latest_ID,
                'title' => $data_title,
                'text_info' => $data_text_info,
                'language_id' => $i,
                'published' => $request['published'],
                
            ]);
        }
        return redirect()->route('admin.question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //Узнаём поледнее ID записи в таблице "Категорий"
        $latest = Question::latest()->first();
        $latest_ID = $latest['id'];
        
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //Берем категории только с переданным нам ID
        $choose_question = Question::where('id', $question['id'])->get();

        return view('admin.questions.edit', [
          'question'   => $question,
          'choose_question'   => $choose_question,
          'languages' => Langs::get(),
          'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //Узнаём колличество языков
        $langs_count = Langs::count();
        //Запускаем цикл не превышающий кол-ва языков
        for($i=1; $i<=$langs_count; $i++)
        {
            //Вынимаем значения с переданных данных, а именно с titlte 1-5 и с languages 1-5
            $data_title = $request->get('title'.$i);
            $data_text_info = $request->get('text_info'.$i);
            $data_language = $request->get('language'.$i);
            //$image_upload;
            //dd($request);
            
            
            //Проверка на заполненные поля с исключением seo_link
            $rules = [
                'title'.$i => 'required|string|max:255',
                'text_info'.$i => 'required|string',
                'published' => 'required|integer|max:11',
            ];
            $customMessages = [
                'required' => 'Поле :attribute должно быть заполнено.',
                'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
            ];
            $this->validate($request, $rules, $customMessages);
            
            Question::where([
                'id'=>$request['question_id'], 
                'language_id'=>$data_language])->update([
                    'title' => $data_title,
                    'text_info' => $data_text_info, 
                    'language_id'=>$data_language,
                    'published' => $request['published']]);
        }

        return redirect()->route('admin.question.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.question.index');
    }
}
