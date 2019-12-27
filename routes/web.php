<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\ProductConnection;
use App\AttributeGroupController;
use App\Category;
use App\User; 
use App\Product;
use App\Option;
use App\TopMenu;
use Illuminate\Http\RedirectResponse;

/**********************ADMIN***********************/

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth']], function()
{
Route::get('/', 'DashboardController@dashboard')->name('admin.index');
Route::resource('/category', 'CategoryController', ['as'=>'admin']);
Route::resource('/question', 'QuestionController', ['as'=>'admin']);
Route::resource('/country', 'CountryController', ['as'=>'admin']);
Route::resource('/region', 'RegionController', ['as'=>'admin']);
Route::resource('/blog', 'BlogController', ['as'=>'admin']);
Route::resource('/banner', 'BannerController', ['as'=>'admin']);
Route::resource('/static_page', 'StaticPageController', ['as'=>'admin']);
Route::resource('/bottom_menu', 'BottomMenuController', ['as'=>'admin']);
Route::resource('/top_menu', 'TopMenuController', ['as'=>'admin']);
Route::resource('/idea', 'IdeaController', ['as'=>'admin']);
Route::resource('/product_option', 'ProductOptionController', ['as'=>'admin']);
Route::resource('/option', 'OptionController', ['as'=>'admin']);
Route::resource('/customer_group', 'CustomerGroupController', ['as'=>'admin']);
Route::resource('/user_tag', 'UserTagController', ['as'=>'admin']);
Route::resource('/user_filter', 'UserFilterController', ['as'=>'admin']);
//Route::get('/autocomplete', 'OptionController@autocomplete');
//Route::get('autocomplete', 'OptionController@autocomplete');
//Route::get('/', 'OptionController@autocomplete')->name('admin.index');
Route::get('autocomplete/{filter_name}', function($filter_name) {
    return Category::find($filter_name);
});
Route::get('option/{id}', 'OptionController@show');
/*Route::get('autocomplete', 'OptionController@autocomplete',  function () {
  $content = 1;
  return response($content)->header('Content-Type', $content);
});*/

//Route::resource('/option_description', 'OptionDescriptionController', ['as'=>'admin']);
Route::resource('/product', 'ProductController', ['as'=>'admin']);
Route::resource('/manufacturer', 'ManufacturerController', ['as'=>'admin']);
Route::resource('/attribute_group', 'ProductAttribute\AttributeGroupController', ['as'=>'admin']);
Route::resource('/attribute', 'ProductAttribute\AttributeController', ['as'=>'admin']);


//Route::resource('/product_connection', 'ProductController', ['as'=>'admin']);
//Route::resource('/product_connection', 'ProductConnectionController', ['as'=>'admin']);
//Route::resource('/product_connection', 'ProductConnectionController', ['as'=>'admin']);
//Route::resource('/product_connection', 'ProductConnectionController',['only' => ['index', 'store', 'show', 'destroy', 'getCategoryByProduct']]);
//Route::resource('/getCategoryByProduct/{category}', 'ProductConnectionController', ['as' => 'admin.product_connection.get_category']);


Route::get('/getCategoryByProduct/{product}', function ($product_id) {
    //
          //  ProductDescription::where(['product_id'=>$request['product_id'], 'language_id'=>$language])->update([
        $id=$product_id;
       $choose_connection = ProductConnection::where(['product_id'=>$id])->get();
        //$choose_connection = ProductConnection::find($product_id);
        //dd ( $choose_connection);
       // $temp = ProductConnection::Find($id)->products;

    
        //$connection_count = ProductConnection::where('product_id', $product_id)->get()->count();

        //$choose_category = 
        //for($i=1; $i<=$connection_count; $i++)
       // {
            //$choose_category = Category::where('id', $choose_connection['category_id'])->get();
       // }
          

        return view('admin.product_connections.get_category', [

            //'product_connections' => $productConnection,
            'product_connections' => $choose_connection,
           // 'choose_category' => $choose_category,
            
        ]);
});
/******************************* ГЛУПОСТЬ АВТОРОВ LARAVEL ************************************/
/*Route::get('/admin/product/autocomplete', 'ProductController@autocomplete')-> function(){

        return view('admin.user_managment.users.index',
          [
            'users' => User::paginate(10),
          ]
        );
      }
    );*/
Route::get('/user_managment/user/blabla', 'UserManagment\UserController@blabla')->name('admin.user_managment.user.index'); 
//Route::get('/user_managment/user/autocomplete', 'UserManagment\ProductController@autocomplete')->name('admin.user_managment.user.index'); 
/******************************* END: ГЛУПОСТЬ АВТОРОВ LARAVEL ************************************/
//Route::get('/autocomplete', 'ProductController@autocomplete')->name('admin.product.index');
Route::get('/autocomplete/{filter_name}', function ($filter_name){

  $json = array();

        if (isset($filter_name)) {
            //$this->load->language('catalog/option');

            //$this->load->model('catalog/option');

            //$this->load->model('tool/image');

            $filter_data = array(
                'filter_name' => $filter_name,
                'start'       => 0,
                'limit'       => 5
            );

            $options = Option::getOptions($filter_data);

//dd($options);
//print_r($options);
            
            foreach ($options as $option) {
                $option_value_data = array();
//dd($option);

                if ($option->type == 'select' || $option->type == 'radio' || $option->type == 'checkbox' ) {
                    $option_values = Option::getOptionValues($option->option_id);

                    foreach ($option_values as $option_value) {
                        /*if (is_file(DIR_IMAGE . $option_value['image'])) {
                            $image = $this->model_tool_image->resize($option_value['image'], 50, 50);
                        } else {
                            $image = $this->model_tool_image->resize('no_image.png', 50, 50);
                        }*/

                        $option_value_data[] = array(
                            'option_value_id' => $option_value['option_value_id'],
                            'name'            => strip_tags(html_entity_decode($option_value['name'], ENT_QUOTES, 'UTF-8')),
                            'image'           => $option_value['image']
                        );
                    }

                    $sort_order = array();

                    foreach ($option_value_data as $key => $value) {
                        $sort_order[$key] = $value['name'];
                    }

                    array_multisort($sort_order, SORT_ASC, $option_value_data);
                }

                $type = '';

                if ($option->type == 'select' || $option->type == 'radio' || $option->type == 'checkbox') {
                    $type = 'Выбор';
                }

                if ($option->type == 'text' || $option->type == 'textarea') {
                    $type = 'Поле ввода';
                }
/*
                if ($option['type'] == 'file') {
                    $type = $this->language->get('text_file');
                }

                if ($option['type'] == 'date' || $option['type'] == 'datetime' || $option['type'] == 'time') {
                    $type = $this->language->get('text_date');
                }*/

                $json[] = array(
                    'option_id'    => $option->option_id,
                    'name'         => strip_tags(html_entity_decode($option->name, ENT_QUOTES, 'UTF-8')),
                    'category'     => $type,
                    'type'         => $option->type,
                    'option_value' => $option_value_data
                );
            }
        }

        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        //$this->response()->addHeader('Content-Type: application/json');
        //$this->response()->setOutput(json_encode($json));
        header('Content-Type: application/jsonl');
//return response()->header('Content-Type: application/json')->json(json_encode($json));
return response()->json($json);

       // return response()->json(array('filter_name'=> $filter_name), 200);
      }
    );

Route::post('user/{id}', array('uses' => 'UserManagment\UserController@show'));
/*Route::any('user/{id}', function ($id) {
    return 'User '.$id;
});*/
/*
Route::get('/user_managment/user/blabla', 'UserManagment\UserController@blabla')->name('admin.user_managment.user.index'); /*function()
      {

        return view('admin.user_managment.users.index',
          [
            'users' => User::paginate(10),
          ]
        );
      }*/
    //);
//Route::post('/product_connection','ProductConnectionController@store');
	Route::group(['prefix' => 'user_managment', 'namespace' => 'UserManagment'], function()
	{
    Route::resource('/user', 'UserController', ['as' => 'admin.user_managment']);
    //Route::resource('/blabla', 'UserController@blabla', ['as' => 'admin.user_managment']);
    //Route::get('/user/blabla', 'UserController@blabla')->name('admin.user_managment.user.index');
//Route::get('/user_managment/user/blabla', 'UserController@blabla')->name('admin.user_managment.user.index'); 
		
	});
});

