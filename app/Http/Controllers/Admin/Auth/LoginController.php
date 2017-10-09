<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;//в пътя на този файл пишем кода за изкачане на това съобщение когато админа не е активен
// return ['email'=>'inactive', 'password'=>'You are not an active person, please contact Admin.']; на ред 60 тук
use App\Model\admin\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
     public function showLoginForm() {


          return view('admin.login');
     }
    
       public function login(Request $request)
    {
        $this->validateLogin($request);
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }
        return $this->sendFailedLoginResponse($request);
    }

    protected function credentials(Request $request) //това се прави за защита. да може се логва само админа които е активен,ако премахнем отметката за статус на някои админ няма да може се логва с полатолата си ,докато не го направим активен.трябва статуса да е 'status'=>1
    {
          $admin = admin::where('email',$request->email)->first();
        if (count($admin)) {
            if ($admin->status == 0) {
                return ['email'=>'inactive','password'=>'You are not an active person, please contact Admin'];
            }else{
                return ['email'=>$request->email,'password'=>$request->password,'status'=>1];
            }
        }
        return $request->only($this->username(), 'password');

    }

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
        //след като сложихме guest:admin' отиваме в  папка app/http/middleware и файла RedirectifAuthenticate.php и пиша swich case
    }

      protected function guard()
    {
        return Auth::guard('admin');
    }
}
