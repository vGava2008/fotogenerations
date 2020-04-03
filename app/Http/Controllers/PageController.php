<?php

namespace App\Http\Controllers;
use App;
use App\StaticPage;
use App\Langs;
use App\TopMenu;
use App\BottomMenu;
use App\Question;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
    	$locale = App::getLocale();
    	$id_Locale = Langs::where('locale', mb_strtolower($locale))->first();
    	//print_r($id_Locale);
    	$page = StaticPage::where(['static_page_id' => 1, 'language_id'=>$id_Locale->id])->first();
       
    	return view('page.index', [
    		'langs' => Langs::all(),
            'page_id' => 1,
    		'page' => $page,
            'top_menu' => TopMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'bottom_menu' => BottomMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'lang' => $id_Locale->id,
    		//'articles' => Blog::where(['published'=>1, 'status'=>0, 'language_id'=>$id_Locale->id])->paginate(8),
    		//'ideas' => Blog::where(['published'=>1, 'status'=>1, 'language_id'=>$id_Locale->id])->paginate(100),
    	]);
    }
    public function contacts()
    {
        $locale = App::getLocale();
        $id_Locale = Langs::where('locale', mb_strtolower($locale))->first();
        //print_r($id_Locale);
        $page = StaticPage::where(['static_page_id' => 6, 'language_id'=>$id_Locale->id])->first();
        return view('page.index', [
            'langs' => Langs::all(),
            'page_id' => 6,
            'page' => $page,
            'top_menu' => TopMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'bottom_menu' => BottomMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'lang' => $id_Locale->id,
            //'articles' => Blog::where(['published'=>1, 'status'=>0, 'language_id'=>$id_Locale->id])->paginate(8),
            //'ideas' => Blog::where(['published'=>1, 'status'=>1, 'language_id'=>$id_Locale->id])->paginate(100),
        ]);
    }
    public function termsofsale()
    {
        $locale = App::getLocale();
        $id_Locale = Langs::where('locale', mb_strtolower($locale))->first();
        //print_r($id_Locale);
        $page = StaticPage::where(['static_page_id' => 11, 'language_id'=>$id_Locale->id])->first();
        return view('page.index', [
            'langs' => Langs::all(),
            'page_id' => 11,
            'page' => $page,
            'top_menu' => TopMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'bottom_menu' => BottomMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'lang' => $id_Locale->id,
        ]);
    }
    public function shippingandpayment()
    {
        $locale = App::getLocale();
        $id_Locale = Langs::where('locale', mb_strtolower($locale))->first();
        //print_r($id_Locale);
        $page = StaticPage::where(['static_page_id' => 16, 'language_id'=>$id_Locale->id])->first();
        return view('page.index', [
            'langs' => Langs::all(),
            'page_id' => 16,
            'page' => $page,
            'top_menu' => TopMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'bottom_menu' => BottomMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'lang' => $id_Locale->id,
        ]);
    }
    public function partnership()
    {
        $locale = App::getLocale();
        $id_Locale = Langs::where('locale', mb_strtolower($locale))->first();
        //print_r($id_Locale);
        $page = StaticPage::where(['static_page_id' => 21, 'language_id'=>$id_Locale->id])->first();
        return view('page.index', [
            'langs' => Langs::all(),
            'page_id' => 21,
            'page' => $page,
            'top_menu' => TopMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'bottom_menu' => BottomMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'lang' => $id_Locale->id,
        ]);
    }
    public function giftcard()
    {
        $locale = App::getLocale();
        $id_Locale = Langs::where('locale', mb_strtolower($locale))->first();
        //print_r($id_Locale);
        $page = StaticPage::where(['static_page_id' => 26, 'language_id'=>$id_Locale->id])->first();
        return view('page.index', [
            'langs' => Langs::all(),
            'page_id' => 26,
            'page' => $page,
            'top_menu' => TopMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'bottom_menu' => BottomMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'lang' => $id_Locale->id,
        ]);
    }
    public function pagefaq()
    {
        $locale = App::getLocale();
        $id_Locale = Langs::where('locale', mb_strtolower($locale))->first();
        //print_r($id_Locale);
        $questions = Question::where(['published' => 1 , 'language_id'=>$id_Locale->id])->get();
        //$wwwww = TopMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get();
        //dd($page);
        return view('page.index', [
            'langs' => Langs::all(),
            'page_id' => 'faq',
            'questions' => $questions,
            'top_menu' => TopMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'bottom_menu' => BottomMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'lang' => $id_Locale->id,
        ]);
    }
    /*public function article($seo_link)
    {
        $locale = App::getLocale();
        $id_Locale = Langs::where('locale', mb_strtolower($locale))->first();
        //print_r($id_Locale);
        //$category = Category::where('seo_link', $seo_link)->first();
        return view('blog.article', [
            'langs' => Langs::all(),
            //'category' => $category,
            'article' => Blog::where(['seo_link'=>$seo_link, 'language_id'=>$id_Locale->id])->first(),
            //'ideas' => Blog::where(['published'=>1, 'status'=>1, 'language_id'=>$id_Locale->id])->paginate(100),
        ]);
    }*/

    public function stocks() {
        $locale = App::getLocale();
        $id_Locale = Langs::where('locale', mb_strtolower($locale))->first();
        $page = StaticPage::where(['static_page_id' => 'stocks', 'language_id'=>$id_Locale->id])->first();

        return view('page.stocks', [
            'langs' => Langs::all(),
            'page_id' => 'stocks',
            'page' => $page,
            'top_menu' => TopMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'bottom_menu' => BottomMenu::where(['status' => 1 , 'language_id' => $id_Locale->id])->get(),
            'lang' => $id_Locale->id,
        ]);
    }
    
}
