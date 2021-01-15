<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        //中间件 权限拦截
        $this->middleware('auth',['except'=>
            ['create','store']
        ]);
        //中间件 只有游客可以跳转到注册
        $this->middleware('guest',['only'=>
            ['create','store']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $projects= \DB::table('users')
            ->select('is_admin')
            ->groupBy('is_admin')
            ->get();

        $users=User::paginate('10');
        return view('Admin.User.index',compact(['users','projects']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        $blogs = $user->blogs()->orderBy('id', 'desc')->paginate('10');
        $toggleTitle = '';
        if (\Auth::check())
            //检测用户是否关注
            $toggleTitle = ($user->isFollow(\Auth::user()->id)) ? '取消关注' : '关注';

        return view('Admin.User.show', compact(['user', 'blogs', 'toggleTitle']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $this->authorize('update',$user);
        return view('Admin.User.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        $this->validate($request,[
            'name'     =>'required|min:3',
            'password' =>'nullable|min:5|confirmed',
        ]);
        if($request->password){
            $user->password=bcrypt($request->password);
        }
        $user->name=$request->name;
        $user->save();

        session()->flash('success','修改成功');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $user->delete();
        session()->flash('success','删除成功');
        return redirect()->route('users.index');
    }
}
