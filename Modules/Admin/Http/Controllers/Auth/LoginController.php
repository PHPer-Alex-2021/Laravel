<?php

namespace Modules\Admin\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Model\AdminUser;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    //admin后台守卫 Admin_user
    protected function guard()
    {
        return Auth::guard('admin');
    }

    public function showLoginForm()
    {
        return view('admin::auth.login');
    }

    //尝试登录
    protected function attemptLogin(Request $request)
    {
//        if(strtolower($request->captcha) !== strtolower(session()->get('Logincaptcha'))) {
//            return $this->sendFailedLoginResponse($request);//验证码错误
//        }
        return $this->guard()->attempt(
            $this->credentials($request), $request->filled('remember')
        );
    }

    //发送失败响应
    protected function sendFailedLoginResponse(Request $request)
    {
        if(strtolower($request->captcha) !== strtolower(session()->get('Logincaptcha'))) {
            throw ValidationException::withMessages(
                [
                    $this->username() => [trans('auth.captchaFailed')],
                ]
            );
        }else{
            throw ValidationException::withMessages(
                [
                    $this->username() => [trans('auth.failed')],
                ]
            );
        }
    }

    //登录验证
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            'captcha' =>'required',
            'email'    =>'required|email',
            'password' =>'required|min:5',
        ]);
    }

    /**用户退出
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        session()->forget('user');
        session()->flash('success','退出成功');
        return $this->loggedOut($request) ?  : redirect()->route('admin.login');
    }
}
