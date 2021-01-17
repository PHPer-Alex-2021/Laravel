<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        //表单唯一值验证技巧
        //排除 数据表中当前记录  通过控制器的依赖注入是一个对象
        $route = $this->route('role');
        $id = $route ? $route->id: null;

        return [
            'title'    => "required|min:1|unique:roles,name,".$id,
            'name'     => "required|min:2|unique:roles,name,".$id,
        ];
    }
    //提示信息
    public function messages()
    {
        return [
            'title.required'  => '角色标识不能为空',
            'title.unique'    => '角色标识已存在',
            'title.min'       => '角色标识至少1个字',

            'name.required'   => '角色名称不能为空',
            'name.unique'     => '角色名称已存在',
            'name.min'        => '角色名称至少2个字',
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
