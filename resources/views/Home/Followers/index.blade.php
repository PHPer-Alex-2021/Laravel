@extends('Home.Layouts.default')
@section('content')
    <div class="card mt-2">
        <div class="card-header">
            {{$title}}列表
        </div>
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
                    <th>昵称</th>
                    <th>关注时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="body">
                @foreach($followers as $follower)
                    <tr>
                        <td scope="row">{{$follower['id']}}</td>
                        <td>{{$follower['name']}}</td>
                        <td>{{$follower['created_at']}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('blog.show',$follower)}}"  type="button" class="btn btn-info mr-2">
                                    <i class="fas fa-id-card">查看</i>
                                </a>
                                @can('update',$follower)
                                    <a href="{{route('delfollows',$follower)}}" type="button" class="btn btn-success mr-2">
                                        <i class="fas fa-edit">
                                            @if($title=='关注')取消 @else关注 @endif
                                        </i>
                                    </a>
                                @endcan
                                @can('follower',$follower)
                                    <form action="{{route('blog.destroy',$follower)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash-o">关注</i>
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
            {{$followers->links()}}
        </div>

        <div class="card-footer text-muted">
            {{ $followers->render() }}
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
