<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    */
    public function login()
    {
        //
        return view('Home.Login.login');
    }

    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'email'    =>'required|email',
            'password' =>'required|min:5',
        ]);
        $user=User::where('email',$request->email)->first(['name','id','email_active']);
        if(!empty($user)){
            if(!$user->email_active){
                session()->flash('danger','邮件待激活!');
                return redirect('/');
            }
            if(\Auth::attempt($data)){
                //助手函数
                session(['user'=>$user]);

                //Session对象
//              \Session::put('user',$user);

                //助手函数 Session对象 (混合)
//              session()->put('user',$user);

                //助手函数 Session对象 (混合) 闪存数据
//                \Session::flash('success','登录成功!');
                session()->flash('success','登录成功!');
//return \Session::all());

                return redirect('/');
            }
            session()->flash('danger','密码错误!');
            return back();
        }else{
            session()->flash('danger','您还没注册,请先注册!');
            return redirect()->route('user.create');
        }
    }

    public function logout()
    {
        //
        \Auth::logout();
        \Session::forget('user');
        session()->flash('success','退出成功');
//dd(\Session::all());

        return redirect()->route('home');
    }
}
