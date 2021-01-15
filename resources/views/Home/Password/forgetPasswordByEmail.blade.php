@extends('Home.Layouts.default')
@section('content')
    <form action="{{route('sendEmail')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">找回密码</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">邮箱</label>
                    <input type="text" class="form-control" name="email" value="{{old('email')}}">
                    <label for="">密码</label>
                    <input type="password" class="form-control" name="password" >
                    <label for="">确认密码</label>
                    <input type="password" class="form-control" name="password_confirmation" >
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success">发送邮件</button>
            </div>
        </div>
    </form>
@endsection
