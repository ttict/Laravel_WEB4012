<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getLogin(){
        return view('auth.login');
    }
    public function postLogin(LoginRequest $request){
        if (Auth::attempt(['email' => $request->txtEmail,'password' => $request->txtPass], $request->remember)) {
            $notification = array(
                
            );
            return redirect('admin')->with(['message' => 'Đăng nhập thành công!',
                'alert-type' => 'success']);
        }else{
            return redirect()->back()->withInput()->with(['message' => 'Email hoặc mật khẩu không đúng! Vui lòng nhập lại!',
                'alert-type' => 'error']);
        }
    }
    public function logout(Request $request) {
        $request->session()->flush();
        Auth::logout();
        return redirect('login')->with(['message' => 'Đăng xuất thành công!',
            'alert-type' => 'success']);
    }
}
