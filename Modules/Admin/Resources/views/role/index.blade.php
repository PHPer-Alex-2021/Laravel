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
                        <label for="">用户名</label>
                        <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                    <div class="form-group">
                        <label for="">描述</label>
                        <input type="text" name="desc" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    </div>
                @endcomponent

{{--                <form action="{{route('search')}}" method="post">--}}
{{--                    @csrf--}}
{{--                    <div class="input-group col-lg-5  fa-pull-right"  style="width:30%;margin-top:30px;">--}}
{{--                        <input type="text" class="form-control input-lg mr-3" name="keywords">--}}
{{--                        <button type="submit" class="input-group-addon btn btn-primary">--}}
{{--                            <i class="fas fa-search">搜索</i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
{{--                </form>--}}
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead class="table table-success">
                        <tr>
                            <th>编号</th>
                            <th>昵称</th>
                            <th>邮箱</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="body">
                        @foreach($users as $user)
                            <tr>
                                <td scope="row">{{$user['id']}}</td>
                                <td scope="row">{{$user['name']}}</td>
                                <td>{{$user['email']}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="{{route('users.show',$user)}}"  type="button" class="btn btn-info mr-2">
                                            <i class="fas fa-id-card">查看</i>
                                        </a>
                                        @can('update',$user)
                                            <a href="{{route('users.edit',$user)}}" type="button" class="btn btn-success mr-2">
                                            <i class="fas fa-edit">编辑</i>
                                            </a>
                                        @endcan
                                        @can('delete',$user)
                                            <form action="{{route('users.destroy',$user)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">删除</button>
                                            </form>
                                        @endcan
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
