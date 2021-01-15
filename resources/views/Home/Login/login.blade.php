@extends('Home.Layouts.default')
@section('content')
    <form action="{{route('login')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">用户登录</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">邮箱</label>
                    <input type="text" class="form-control" name="email" value="{{old('name')}}">
                    <label for="">密码</label>
                    <input type="password" class="form-control" name="password" value="{{old('password')}}">
                </div>
            </div>
            <div class="card-footer text-muted">
                <a href="{{route('forgetPasswordByEmail')}}" class="btn btn-danger my-2 my-sm-0 mr-2">
                    忘记密码
                </a>
                <a href="{{route('findPasswordEmail')}}" class="btn btn-danger my-2 my-sm-0 mr-2">
                    找回密码
                </a>
            </div>
            <div class="card-footer text-muted"></div>
            <button type="submit" class="btn btn-success">登录</button>
        </div>
    </form>
@endsection
