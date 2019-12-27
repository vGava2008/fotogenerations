<?php

namespace App\Http\Controllers;
use App;
use App\Category;
use App\BottomMenu;
use App\Blog;
use App\TopMenu;
use App\Langs;
use Illuminate\Http\Request;
use Collective\Html\HtmlFacade;

class BlogController extends Controller 
{
    public function category($seo_link)
    {
        
    	$locale = App::getLocale();
    	$id_Locale = Langs::where('locale', mb_strtolower($locale))->first();
    	//print_r($id_Locale);
    	$category = Category::where('seo_link', $seo_link)->first();
        $top_menu = TopMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get();
        $bottom_menu = BottomMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get();
    	return view('blog.category', [
    		'langs' => Langs::all(),
    		'category' => $category,
            'top_menu' => $top_menu,
            'bottom_menu' => $bottom_menu,
    		'articles' => Blog::where(['published'=>1, 'status'=>0, 'language_id'=>$id_Locale->id])->paginate(8),
    		'ideas' => Blog::where(['published'=>1, 'status'=>1, 'language_id'=>$id_Locale->id])->paginate(100),
    	]);
    }

    public function article($seo_link)
    {
        $locale = App::getLocale();
        $id_Locale = Langs::where('locale', mb_strtolower($locale))->first();
        $top_menu = TopMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get();
        $bottom_menu = BottomMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get();
        //print_r($id_Locale);
        //$category = Category::where('seo_link', $seo_link)->first();
        return view('blog.article', [
            'langs' => Langs::all(),
            'top_menu' => $top_menu,
            'bottom_menu' => $bottom_menu,
            //'category' => $category,
            'article' => Blog::where(['seo_link'=>$seo_link, 'language_id'=>$id_Locale->id])->first(),
            //'ideas' => Blog::where(['published'=>1, 'status'=>1, 'language_id'=>$id_Locale->id])->paginate(100),
        ]);
    }
    
}
