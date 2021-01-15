@extends('Home.Layouts.default')
@section('content')
    <form action="{{route('user.update',$user)}}" method="post">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header text-center"><h1>修改资料</h1></div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">昵称</label>
                    <input type="text" class="form-control" name="name" value="{{$user['name']}}">
                    <label for="">密码</label>
                    <input type="password" class="form-control" name="password" value="">
                    <label for="">确认密码</label>
                    <input type="password" class="form-control" name="password_confirmation" value="">
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success">编辑</button>
            </div>
        </div>
    </form>
@endsection
