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

Route::group(['prefix'=>'admin', 'namespace'=>'Admin', 'middleware'=>['auth']], function(){
Route::get('/', 'DashboardController@dashboard')->name('admin.index');
Route::resource('/category', 'CategoryController', ['as'=>'admin']);
Route::resource('/question', 'QuestionController', ['as'=>'admin']);
Route::resource('/country', 'CountryController', ['as'=>'admin']);
Route::resource('/region', 'RegionController', ['as'=>'admin']);
Route::resource('/blog', 'BlogController', ['as'=>'admin']);
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
Route::get('/user_managment/user/blabla', 'UserManagment\UserController@blabla')->name('admin.user_managment.user.index'); 
/******************************* END: ГЛУПОСТЬ АВТОРОВ LARAVEL ************************************/

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
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
