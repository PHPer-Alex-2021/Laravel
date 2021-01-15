@extends('Home.Layouts.default')
@section('content')
    <div class="card mt-2">
        <div class="card-header">
            作品列表
        </div>
        <a href="{{route('art.create')}}" type="button" class="btn btn-success mr-2">
            <i class="fas fa-edit">添加</i>
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
                        <th>名称</th>
                        <th>作者</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="body">
                    @foreach($arts as $art)
                        <tr>
                            <td scope="row">{{$art['id']}}</td>
                            <td>{{$art['title']}}</td>
                            <td>
                                <a href="{{route('user.show',$art['user']['id'])}}"  type="button" class="btn btn-dark mr-2">
                                    {{$art['user']['name']}}
                                </a>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{route('art.show',$art)}}"  type="button" class="btn btn-info mr-2">
                                        <i class="fas fa-id-card">查看</i>
                                    </a>
                                    <a href="artCommentList/{{$art->id}}"  type="button" class="btn btn-info mr-2">
                                        <i class="fas fa-id-card">评论</i>
                                    </a>
                                    @can('update',$art)
                                        <a href="{{route('art.edit',$art)}}" type="button" class="btn btn-success mr-2">
                                            <i class="fas fa-edit">编辑</i>
                                        </a>
                                    @endcan
                                    @can('delete',$art)
                                        <form action="{{route('art.destroy',$art)}}" method="post">
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
            {{$arts->links()}}
        </div>

        <div class="card-footer text-muted">
{{--            {{ $arts->render() }}--}}
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
