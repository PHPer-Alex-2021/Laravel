@extends('Home.Layouts.default')
@section('content')
    <form action="{{route('findPasswordUpdate')}}" method="post">
        @csrf
        <div class="card">
            <div class="card-header">
                重置密码
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">邮箱</label>
                    <input type="text" name="email" value="{{$user['email']}}" readonly id="" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted">请填写注册时的邮箱</small>
                </div>
                <div class="form-group">
                    <label for="">密码</label>
                    <input type="password" name="password" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted"></small>
                </div>
                <div class="form-group">
                    <label for="">确认密码</label>
                    <input type="password" name="password_confirmation" id="" class="form-control" placeholder="" aria-describedby="helpId">
                    <small id="helpId" class="text-muted"></small>
                </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-success">发送</button>
            </div>
            <input type="hidden" name="token" value="{{$user['email_token']}}" id="" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
    </form>
@endsection
