<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
        $category = Category::where(['published' => 1 , 'language_id' => $language->id])->get();
        //    $menu_foother = Menu_Foother::where(['status' => 1])->get();
        return view('index')->with([
          'langs' => $lang,
          'banners' => $banners,
          'top_menu' => $top_menu,
          'categories' => $category,
          'lang' => $language->id,
          //
          'menu_f' => $bottom_menu,
        ]);
    }


}
