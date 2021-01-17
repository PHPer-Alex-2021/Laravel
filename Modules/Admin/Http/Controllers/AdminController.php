<?php

namespace Modules\Admin\Http\Controllers;

use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    //后台首页
    public function index()
    {
//        dd(app('hd-menu')->all());
        return view('admin::Index.index');
    }

    //生成验证码
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
}
