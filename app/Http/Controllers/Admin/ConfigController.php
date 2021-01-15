<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $confs = Config::orderBy('conf_order', 'asc')->get();
        foreach($confs as $k=>$v){
            switch($v['conf_type']){
                case 1: //单行文本
                    $confs[$k]->_html='<input class="lg" name="conf_content[]" value="'.$v->conf_content.'">';
                    break;
                case 2: //1|开启,0|关闭
                    $arr=explode(',',$v->conf_values);
                    $str='';
                    foreach($arr as $m=>$n){
                        $r=explode('|',$n);
                        $c='';
                        if($v->conf_content == $r[0]){
                            $c=' checked ';
                        }
                        $str.='<input type="radio" class="lg" name="conf_content[]" value="'.$r[0].'"'.$c.' >'.$r[1].' ';
                    }
                    //echo $str;
                    $confs[$k]->_html=$str;
                    break;//单选
                case 3: //文本域
                    $confs[$k]->_html='<textarea class="form-control" name="conf_content[]" id="" rows="3">
                        '.$v->conf_content.'</textarea>';
                    break;
            }
        }
        return view('Admin.Config.index',compact('confs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Admin.Config.create');
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
            'conf_title'    =>'required|min:2',
            'conf_name'    =>'required|min:2',
            'conf_type'    =>'required',
        ]);
        $input=Input::all();
        if(Input::get('conf_type')!=2){
            $input['conf_content']='';
        }
        if($input['conf_type']==2){
            $input['conf_values']=$input['conf_content'];
        }
        if(empty(Input::get('conf_order'))){
            $input['conf_order']='';
        }

        if(Config::create($input)){
            session()->flash('success','添加配置成功');
            return redirect()->route('config.index');
        }else{
            session()->flash('danger','添加配置失败');
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($config)
    {
        //
        return view('Admin.Config.show', compact('config'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Config $config)
    {
        //
        $this->authorize('update',$config);
        return view('Admin.Config.edit',compact(['config']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Config $config)
    {
        //
        $data=$this->validate($request,[
            'conf_title'    =>'required|min:2',
            'conf_name'    =>'required|min:2',
            'conf_type'    =>'required',
        ]);

        $config->conf_title=$request->conf_title;
        $config->conf_name=$request->conf_name;
        $config->conf_type=$request->conf_type;

        if(empty($request->conf_content)){
            $request->conf_content='';
        }

        if($request->conf_type==2){
            $config->conf_content=$request->conf_content;
        }
        if($request->conf_order){
            $config->conf_order=$request->conf_order;
        }

        if($config->save()){
            session()->flash('success','修改配置成功');
            return redirect()->route('config.index');
        }else{
            session()->flash('danger','修改配置失败');
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Config $config)
    {
        $this->authorize('delete',$config);
        $config->delete();
        session()->flash('success','删除成功');
        return back();
    }
}
