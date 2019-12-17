<?php

namespace App\Http\Controllers\Admin;

use App\UserFilter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserFilterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user_filters.index', [
            'user_filters' => UserFilter::paginate(10)
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
        return view('admin.user_filters.create', [
          'user_filter'   => [],
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
               
        UserFilter::create([
            'name' => $name,
            'description' => $description,
        ]);
               
        return redirect()->route('admin.user_filter.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserFilter  $userFilter
     * @return \Illuminate\Http\Response
     */
    public function show(UserFilter $userFilter)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserFilter  $userFilter
     * @return \Illuminate\Http\Response
     */
    public function edit(UserFilter $userFilter)
    {
        return view('admin.user_filters.edit', [
          'user_filter'   => $userFilter,
          'choose_user_filter'   => UserFilter::where('user_filter_id', $userFilter['user_filter_id'])->get(),
          'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserFilter  $userFilter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserFilter $userFilter)
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
               
        UserFilter::where( 'user_filter_id', $request['user_filter_id'])->update([
            'name' => $name,
            'description' => $description,
        ]);
               
        return redirect()->route('admin.user_filter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserFilter  $userFilter
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserFilter $userFilter)
    {
        $userFilter->delete();
    }
}
