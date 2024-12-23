<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Region;
use App\Models\Company;
use Illuminate\Auth\Events\Login;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     * 
     */
    protected function create(array $data)
    {        
        
        if(url()->previous() == 'https://vatapp.site/yana/register'){
            $data['reg_by_yana'] = 1;
        }else{
            $data['reg_by_yana'] = 0;
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'reg_by_yana' => $data['reg_by_yana'],
        ]);

        Auth::login($user);   

        $company = Company::create([
            "name" => $data['company'],    
            'user_id'=>$user->id,
            'region'=> $data['region']
        ]);

        $company->User()->attach($user->id);

        $user->update([
            'current_company_id' => $company->id,
        ]);

        event(new Registered($user));

        return $user;
    }
}