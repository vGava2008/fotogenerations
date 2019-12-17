<?php

namespace App\Http\Controllers\Admin;

use App\CustomerGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.customer_groups.index', [
            'groups' => CustomerGroup::paginate(10)
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
        return view('admin.customer_groups.create', [
          'group'   => [],
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
        $sort_order = $request->get('sort_order');

        //Проверка на заполненные поля
        //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
        $rules = [
            //Основное
            'name' => 'required|string',
            'description' => 'string',
            'sort_order' => 'integer',
        ];
        $customMessages = [
            'required' => 'Поле :attribute должно быть заполнено.',
            'integer' => 'Поле :attribute должно быть целочисленным.',
            'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
        ]; 
               
        CustomerGroup::create([
            'name' => $name,
            'description' => $description,
            'sort_order' => $sort_order,
        ]);
               
        return redirect()->route('admin.customer_group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerGroup $customerGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerGroup $customerGroup)
    {
        return view('admin.customer_groups.edit', [
          'group'   => $customerGroup,
          'choose_group'   => CustomerGroup::where('customer_group_id', $customerGroup['customer_group_id'])->get(),
          'delimiter'  => ''
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerGroup $customerGroup)
    {
        //dd($request);
        $name = $request->get('name');
        $description = $request->get('description');
        $sort_order = $request->get('sort_order');

        //Проверка на заполненные поля
        //Берем ID нашей новой категории и исключаем поле seo_link, но прежде чем будет исключение, он проверит остальные записи и скажет о том что такое поле уже существует 
        $rules = [
            //Основное
            'name' => 'required|string',
            'description' => 'string',
            'sort_order' => 'integer',
        ];
        $customMessages = [
            'required' => 'Поле :attribute должно быть заполнено.',
            'integer' => 'Поле :attribute должно быть целочисленным.',
            'unique' => 'В поле "Уникальное название поля для всех языковых пакетов" - такое значение уже существует'
        ]; 
               
        CustomerGroup::where( 'customer_group_id', $request['customer_group_id'])->update([
            'name' => $name,
            'description' => $description,
            'sort_order' => $sort_order,
        ]);
               
        return redirect()->route('admin.customer_group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CustomerGroup  $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerGroup $customerGroup)
    {
        $customerGroup->delete();
    }
}
