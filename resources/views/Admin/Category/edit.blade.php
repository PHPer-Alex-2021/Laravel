@extends('Admin.Commont.index')
@section('inner_content')
    <form action="{{route('category.update',$category)}}" method="post">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">修改分类</div>
            @include('Admin.Commont.errors')
            @include('Admin.Commont.message')
            <div class="card-body">
                <div class="form-group">
                    <label for="">分类名称</label>
                    <input type="text" class="form-control" name="cate_name" value="{{$category['cate_name']}}">
                    <label for="">分类标题</label>
                    <input type="text" class="form-control" name="cate_title" value="{{$category['cate_title']}}">
                    <label for="">分类关键字</label>
                    <input type="text" class="form-control" name="cate_keywords" value="{{$category['cate_keywords']}}">
                    <label for="">分类描述</label>
                    <input type="text" class="form-control" name="cate_description" value="{{$category['cate_description']}}">
                    <label for="">排序</label>
                    <input type="text" class="form-control" name="cate_order" value="{{$category['cate_order']}}">
                    <div class="form-group">
                        <label for="">父级分类</label>
                        <select class="form-control" name="cate_pid" id="">
                            <option value="0">顶级分类</option>
                            @foreach($cates as $v)
                                @if($v['id'] == $category['cate_pid'])
                                    <option value="{{$v['id']}}" selected>{{$v['cate_title']}}</option>
                                @else
                                    <option value="{{$v['id']}}">{{$v['cate_title']}}</option>
                                 @endif
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted"></div>
            <button type="submit" class="btn btn-success">修改</button>
        </div>
    </form>
@endsection



