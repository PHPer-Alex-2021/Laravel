<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    //后台用户登录
    public function login(){
        return view('Admin.login');
    }

    //后台用户注册
    public function register(){
        return view('Admin.Auth.register');
    }

    public function captcha($tmp)
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 200, $height = 50, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session()->put('Logincaptcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    public function adminLoginStore(Request $request)
    {
        $data=$this->validate($request,[
            'captcha' =>'required',
            'email'    =>'required|email',
            'password' =>'required|min:5',
        ]);
        unset($data['captcha']);
        $builder =(new CaptchaBuilder)->build();
        $Logincaptcha=session()->get('Logincaptcha');

        if(strtolower($request->captcha) !== strtolower($Logincaptcha)) {
            if(\Auth::attempt($data)){
                $user=User::where('email',$request->email)->first();
                if(!$user->email_active){
                    session()->flash('danger','邮件待激活!');
                    return redirect('/');
                }
                session()->put('user',$user['name']);
                session()->flash('success','登录成功!');
//                return redirect()->route('adminIndex');
                return redirect()->route('adminIndex');
            }
            session()->flash('danger','账号或密码错误!');
            return back();
        }else{
            session()->flash('danger','验证码错误!');
            return back();
        }
    }

    //用户退出
    public function logout()
    {
        //
        \Auth::logout();
        session()->forget('user.name');
        session()->flash('success','退出成功');
        return redirect()->route('superLogin');
    }

    public function updatePwd()
    {
        //        $this->authorize('update',$user);

        return view('Admin.User.updatePwd');
    }

    //修改密码
    public function updatePwdStore(Request $request)
    {
        $user=User::where('name',session()->get('user'))->first();
        if($user['is_admin']===0){
            session()->put('user','');
            return redirect()->route('adminLogin');
        }
        //
        $this->validate($request,[
            'email'    =>'required|email',
            'password' =>'nullable|min:5|confirmed',
        ]);
        $user=User::where('email',$request->email)->first();

        if($request->password){
            $user->password=bcrypt($request->password);
        }
        $user->save();

        session()->flash('success','修改成功');
        return redirect()->route('adminIndex');
    }

    /**
     * 文件上传
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadPic(Request $request)
    {
        //
        $file = $request->file('photo');
        // 验证
        $check = $this->checkFile($file);
        if(!$check['status']){
            return response()->json(['ServerNo' => '400','ResultData' => $check['msg']]);
        }
        // 获取文件路径
        $transverse_pic = $file->getRealPath();
        // public路径
        $path = public_path('uploads');
        // 获取后缀名
        $postfix = $file->getClientOriginalExtension();
        // 拼装文件名
        $fileName = md5(time().rand(0,10000)).'.'.$postfix;
        // 移动
        if(!$file->move($path,$fileName)){
            return response()->json(['ServerNo' => '400','ResultData' => '文件保存失败']);
        }
        // 这里处理 数据库逻辑
        /**
         *Store::uploadFile(['fileName'=>$fileName]);
         **/
        return response()->json(['ServerNo' => '200','ResultData' => $fileName]);
    }

    private function checkFile($file)
    {
        if (!$file->isValid()) {
            return ['status' => false, 'msg' => '文件上传失败'];
        }
        if ($file->getClientSize() > $file->getMaxFilesize()) {
            return ['status' => false, 'msg' => '文件大小不能大于2M'];
        }
        return ['status' => true];
    }
}
