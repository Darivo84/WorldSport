<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    protected $loginPath = '/login'; 
    protected $redirectPath = '/dashboard';
    

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    //Custom function to check user status
    public function getCredentials(Request $request)
    {
        $credentials = $request->only($this->loginUsername(), 'password');

        //var_dump($request); exit;

        // if(isset($request->form) && !empty($request->form)) {

        //     if($request->form == 'mt')
        //         $form = 'motor-theft';
        //     else if ($request->form == 'pl')
        //         $form = 'property-loss';
        //     else if ($request->form == 'ma')
        //         $form = 'motor-accident';

        //    $url = '/dashboard/'. $form .'/view/'.$request->id;

        //    //return new RedirectResponse($url);
        // } 
        // //else {
           return array_add($credentials, 'status', 'active'); 
        //}        
         
    }
}
