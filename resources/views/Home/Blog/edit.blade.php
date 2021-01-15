@extends('Home.Layouts.default')
@section('content')
    <form action="{{route('blog.update',$blog)}}" method="post">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">修改博客</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">内容</label>
                    <input type="text" class="form-control" name="bContent" value="{{$blog['content']}}">
                </div>
            </div>
            <div class="card-footer text-muted"></div>
            <button type="submit" class="btn btn-success">发布</button>
        </div>
    </form>
@endsection
