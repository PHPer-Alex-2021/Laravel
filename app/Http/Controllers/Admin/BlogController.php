<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Blog;
use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class BlogController extends Controller
{
    public function __construct(){
        //中间件 权限拦截
        $this->middleware('auth',['except'=>[
            'index','show']
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //with join查询 减少sql查询的次数
        $blogs=Blog::orderBy('id','desc')->with('user')->paginate('10');
        return view('Admin.Blog.index',compact(['blogs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.Blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$this->validate($request,[
            'content'     =>'required|min:2|max:160',
        ]);

        //获取当前登录用户的账号信息
        \Auth::user()->blogs()->create($data);

        session()->flash('success',' 博客已发布!');
        return redirect()->route('blogs.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //( $id,Blog $blog)
        return view('Admin.Blog.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
        $this->authorize('update',$blog);
        return view('Admin.Blog.edit',compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
        $data=$this->validate($request,[
            'bContent' =>'required|min:2',
        ]);

        $blog->content=$request->bContent;
        if($blog->save()){
            session()->flash('success','修改博客成功');
            return redirect()->route('blogs.index');
        }else{
            session()->flash('danger','修改博客失败');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //( $id,Blog $blog)
        $this->authorize('delete',$blog);
        $blog->delete();
        session()->flash('success','删除成功');
        return back();
    }

    //后台查看用户的博客
    public function showUserBlogs(User $user)
    {
        //
        $blogs = $user->blogs()->orderBy('id', 'desc')->paginate('10');
        $toggleTitle = '';
        if (\Auth::check())
            //检测用户是否关注
            $toggleTitle = ($user->isFollow(\Auth::user()->id)) ? '取消关注' : '关注';

        return view('Admin.Blog.showUserBlogs', compact(['user', 'blogs', 'toggleTitle']));
    }

}
