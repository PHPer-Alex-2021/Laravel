<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Http\Model\User;
use Illuminate\Http\Request;

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
        return view('Home.Blog.index',compact(['blogs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Home.Blog.create');
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
        $data=$this->validate($request,[
            'content'     =>'required|min:2|max:160',
        ]);

        \Auth::user()->blogs()->create($data);

        session()->flash('success',' 博客已发布!');
        return redirect()->route('blog.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
        return view('Home.Blog.show',compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
        $this->authorize('delete',$blog);
        $blog->delete();
        session()->flash('success','删除成功');
        return back();
    }
}
