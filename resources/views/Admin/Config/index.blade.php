@extends('Admin.Commont.index')
@section('inner_content')
    <div class="card mt-2">
        <div class="card-header">
            配置列表
        </div>
        <a href="{{route('config.create')}}" type="button" class="btn btn-success mr-2">
            <i class="fas fa-edit">添加配置</i>
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
                        <th>标题</th>
                        <th>名称</th>
                        <th>内容</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="body">
                @foreach($confs as $conf)
                    <tr>
                        <td scope="row">
                            <input onchange="changerOrder(this,{{$conf['conf_order']}})" style="width:20%" name="order[]" id="" type="text" value="{{$conf['conf_order']}}">
                        </td>
                        <td style="width:15%">{{$conf['id']}}</td>
                        <td style="width:5%">{{$conf['conf_title']}}</td>
                        <td style="width:5%">{{$conf['conf_name']}}</td>
                        <td>
                            <input type="hidden" name="conf_id" value="{{$conf['id']}}">
                            {!!$conf->_html!!}
                        </td>
                        <td >
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('config.show',$conf)}}"  type="button" class="btn btn-info mr-2">
                                    <i class="fas fa-id-card">查看</i>
                                </a>
                                @can('update',$conf)
                                    <a href="{{route('config.edit',$conf)}}" type="button" class="btn btn-success mr-2">
                                        <i class="fas fa-edit">编辑</i>
                                    </a>
                                @endcan
                                @can('delete',$conf)
                                    <form action="{{route('config.destroy',$conf)}}" method="post">
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

    </script>
@endsection
