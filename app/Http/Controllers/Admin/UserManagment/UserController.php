<?php

namespace App\Http\Controllers\Admin\UserManagment;

use App\User;
use App\Country;
use App\Region;
use App\CustomerGroup;
use App\UserTag;
use App\Langs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.user_managment.users.index', [
            'users' => User::paginate(10)
        ]);
    }
/******************************* ГЛУПОСТЬ АВТОРОВ LARAVEL ************************************/

    public function blabla()
    {
        return view('admin.user_managment.users.index', [
            'users' => User::paginate(10)
        ]);
    }
/******************************* END: ГЛУПОСТЬ АВТОРОВ LARAVEL ************************************/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user_managment.users.create', [
            'users' => [],
            //'countries' => Country::where('language_id', 1)->get(),
            'countries' => Country::get(),
            'regions' => Region::get(),
            'customer_groups' => CustomerGroup::get(),
            'user_tags' => UserTag::get(),
            'langs' => Langs::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'index_address' => 'required|string|max:255',
            'country' => 'required',
            'region' => 'required',
            'customer_group_id' => 'integer',
            'user_tag_id' => 'integer',
            'language_id' => 'integer',
        ]);

       /*$validator = $request->validate ([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'index_address' => 'required|string|max:255',
            'country' => 'required',
            'regions' => 'required',
        ]);*/


        User::create([
            'name' => $request['name'],
            'surname' => $request['surname'],
            'email' => $request['email'],
            'password' => md5($request['password']),
            'phone' => $request['phone'],
            'address' => $request['address'],
            'city' => $request['city'],
            'index_address' => $request['index_address'],
            'country' => $request['country'],
            'region' => $request['region'],
            'customer_group_id' => $request['customer_group_id'],
            'user_tag_id' => $request['user_tag_id'],
            'user_sex_id' => $request['user_sex_id'],
            'language_id' => $request['language_id'],

            
        ]);
        return redirect()->route('admin.user_managment.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user_managment.users.edit', [
            'user' => $user,
            'countries' => Country::get(),
            'regions' => Region::get(),
            'customer_groups' => CustomerGroup::get(),
            'user_tags' => UserTag::get(),
            'langs' => Langs::get(),

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                \Illuminate\Validation\Rule::unique('users')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:6|confirmed',
            'phone' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string|max:255',
            'index_address' => 'required|string|max:255',
            'country' => 'required',
            'region' => 'required',
            'customer_group_id' => 'integer',
            'user_tag_id' => 'integer',
            'language_id' => 'integer',
        ]);

        $user->name = $request['name'];
         $user->surname = $request['surname'];
          $user->email = $request['email'];
           $request['password'] == null ?: $user->password = md5($request['password']);
            $user->phone = $request['phone'];
             $user->address = $request['address'];
              $user->city = $request['city'];
               $user->index_address = $request['index_address'];
                $user->country = $request['country'];
                 $user->region = $request['region'];
                 $user->customer_group_id = $request['customer_group_id'];
                 $user->user_tag_id = $request['user_tag_id'];
                 $user->user_sex_id = $request['user_sex_id'];
                 $user->language_id = $request['language_id'];
        $user->save();
        
        return redirect()->route('admin.user_managment.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user_managment.user.index');
    }
}
