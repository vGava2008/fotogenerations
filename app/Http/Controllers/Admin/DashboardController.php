<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Category;
use App\Question;
use App\Country;
use App\Langs;
use App\Region;
use App\Blog;
use App\Idea;
use App\ProductOption;
use App\Option;
use App\OptionDescription;
use App\Product;
use App\Manufacturer;
use App\AttributeGroup;
use App\Attribute;
use App\Banner;
use App\TopMenu;
use App\BottomMenu;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //Dashboard
    public function dashboard(){

    	$users_count = User::count();
        //AttributeGroupDescription::where(['language_id'=>1])->get()
       //$categories_count = Category::count();
    	$categories_count = Category::where(['language_id'=>1])->count();
    	$questions_count = Question::count();
    	$countries_count = Country::count();
    	$langs_count = Langs::count();
    	$regions_count = Region::count();
        $blogs_count = Blog::where(['language_id'=>1])->count();
        $ideas_count = Idea::count();
        $product_options_count = ProductOption::count();
        $options_count = OptionDescription::where(['language_id'=>1])->count();
        $option_descriptions_count = OptionDescription::count();
        $banners_count = Banner::count();
    	$products_count = Product::count();
        $manufacturers_count = Manufacturer::count();
        $attributes_group = AttributeGroup::count();
        $attributes = Attribute::count();
        $top_menus = TopMenu::where(['language_id'=>1])->count();
        $bottom_menus = BottomMenu::where(['language_id'=>1])->count();
    	return view('admin.dashboard', [
            'users_count' => $users_count, 'categories_count' => $categories_count, 'questions_count' => $questions_count, 'countries_count' => $countries_count, 'langs_count' => $langs_count, 'regions_count' => $regions_count, 'blogs_count' => $blogs_count, 'ideas_count' => $ideas_count, 'product_options_count' => $product_options_count, 'options_count' => $options_count, 'option_descriptions_count' => $option_descriptions_count, 'products_count' => $products_count, 'manufacturers_count' => $manufacturers_count, 'attributes_group' => $attributes_group, 'attributes' => $attributes, 'banners_count' => $banners_count, 'top_menus' => $top_menus, 'bottom_menus' => $bottom_menus,
        ]);
    }
}
