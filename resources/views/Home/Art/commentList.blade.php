@extends('Home.Layouts.default')
@section('content')
    <div class="card mt-2">
        <div class="card-header text-center">
            <h1>{{$title[0]['title']}}</h1>
        </div>
        <div class="card-header">
            评论列表
        </div>
        <a href="/artComment/{{$art_id}}" type="button" class="btn btn-success mr-2">
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
            <div class="input-group col-lg-0  fa-pull-left">
                @if(session()->has('restore_acid') && count(session()->get('restore_acid'))>1)
                    <a href="/artCommentDelRestore/{{implode(',',session()->get('restore_acid'))}}" type="button" class="btn btn-success mr-2">
                        <i class="fas fa-edit">撤销全部</i>
                    </a>
                @endif

                @if(session()->has('restore_acid') && !empty(session()->get('restore_acid')))
                    <a href="/artCommentDelRestoreRec/{{array_slice(session()->get('restore_acid'),-1,1)[0]}}" type="button" class="btn btn-success mr-2">
                        <i class="fas fa-edit">撤销</i>
                    </a>
                @endif

{{--                <a href="/test" type="button" class="btn btn-success mr-2">--}}
{{--                    <i class="fas fa-edit">test</i>--}}
{{--                </a>--}}
            </div>
        </form>
        <div class="card-body">
            <table class="table table-striped">
                <thead class="table table-success">
                    <tr>
                        <th>编号</th>
                        <th>内容</th>
                        <th>评论者</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="body">
                    @foreach($comments as $comment)
                        <tr>
                            <td scope="row">{{$comment['id']}}</td>
                            <td>{{$comment['comment']}}</td>
                            <td>
                                <a href="{{route('user.show',$comment['user']['id'])}}"  type="button" class="btn btn-dark mr-2">
                                    {{$comment['user']['name']}}
                                </a>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="/artCommentShow/{{$comment['id']}}"  type="button" class="btn btn-info mr-2">
                                        <i class="fas fa-id-card">查看</i>
                                    </a>
                                    @can('update',$comment)
                                        <a href="/artCommentEdit/{{$comment->id}}" type="button" class="btn btn-success mr-2">
                                            <i class="fas fa-edit">编辑</i>
                                        </a>
                                    @endcan
                                    @can('delete',$comment)
                                        <a href="/artCommentDel/{{$comment->id}}" type="button" class="btn btn-success mr-2">
                                            <i class="fas fa-edit">删除</i>
                                        </a>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
