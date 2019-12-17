<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public $timestamps = false;
    public function index()
    {
        return view('admin.country.index', [
            'countries' => Country::paginate(10)
        ]);
    }

    public function create()
    {
        return view('admin.country.create', [
          'country'   => [],
          'countries' => Country::get(),
          'delimiter'  => ''
        ]);
    }

    public function store(Request $request)
    {
        Country::create($request->all());
        return redirect()->route('admin.country.index');
    }

    public function show(Country $country){}

    public function edit(Country $country)
    {
        return view('admin.country.edit', [
          'country'   => $country,
          'countries' => Country::get(),
          'delimiter'  => ''

          /*'categories' => Category::with('children')->where('parent_id', '0')->get(),
          'delimiter'  => ''*/
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        $country->update($request->except('id'));
        return redirect()->route('admin.country.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('admin.country.index');
    }
}
