@extends('Admin.Commont.index')
@section('inner_content')
    <div class="card">
        <div class="card-header">
            博客列表 >> {{$user['name']}}空间
        </div>
            <form action="{{route('search')}}" method="post">
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
                        <th>发表时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody id="body">
                    @foreach($blogs as $blog)
                        <tr>
                            <td scope="row">{{$blog['id']}}</td>
                            <td scope="row">{{$blog['content']}}</td>
                            <td>{{$blog['created_at']}}</td>
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
            <div class="card-footer text-muted">
                {{ $blogs->render() }}
                <div style="float:right;letter-spacing: 2px;margin-left:10px;" class="pagi__count">
                    共<b> {{ 323  }}</b> 条数据
                </div>
            </div>
        </div>
@endsection
