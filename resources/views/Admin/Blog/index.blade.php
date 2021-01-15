@extends('Admin.Commont.index')
@section('inner_content')
    <div>
        <form action="{{route('blogs.store')}}" method="post">
            @csrf
            <div class="card">
                <div class="card-header">发布文章</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="">内容</label>
                        <input type="text" class="form-control" name="content" value="{{old('content')}}">
                    </div>
                </div>
                <div class="card-footer text-muted"></div>
                <button type="submit" class="btn btn-success">发布</button>
            </div>
        </form>
    </div>
    <div class="card mt-2">
        <div class="card-header">
            文章列表
        </div>
        <a href="{{route('blogs.create')}}" type="button" class="btn btn-success mr-2">
            <i class="fas fa-edit">添加文章</i>
        </a>
        <form action="" method="post">
            @csrf
            <div class="input-group col-lg-5  fa-pull-right"  style="width:30%;margin-top:30px;">
                <input type="text" class="form-control input-lg mr-3" name="keywords">
                <button type="submit" class="input-group-addon btn btn-primary">
                    <i class="fas fa-search">搜索</i>
                </button>
            </div>
        </form>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="table table-success">
                <tr>
                    <th>编号</th>
                    <th>内容</th>
                    <th>作者</th>

                    <th>排序</th>
                    <th>标题</th>
                    <th>审核状态</th>
                    <th>点击</th>
                    <th>更新时间</th>
                    <th>评论</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="body">
                @foreach($blogs as $blog)
                    <tr>
                        <td scope="row">{{$blog['id']}}</td>
                        <td>{{$blog['content']}}</td>
                        <td>
                            <a href="{{route('user.show',$blog)}}"  type="button" class="btn btn-dark mr-2">
                                {{$blog['user']['name']}}
                            </a>
                        </td>
                        <td>{{$blog['order']}}</td>
                        <td>{{$blog['title']}}</td>
                        <td>{{$blog['status']}}</td>
                        <td>{{$blog['click']}}</td>
                        <td>{{$blog['updated_at']}}</td>
                        <td>{{$blog['comment']}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('blogs.show',$blog)}}"  type="button" class="btn btn-info mr-2">
                                    <i class="fas fa-id-card">查看</i>
                                </a>
                                @can('update',$blog)
                                <a href="{{route('blogs.edit',$blog)}}" type="button" class="btn btn-success mr-2">
                                        <i class="fas fa-edit">编辑</i>
                                    </a>
                                @endcan
                                @can('delete',$blog)
                                    <form action="{{route('blogs.destroy',$blog)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-o">删除</i>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted">
            {{ $blogs->render() }}
            <div style="float:right;letter-spacing: 2px;margin-left:10px;" class="pagi__count">
                共<b> {{ 323  }}</b> 条数据
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
