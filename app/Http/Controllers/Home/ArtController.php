<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Art;
use App\Http\Model\ArtImg;
use App\Http\Model\ArtComment;

use App\Http\Requests\ArtAddForm;
use Illuminate\Http\Request;
//自定义函数库
use App\Http\Common as CommonFunction;
use Barryvdh\Debugbar\Facade as DebugBar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use MongoDB\Driver\Session;

class ArtController extends Controller
{
    public function __construct(){
        //中间件 权限拦截
        $this->middleware('auth',['except'=>
            ['create','store','show',]
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        with预加载 提前关联执行 (减少sql查询的次数)
//        $arts=Art::orderBy('id','desc')->paginate('2');
//        if(true){
//            $arts=$arts->load(['user:id,name',]);
//            return $arts->loadCount('artImgs');
//        }

        $arts=Art::with(['user:id,name',])->orderBy('id','desc')->paginate('2');

        //手工关闭
        //DebugBar::disable();
        foreach($arts as $art){
//            DebugBar::info($art->title);
//            DebugBar::info($art->toJson());
//            DebugBar::info($art->toArray());
            DebugBar::info($art->user->name);
        }

        return view('Home.Art.index',compact(['arts']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
//        return view('Home.Art.create');
        return view('Home.Art.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Common  $CommonFunction  依赖注入自定义公共函数库 无需new
     * @return \Illuminate\Http\Response
     */
//    public function store(Request $request,CommonFunction $CommonFunction)
    public function store(ArtAddForm $request,CommonFunction $CommonFunction)
    {
        $request->validated();
        $temp=$request->all();

        $file = $request->file('arts_imgs');
        if(!is_array($file)){
            if ($file->isValid()) {

                // 获取文件相关信息
                $originalName = $file->getClientOriginalName(); // 文件原名
                $ext = $file->getClientOriginalExtension();     // 扩展名
                $realPath = $file->getRealPath();   //临时文件的绝对路径
                $type = $file->getClientMimeType();     // image/jpeg
                if(!in_array($ext,['jpg','jpeg','gif','png']) ) return false;
                // 上传文件
                $filename = date('YmdHis').'-' . uniqid() . '.' . $ext;
                // 使用我们新建的uploads本地存储空间（目录）
                //这里的uploads是配置文件的名称

                //把临时文件移动到指定的位置，并重命名
                $path = public_path().DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'artsImg'.DIRECTORY_SEPARATOR.date('Y').DIRECTORY_SEPARATOR.date('m').DIRECTORY_SEPARATOR.date('d').DIRECTORY_SEPARATOR;

                $bool =  $file->move($path,$filename);
//                dd($filename);
                if($bool){
                    $temp['imgs_path'][]=date('Y').'/'.date('m').'/'.date('d').'/'.$filename;
                }else{
                    return false;
                }
            }
        }else {
            foreach ($file as $files) {
                if ($files->isValid()) {
                    // 获取文件相关信息
                    $originalName = $files->getClientOriginalName(); // 文件原名
                    $ext = $files->getClientOriginalExtension();     // 扩展名
                    $realPath = $files->getRealPath();   //临时文件的绝对路径
                    $type = $files->getClientMimeType();     // image/jpeg

                    if (!in_array($ext, ['jpg', 'jpeg', 'gif', 'png'])) {
                        return false;
                    }

                    // 上传文件
                    $file_name = date('YmdHis').'-'.uniqid().'.'.$ext;
                    // 使用我们新建的uploads本地存储空间（目录）
                    //这里的uploads是配置文件的名称

                    //把临时文件移动到指定的位置，并重命名
                    $path = public_path(
                        ).DIRECTORY_SEPARATOR.'uploads'.DIRECTORY_SEPARATOR.'artsImg'.DIRECTORY_SEPARATOR.date(
                            'Y'
                        ).DIRECTORY_SEPARATOR.date('m').DIRECTORY_SEPARATOR.date('d');
                    $bool = $files->move($path, $file_name);
                    if ($bool) {
                        $temp['imgs_path'][]=date('Y').'/'.date('m').'/'.date('d').'/'.$file_name;
                    } else {
                        return false;
                    }
                }
            }
        }

        $imgs=$temp['imgs_path'];
        $temp=$CommonFunction->array_remove_by_key($temp,'imgs_path');

        $data['title']= $temp['arts_title'];
        $data['content']= $temp['arts_desc'];

//        dd($data);

        //获取新增作品的编号
        $art_id=\Auth::user()->arts()->create($data)->id;

        if($art_id){
            $res=[];
            foreach($imgs as $key=>$val){
                $res[$key]['img']=$val;
                $res[$key]['art_id']=$art_id;
            }
//dd($res);

            foreach ($res as $va) {
                if (ArtImg::create($va)){
                    session()->flash('success', ' 作品已发布!');
                }else{
                    session()->flash('error', ' 作品发布失败!');
                }
            }
        }
        return redirect()->route('art.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Http\Model\Art  $art
     * @return \Illuminate\Http\Response
     */
    public function show(Art $art)
    {
        //
        $art['imgs']=$art->artImgs()->orderBy('id', 'desc')->get();
//dd($art);
        return view('Home.Art.show',compact('art'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Http\Model\Art  $art
     * @return \Illuminate\Http\Response
     */
    public function edit(Art $art)
    {
        $art['imgs']=ArtImg::where('art_id',$art['id'])->get(['img']);
        $this->authorize('update',$art);

        return view('Home.Art.edit',compact('art'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Http\Model\Art  $art
     * @param  \App\Http\Common  $CommonFunction  依赖注入自定义公共函数库 无需new
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Art $art,CommonFunction $CommonFunction)
    {
        //
        $data=$this->validate($request,[
            'title' =>'required|min:2',
            'bcontent' =>'required|min:2',
            'arts_imgs'=>'required'
        ]);

        $file = $request->file('arts_imgs');

        $data=$this->upload($file);

        $imgs=$data['imgs_path'];
        $data=$CommonFunction->array_remove_by_key($data,'arts_imgs');
        $data=$CommonFunction->array_remove_by_key($data,'imgs_path');

        $art->content=$request->bcontent;
        $art->title=$request->title;
        $id=$art->id;

        if($art->save() && ArtImg::where('art_id',$art['id'])->delete()){
            $res=[];
            foreach($imgs as $key=>$val){
                $res[$key]['img']=$val;
                $res[$key]['art_id']=$art['id'];
            }
//dd($res);
            foreach ($res as $va) {
                if (ArtImg::create($va)){
                    session()->flash('success', ' 作品修改成功!');
                    return redirect()->route('art.index');
                }else{
                    session()->flash('error', ' 作品修改失败!');
                    return back();
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Http\Model\Art  $art
     * @param  \App\Http\Common  $CommonFunction  依赖注入自定义公共函数库 无需new
     * @return \Illuminate\Http\Response
     */
    public function destroy(Art $art,CommonFunction $CommonFunction)
    {
        //
        $this->authorize('delete',$art);

        //删除服务器上指定作品的图片
        $imgs=ArtImg::where('art_id',$art['id'])->get(['img'])->toArray();

        $res=$CommonFunction->removeFile($imgs,'./uploads/artsImg/','img');

        //如果作品下有评论
        if(!empty($art->artComments()->get())){
            //关联删除数据库中指定作品以及图片的记录
            if( $art->delete() && $art->artImgs()->delete() && $art->artComments()->delete() && $res['status']==1){
                session()->flash('success','删除成功');
            }
        }else{
            if( $art->delete() && $art->artImgs()->delete() && $res['status']==1){
                session()->flash('success','删除成功');
            }
        }
        return redirect()->route('art.index');
    }

    /**
     * 显示艺术作品下的评论.
     *
     * @param  艺术品的编号  $id
     * @return \Illuminate\Http\Response
     */
    public function artCommentList($id)
    {
        $comments=ArtComment::orderBy('id','desc')->with('user')->with('art')->where('art_id',$id)
            ->paginate('10');
//dd($comments);
        $art_id=$id;
        $title=Art::where('id',$id)->get(['title'])->toArray();
//dd(\Session::get('restore_acid'));

        return view('Home.Art.commentList',compact(['art_id','comments','title']));
    }

    /**
     * 艺术作品发布评论显示页.
     *
     * @param  艺术品的编号  $id
     * @return \Illuminate\Http\Response
     */
    public function artComment($id)
    {
        $art=Art::find($id);
//dd($art);
        return view('Home.Art.comment',compact('art'));
    }

    /**
     * 艺术作品发布评论添加操作.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function artCommentStore(Request $request)
    {
        $art_id=$request->art_id;
        $art=Art::find($art_id);
//        dd($art);

        //手动创建验证  自定义
        $validator=Validator::make($request->post(),[
            'arts_comment'     =>'required|min:2|max:200',
        ]);

        $one=ArtComment::where(['art_id'=>$art_id,'comment'=>$request->arts_comment,'user_id'=>\Session::get('user')['id']])->first();

        //附加回调添加更多的自定义错误信息
        //验证钩子
        if (!empty($one)) {
            $validator->after(
                function ($validator) {
                    $validator->errors()->add('arts_comment', '30分钟之内只能发表一次相同评论!!!');
                }
            );
        }

        //$validator 错误对象   withInput() 原始数据
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        };

        $data['user_id']=session()->get('user')['id'];
        $data['art_id']=$art_id;
        $data['comment']=$request->arts_comment;

        $res=$art->artComments()->firstOrCreate($data);

        if($res){
            session()->flash('success',' 评论发布成功!');
            return redirect("/artCommentList/$art_id");
        }else{
            session()->flash('error',' 评论发布失败!');
        }
    }

    /**
     * 显示艺术作品下指定评论.
     *
     * @param  艺术品的编号  $id
     * @return \Illuminate\Http\Response
     */
    public function artCommentShow($id)
    {
        $comment=ArtComment::with('art')->with('user')->find($id);

        return view('Home.Art.commentShow',compact(['comment']));
    }

    /**
     * 修改艺术作品下指定评论.
     *
     * @param  艺术品的编号  $id
     * @return \Illuminate\Http\Response
     */
    public function artCommentEdit($id)
    {
        $artComment=ArtComment::find($id);
        $this->authorize('delete',$artComment);

        return view('Home.Art.commentEdit',compact('artComment'));
    }

    /**
     * 修改艺术作品下指定评论.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function artCommentUpdate(Request $request)
    {
        $validate=$this->validate($request,[
            'ac_id' =>'required',
        ]);

        $id=$request->ac_id;

        //先限定用户
//        $artComment = ArtComment::find($id);
        $artComment=ArtComment::with('art')->find($id);

        $art_id=$artComment['art']['id'];
//
        if(!empty($request->acContent)){
            $artComment->comment=$request->acContent;
//        给这个用户关联的 art 新增一条记录 //art_id 会自动写入
//            if($artComment->art()->save()){
            if($artComment->save()){
                session()->flash('success','修改成功');
                return redirect("/artCommentList/$art_id");
            }else{
                session()->flash('error','修改失败');
                return back();
            }
        }
        return redirect("/artCommentList/$art_id");
    }

    /**
     * 删除艺术作品下指定评论.
     *
     * @param  艺术品的编号  $id
     * @return \Illuminate\Http\Response
     */
    public function artCommentDel($id)
    {
        $artComment=ArtComment::find($id);

        $this->authorize('delete',$artComment);

        $aid=$artComment['art_id'];
        if($artComment->delete()){
//            \Session::put('restore_acid',$id);
            \Session::push('restore_acid',$id);

            session()->flash('success','删除成功');
            return back();
        }else{
            session()->flash('error','删除失败');
            return back();
        }
    }

    /**
     * 撤销刚刚对艺术作品下指定评论的所有操作,使所有数据恢复正常(类似从回收站还原)
     *
     * @param  艺术品的编号  $id
     * @return \Illuminate\Http\Response
     */
    public function artCommentDelRestore($acids)
    {
        $acids=explode(',',$acids);

        foreach($acids as $acid){
            $artComment=ArtComment::onlyTrashed()->find($acid);
            $artComment->restore();

            $getArtId=ArtComment::find($acid);
            $art_id=$getArtId->art_id;
            \Session::forget('restore_acid');
        }

        return redirect("/artCommentList/$art_id");
    }

    /**
     * 撤销刚刚对艺术作品下指定评论的最近操作,使最近删除的数据恢复正常(类似从回收站还原)
     *
     * @param  艺术品的编号  $id
     * @return \Illuminate\Http\Response
     */
    public function artCommentDelRestoreRec($acid)
    {
        $artComment=ArtComment::onlyTrashed()->find($acid);
        $artComment->restore();

        $getArtId=ArtComment::find($acid);
        $art_id=$getArtId->art_id;
        $arr=\Session::get('restore_acid');
        array_pop($arr);
        \Session::put('restore_acid',$arr);

        return redirect("/artCommentList/$art_id");
    }
}
