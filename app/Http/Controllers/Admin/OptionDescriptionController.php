<?php

namespace App\Http\Controllers\Admin;

use App\OptionDescription;
use App\Langs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OptionDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.option_descriptions.index', [
            'option_descriptions' => OptionDescription::paginate(10),
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OptionDescription  $optionDescription
     * @return \Illuminate\Http\Response
     */
    public function show(OptionDescription $optionDescription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OptionDescription  $optionDescription
     * @return \Illuminate\Http\Response
     */
    public function edit(OptionDescription $optionDescription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OptionDescription  $optionDescription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OptionDescription $optionDescription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OptionDescription  $optionDescription
     * @return \Illuminate\Http\Response
     */
    public function destroy(OptionDescription $optionDescription)
    {
        //
    }
}
