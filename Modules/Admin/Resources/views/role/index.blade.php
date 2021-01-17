@extends('admin::layouts.master')
@section('content')
    <div class="card mt-2">
        <div class="card card-table">
            <div class="card-header">
                <button class="btn btn-space btn-primary">角色列表</button>
                <button data-toggle="modal" data-target="#addRole" type="button" class="btn btn-space btn-secondary">
                    添加角色
                </button>
                @component('components.modal',['title'=>'添加角色','id'=>'addRole','url'=>"/admin/role"])
                    <div class="form-group">
                        <label for="">角色名称</label>
                        <input type="text" name="name" id="" class="form-control" placeholder="" value="{{old('name')}} "aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="">角色标识</label>
                        <input type="text" name="title" id="" class="form-control" placeholder="" value="{{old('title')}} "aria-describedby="helpId">
                    </div>
                @endcomponent

            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="table table-success">
                        <tr>
                            <th>编号</th>
                            <th>角色名称</th>
                            <th>角色标识</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="body">
                        @foreach($roles as $role)
                            <tr>
                                <td scope="row">{{$role['id']}}</td>
                                <td scope="row">{{$role['name']}}</td>
                                <td>{{$role['title']}}</td>
                                <td>{{$role['created_at']}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a class="btn btn-space btn-primary" href="{{route('admin.permission',$role['id'])}}">权限</a>
                                        <button data-toggle="modal" data-target="#editRole{{$role['id']}}" type="button" class="btn btn-space btn-secondary">
                                            编辑
                                        </button>
                                        <button class="btn btn-space btn-primary">删除</button>

                                        @component('components.modal',['title'=>'编辑角色','id'=>"editRole{$role['id']}",'method'=>'PUT','url'=>"/admin/role/{$role['id']}"])
                                            <div class="form-group">
                                                <label for="">角色名称</label>
                                                <input type="text" name="name" id="#editRole{{$role['id']}}" class="form-control" placeholder="" value="{{$role['name']}} "aria-describedby="helpId">
                                            </div>
                                            <div class="form-group">
                                                <label for="">角色标识</label>
                                                <input type="text" name="title" id="" class="form-control" placeholder="" value="{{$role['title']}} "aria-describedby="helpId">
                                            </div>
                                        @endcomponent
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
{{--            <div class="card-footer text-muted">--}}
{{--            {{$users->links()}}--}}
{{--            </div>--}}

            <div class="card-footer text-muted">
    {{--            {{ $users->render() }}--}}
                <div style="float:right;letter-spacing: 2px;margin-left:10px;" class="pagi__count">
                    共<b> {{ 323  }}</b> 条数据
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#project').change(function() {
            $.ajax({
                url: "{{route('all')}}",
                type: "post",
                dataType: "json",
                data: {
                    "is_admin": $('#project').val(),
                    '_token': "{{csrf_token()}}"
                },
                success: function (result) {
                    data=result.data;//数据 Object.keys(arr[i]).length

                    var len=eval(data).length;
                    var arr=[];

                    for(var i=0;i<len;i++){
                        arr[i] =[]; //js中二维数组必须进行重复的声明，否则会undefind
                        arr[i]['id']=data[i].id;
                        arr[i]['email']=data[i].email;
                        arr[i]['name']=data[i].name;
                    }

                    console.log(arr);

                    if (result.status == 'true') {

                        console.log(result);

                        $('#body').html(arr);
                        {{--layer.msg(result.msg);--}}
                        {{--location.href = '{{url('ucenter/train')}}';--}}
                    } else {
                        console.log(0);
                        // layer.msg(result.msg);
                        // return false;
                    }
                },
            })
        })
    </script>
@endsection
