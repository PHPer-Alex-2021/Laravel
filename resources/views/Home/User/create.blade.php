@extends('Home.Layouts.default')
@section('content')
    <form action="{{route('user.store')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">用户注册</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">昵称</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    <label for="">邮箱</label>
                    <input type="text" class="form-control" name="email" value="{{old('email')}}">
                    <label for="">密码</label>
                    <input type="password" class="form-control" name="password">
                    <label for="">确认密码</label>
                    <input type="password" class="form-control" name="password_confirmation">
                    <small id="passwordHelpInline" class="text-muted">
                        两次密码要一致.
                    </small>
                </div>
            </div>
            <div class="card-footer text-muted"></div>
            <button type="submit" class="btn btn-success">注册</button>
        </div>
    </form>
@endsection
