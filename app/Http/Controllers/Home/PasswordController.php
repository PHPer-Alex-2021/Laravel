<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Mail\ForgerMail;
use App\Notifications\findPasswordNotify;
use Illuminate\Notifications\Notification;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    //
    public function forgetPasswordByEmail()
    {
        //
        return view('Home.Password.forgetPasswordByEmail');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Request $request)
    {
        //
        $this->validate($request,[
            'email'     => 'required',
            'password' =>'required|min:5|confirmed',
        ]);
        $user=User::where('email',$request->email)->first();

        if($user){
            $user->password=bcrypt($request->password);
            $user->email=$request->email;
            \Mail::to($user)->send(new ForgerMail($user));

            session()->flash('success','请查看邮箱!');
            return redirect()->route('home');
        }

        session()->flash('danger','请先注册!');
        return redirect()->route('user.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function setNewPassword(Request $request)
    {
        //
        $user=User::where('email',$request->email)->first();
        if($user){
            $user->password=bcrypt($request->password);
            $user->save();

            session()->flash('success', '密码修改成功');
            return redirect()->route('home');
        }
        session()->flash('danger', '密码修改失败');
        return redirect()->route('home');
    }

    public function email(){
        return view('Home.Password.email');
    }
    public function send(Request $request){
        $user=User::where('email',$request->email)->first();
        \Notification::send($user,new findPasswordNotify($user->email_token));
        return view('Home.Password.sendemail');
    }
    public function edit($token){
        $user=$this->getUserByToken($token);
        return view('Home.Password.edit',compact('user'));
    }
    public function update(Request $request){
        $this->validate($request,[
            'email'     => 'required',
            'password' =>'required|min:5|confirmed',
        ]);

        $user=$this->getUserByToken($request->token);
        if($user){
            $user->password=bcrypt($request->password);
            $user->save();

            session()->flash('success', '密码修改成功!');
            return redirect()->route('login');
        }
        session()->flash('danger', '密码修改失败');
        return redirect()->route('home');
    }

    //通过 token 获取用户
    public function getUserByToken($token){
        return User::where('email_token',$token)->first();
    }
}
