<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\User;
use App\Http\Model\Blog;
use App\Mail\RegMail;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        //中间件 权限拦截
        $this->middleware('auth',['except'=>
                ['create','store','show',
                    'confirmEmailToken','search','all']
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
        return view('Home.User.index',compact(['users','projects']));
    }

    public function all(Request $request){
        //
        if($request->is_admin){
            $data=User::where('is_admin',$request->is_admin)->get();
            $array = array('msg'=>'成功!','status'=>'true','data'=>$data);
        }else{
            $array = array('msg'=>'失败!','status'=>'false');
        }
        return response()->json($array);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Home.User.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data=$this->validate($request,[
                'name'     =>'required|min:3',
                'email'    =>'required|unique:users|email',
                'password' =>'required|min:5|confirmed',
            ]);
        //bcrypt laravel 自带加密函数
        $data['password']=bcrypt($data['password']);
        //注册用户
        $user=User::create($data);
        // attempt 让用户自动登录
//        \Auth::attempt(['email'=>$request->email,'password'=>$request->password]);
        \Mail::to($user)->send(new RegMail($user));

//        session()->flash('success',' 邮件已发送!');
//        return redirect()->route('home');

        return view('Home.User.regemail');
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Http\Model\User  $user
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

            return view('Home.User.show', compact(['user', 'blogs', 'toggleTitle']));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Http\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
        $this->authorize('update',$user);
        return view('Home.User.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Http\Model\User  $user
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
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Http\Model\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        $this->authorize('delete',$user);

        $user->delete();
        session()->flash('success','删除成功');
        return redirect()->route('user.index');
    }

    //确认邮件的验证
    public function confirmEmailToken($token)
    {
        //给指定用户发送邮件
        $user=User::where('email_token',$token)->first();
        if($user){
            $user->email_active=true;
            $user->save();
            session()->flash('success','验证通过');
            session()->put('user',$user);
            //自动登录
            \Auth::login($user);
            return redirect('/');
        }
        session()->flash('danger','邮箱验证失败');
        return redirect('/');
    }

    public function search(Request $request, User $user)
    {
        $data = User::where('name', 'like', '%'.$request->keywords.'%')->get();

//        dd($data);
        return view('Home.User.index',compact('users'));
    }

    //当前用户对指定用户进行关注和取关
    public function follows(Request $reguerst,User $user)
    {
        if($reguerst->getMethod() != 'POST'){
            return redirect()->route('home');
        }
        $user->followToggle(\Auth::user()->id);

        //检测用户是否关注
        $toggleTitle=($user->isFollow(\Auth::user()->id))?'取消关注':'关注';

        $blogs=$user->blogs()->orderBy('id','desc')->paginate('10');
        return view('Home.User.show',compact(['user','blogs','toggleTitle']));
    }
}
