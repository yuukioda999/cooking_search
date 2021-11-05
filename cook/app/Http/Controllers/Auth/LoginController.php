<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


     // ゲストユーザー用のユーザーIDを定数として定義
     private const GUEST_USER_ID = 2;

     // ゲストログイン処理
     public function guestLogin()
     {
         // id=1 のゲストユーザー情報がDBに存在すれば、ゲストログインする
         if (Auth::loginUsingId(self::GUEST_USER_ID)) {
             return redirect('/');
         }
 
         return redirect('/');
     }


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/'; 

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


   
    
}
