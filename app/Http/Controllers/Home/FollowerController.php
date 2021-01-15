<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FollowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function follow(User $user)
    {
        //with join查询 减少sql查询的次数
        $followers=$user->followers()->paginate('10');
        $title='粉丝';
        $name=\Request::route()->getName();
        return view('Home.Followers.index',compact(['followers','title']));
    }

    public function following(User $user)
    {
        //with join查询 减少sql查询的次数
        $followers=$user->followering()->paginate('10');
        $title='关注';
        $name=\Request::route()->getName();
        return view('Home.Followers.index',compact(['followers','title']));
    }

    //当前用户对指定用户进行关注和取关
    public function follows(Request $reguerst,User $user)
    {
        $user->followToggle(\Auth::user()->id);

        dd(\Request::route()->getName());

        return redirect()->route('follow',$user);
    }
}
