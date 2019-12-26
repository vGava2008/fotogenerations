<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use App\Languages;
use App\Category;
use App\Langs;
use App;
use App\Banner;
use App\TopMenu;
use App\BottomMenu;
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
       /* $lang = Langs::all();
//      $cats = Category::where();
        return view('index')->with([
        'langs' => $lang,
        ]);*/
        $lang = Langs::all();
        $banners = Banner::all();
        $language = Langs::where(['locale' => App::getLocale()])->first();
        $top_menu = TopMenu::where(['status' => 1 , 'language_id' => $language->id])->get();
        $bottom_menu = BottomMenu::where(['status' => 1 , 'language_id' => $language->id])->get();
        //print_r($bottom_menu);
        $category = Category::where(['published' => 1 , 'language_id' => $language->id])->get();
        //dd($category);
        //    $menu_foother = Menu_Foother::where(['status' => 1])->get();
        return view('index')->with([
          'langs' => $lang,
          'banners' => $banners,
          'top_menu' => $top_menu,
          'bottom_menu' => $bottom_menu,
          'categories' => $category,
          'lang' => $language->id,
          
          //
          
        ]);
    }
}