<?php

namespace App\Http\Controllers\Admin;

use App\UserTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user_tags.index', [
            'user_tags' => UserTag::paginate(10)
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
        return view('admin.user_tags.create', [
          'user_tag'   => [],
          'count' => $count,
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
        $name = $request->get('name');
        $description = $request->get('description');

        //Проверка на заполненные поля
        //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
        $rules = [
            //Основное
            'name' => 'required|string',
            'description' => 'string',
        ];
        $customMessages = [
            'required' => 'Поле :attribute должно быть заполнено.',
            'integer' => 'Поле :attribute должно быть целочисленным.',
            'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
        ]; 
               
        UserTag::create([
            'name' => $name,
            'description' => $description,
        ]);
               
        return redirect()->route('admin.user_tag.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserTag  $userTag
     * @return \Illuminate\Http\Response
     */
    public function show(UserTag $userTag)
    {
         
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserTag  $userTag
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTag $userTag)
    {
        return view('admin.user_tags.edit', [
          'user_tag'   => $userTag,
          'choose_user_tag'   => UserTag::where('user_tag_id', $userTag['user_tag_id'])->get(),
          'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserTag  $userTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTag $userTag)
    {
        $name = $request->get('name');
        $description = $request->get('description');

        //Проверка на заполненные поля
        //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
        $rules = [
            //Основное
            'name' => 'required|string',
            'description' => 'string',
        ];
        $customMessages = [
            'required' => 'Поле :attribute должно быть заполнено.',
            'integer' => 'Поле :attribute должно быть целочисленным.',
            'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
        ]; 
               
        UserTag::where( 'user_tag_id', $request['user_tag_id'])->update([
            'name' => $name,
            'description' => $description,
        ]);
               
        return redirect()->route('admin.user_tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserTag  $userTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTag $userTag)
    {
        $userTag->delete();
    }
}
