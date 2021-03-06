<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Shop;
use App\Setting;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Auth;

use Illuminate\Support\Facades\DB;

use Category;

use View;
//use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/'; // wczesniej bylo home

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $category = DB::table('categories')->where('status_kategorii','1')->get();
        
           View::share('categories', $category);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
     // protected
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
            // 'role_id' => 1
        ]);
// Uzytkownik dodany

        $shop = Shop::create([
             'nazwa_sklepu' => $data['name']
        ]);

        $user->shop()->save($shop);

// sklep dodany wraz z uzytkownikiem 

$setting = Setting::create([
// 'nazwa_firmy' => 'test'
]);

$user->setting()->save($setting);

// Ustawienia dodane wraz z uzytkownikiem
 
         return $user;
    }
}
