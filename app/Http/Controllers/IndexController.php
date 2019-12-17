<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Languages;
use App\Category;
use App\Langs;
//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use DB; 


class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $lang = Langs::all();
//    $cats = Category::where();
        return view('index')->with([
  'langs' => $lang,
]);
    }
}
