<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $category = Category::orderBy('cate_order', 'asc')->get();
        $cates = Category::getTree($category, 'id', 'cate_pid', 0);

        //$cates=Category::paginate('10');dd($cates);
        return view('Admin.Category.index', compact(['category','cates']));
    }

    /**
     * Show the form for creating a new resource.
     *u
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cates=Category::where('cate_pid','0')->get();
        return view('Admin.Category.create',compact('cates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data=$this->validate($request,[
            'cate_name' =>'required|min:2',
            'cate_title'     =>'required|min:2',
            'cate_keywords'    =>'required|min:2',
        ]);

        if(Category::create(Input::all())){
            session()->flash('success','添加分类成功');
            return redirect()->route('category.index');
        }else{
            session()->flash('danger','添加分类失败');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Http\Model\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        return view('Admin.Category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Http\Model\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
        $cates=Category::where('cate_pid','0')->get();
        $this->authorize('update',$category);
        return view('Admin.Category.edit',compact(['category','cates']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Model\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $data=$this->validate($request,[
            'cate_name' =>'required|min:2',
            'cate_title'     =>'required|min:2',
            'cate_keywords'    =>'required|min:2',
        ]);

        $category->cate_name=$request->cate_name;
        $category->cate_title=$request->cate_title;
        $category->cate_keywords=$request->cate_keywords;
        $category->cate_pid=$request->cate_pid;

        if($request->cate_description){
            $category->cate_description=$request->cate_description;
        }
        if($request->cate_order){
            $category->cate_order=$request->cate_order;
        }

        if($category->save()){
            session()->flash('success','修改分类成功');
            return redirect()->route('category.index');
        }else{
            session()->flash('danger','修改分类失败');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Http\Model\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
        $this->authorize('delete',$category);
        $category->delete();
        session()->flash('success','删除成功');
        return back();
    }

    //改变分类排序
    public function changeOrder(Request $request,Category $category)
    {
        //
        $category=Category::where('id',$request->id)->first();

        if(!empty($category)){
            $category->cate_order=$request->cate_order;
            if($category->save()){
                $res['msg']='更新排序成功';
                $res['status']=1;
            }else{
                $res['msg']='更新排序失败';
                $res['status']=0;
            }
        }else{
            $res['msg']='非法请求';
            $res['status']=-1;
        }
        return json_encode($res);
    }

}
