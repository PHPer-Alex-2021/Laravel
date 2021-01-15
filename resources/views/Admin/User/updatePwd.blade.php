@extends('Admin.Commont.index')
@section('inner_content')
    <form action="{{route('updatePwdStore')}}" method="post">
        @csrf
        <div>
            @include('Admin.Commont.errors')
            @include('Admin.Commont.message')
        </div>
        <div class="card">
            <div class="card-header text-center"><h1>修改密码</h1></div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">邮箱</label>
                    <input type="text" class="form-control" name="email" value="">
                    <label for="">密码</label>
                    <input type="password" class="form-control" name="password" value="">
                    <label for="">确认密码</label>
                    <input type="password" class="form-control" name="password_confirmation" value="">
                </div>
            </div>
            <div class="card-footer text-muted text-center">
                <button type="submit" class="btn btn-success">修改</button>
            </div>
        </div>
    </form>
@endsection
