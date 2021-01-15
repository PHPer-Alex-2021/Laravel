@extends('Admin.Commont.index')
@section('inner_content')
    <div class="card mt-2">
        <div class="card-header">
            分类列表
        </div>
        <a href="{{route('category.create')}}" type="button" class="btn btn-success mr-2">
            <i class="fas fa-edit">添加分类</i>
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
                    <th>排序</th>
                    <th>编号</th>
                    <th>分类名称</th>
                    <th>标题</th>
                    <th>查看次数</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="body">
                @foreach($cates as $cate)
                    <tr>
                        <td scope="row">
                            <input onchange="changerOrder(this,{{$cate['id']}})" style="width:20%" name="order[]" id="" type="text" value="{{$cate['cate_order']}}">
                        </td>
                        <td style="width:15%">{{$cate['id']}}</td>
                        <td style="width:15%">{{$cate['cate_name']}}</td>
                        <td style="width:15%">{{$cate['_cate_name']}}</td>
                        <td style="width:15%">{{$cate['cate_view']}}</td>
                        <td >
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('category.show',$cate)}}"  type="button" class="btn btn-info mr-2">
                                    <i class="fas fa-id-card">查看</i>
                                </a>
                                @can('update',$cate)
                                    <a href="{{route('category.edit',$cate)}}" type="button" class="btn btn-success mr-2">
                                        <i class="fas fa-edit">编辑</i>
                                    </a>
                                @endcan
                                @can('delete',$cate)
                                    <form action="{{route('category.destroy',$cate)}}" method="post">
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
            {{ 4324 }}
            <div style="float:right;letter-spacing: 2px;margin-left:10px;" class="pagi__count">
                共<b> {{ 323  }}</b> 条数据
            </div>
        </div>
    </div>
    <script type="text/javascript">
            function changerOrder(obj,id){
            var cate_order=$(obj).val();
           $.post("{{url('changeOrder')}}",{
                '_token': '{{csrf_token()}}',
                'id':id,
               'cate_order':cate_order,
               },
               function(data){
                   if(data.status == 1){
                       //信息框-例4
                       layer.alert('更新成功', {icon: 6});
                   }else{
                       layer.alert('更新失败', {icon: 5});
                   }
               }
           )}

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
