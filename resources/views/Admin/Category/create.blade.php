@extends('Admin.Commont.index')
@section('inner_content')
    <form action="{{route('category.store')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">添加分类</div>
            @include('Admin.Commont.errors')
            @include('Admin.Commont.message')
            <div class="card-body">
                <div class="form-group">
                    <label for="">分类名称</label>
                    <input type="text" class="form-control" name="cate_name" value="{{old('cate_name')}}">
                    <label for="">分类标题</label>
                    <input type="text" class="form-control" name="cate_title" value="{{old('cate_title')}}">
                    <label for="">分类关键字</label>
                    <input type="text" class="form-control" name="cate_keywords" value="{{old('cate_keywords')}}">
                    <label for="">分类描述</label>
                    <input type="text" class="form-control" name="cate_description" value="{{old('cate_description')}}">
                    <label for="">排序</label>
                    <input type="text" class="form-control" name="cate_order" value="{{old('cate_order')}}">
                    <div class="form-group">
                        <label for="">父级分类</label>
                        <select class="form-control" name="cate_pid" id="">
                            <option value="0">顶级分类</option>
                        @foreach($cates as $cate)
                                <option value="{{$cate['cate_pid']}}">{{$cate['cate_title']}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer text-muted"></div>
            <button type="submit" class="btn btn-success">添加</button>
        </div>
    </form>
@endsection