/********************END: ADMIN*********************/

/*********************FRONTEND**********************/
Route::get('lang/{locale}/', function ($locale) { 
$cookie = null;
//array_search
//in_array
if (in_array($locale, Config::get('app.locales'))) {
    $cookie = Cookie::forever('lang', $locale);
    //echo $locale;
}
if ($cookie) {
    //return Redirect::back()->withCookie($cookie);
     return back()->withCookie($cookie);
} 

return back();

});

/*Route::get('lang/{locale}/', 
	function ($locale) { 
    if (in_array($locale, \Config::get('app.locales'))) { 
        Cookie::queue(
        Cookie::forever('lang', $locale)); 
    } 
    return redirect()->back(); 
});*/

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'IndexController@index')->name('index');
//Blog 18.12.2019
Route::get('/blog/category/{seo_link?}', 'BlogController@category')->name('category');
Route::get('/blog/article/{seo_link?}', 'BlogController@article')->name('article');
//END: Blog 18.12.2019
//About 24.12.2019
Route::get('/about', 'PageController@about')->name('about');
Route::get('/contacts', 'PageController@contacts')->name('contacts');
Route::get('/terms_of_sale', 'PageController@termsofsale')->name('terms_of_sale');
Route::get('/shipping_and_payment', 'PageController@shippingandpayment')->name('shipping_and_payment');
Route::get('/partnership', 'PageController@partnership')->name('partnership');
//END: About 24.12.2019
//////////////////////
//Переключение языков
Route::get('setlocale/{lang}', function ($lang) {

    $referer = Redirect::back()->getTargetUrl(); //URL предыдущей страницы
    $parse_url = parse_url($referer, PHP_URL_PATH); //URI предыдущей страницы

    //разбиваем на массив по разделителю
    $segments = explode('/', $parse_url);

    //Если URL (где нажали на переключение языка) содержал корректную метку языка
    if (in_array($segments[1], App\Http\Middleware\LocaleMiddleware::$languages)) {

        unset($segments[1]); //удаляем метку
    } 
    
    //Добавляем метку языка в URL (если выбран не язык по-умолчанию)
    if ($lang != App\Http\Middleware\LocaleMiddleware::$mainLanguage){ 
        array_splice($segments, 1, 0, $lang); 
    }

    //формируем полный URL
    $url = Request::root().implode("/", $segments);
    
    //если были еще GET-параметры - добавляем их
    if(parse_url($referer, PHP_URL_QUERY)){    
        $url = $url.'?'. parse_url($referer, PHP_URL_QUERY);
    }
    return redirect($url); //Перенаправляем назад на ту же страницу                            

})->name('setlocale');
/*******************END: FRONTEND********************/