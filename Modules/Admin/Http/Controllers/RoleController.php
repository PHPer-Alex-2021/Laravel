<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Model\AdminUser;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Http\Requests\RoleRequest;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
//        $all=app('hd-menu')->all();
//        dd($all);
        $roles=Role::all();
        return view('admin::role.index',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(RoleRequest $request)
    {
        $res=Role::create(['name'=>$request->name,'title'=>$request->title]);
        if($res){
            session()->flash('success','角色添加成功');
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(RoleRequest $request,Role $role)
    {

        $res=$role->update(['name'=>$request->name,'title'=>$request->title]);
        if($res){
            session()->flash('success','角色修改成功');
        }else{
            session()->flash('danger','角色修改失败');
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    /**
     *
     * @return Response
     */
    public function permission(Role $role)
    {
//        dd($role->toArray());

        return view('admin::role.permission',compact('role'));
    }

}
