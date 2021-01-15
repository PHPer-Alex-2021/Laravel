<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\ArtImg;
use Illuminate\Http\Request;
use App\Mail\RegMail;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function test(){
        $arr=\Session::get('restore_acid');
        array_pop($arr);
        \Session::put('restore_acid',$arr);
        dd(\Session::get('restore_acid'));

    }
    /**
     * 首页
     *
     * @return view
     */
    public function home(){
//        $user = User::find(1);
//        \Mail::to($user)->send(new RegMail());

        //with join查询 减少sql查询的次数
        $arts=ArtImg::orderBy('id','desc')->get(['img']);
//        dd($arts);

        return view('home',compact(['arts']));
    }

    /**
     * 处理首页作品的图片
     *
     * @param
     *
     * @return array
     */
    public function json_artData()
    {
        $arts=ArtImg::orderBy('id','desc')->get(['img']);
        if(!empty($arts)){
                $res['msg']='ok';
                $res['data']=$arts;
                $res['status']=1;
        }else{
            $res['msg']='no';
            $res['status']=0;
        }
        return json_encode($res);
    }
}
