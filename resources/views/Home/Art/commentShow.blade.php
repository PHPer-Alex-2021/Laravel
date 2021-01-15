@extends('Home.Layouts.default')
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h1>{{$comment['user']['name']}}</h1>
        </div>
        <a href="/artComment/{{$comment['art']['id']}}" type="button" class="btn btn-success mr-2">
            <i class="fas fa-edit">添加评论</i>
        </a>
        <div class="card-body">
            <table class="table">
                <tbody>
                <div class="form-group">
                    <label for="">发布者</label>
                    <input type="text" class="form-control" name="title" readonly value="{{$comment['user']['name']}}">
                </div>
                <div class="form-group">
                    <label for="">内容</label>
                    <textarea class="form-control" readonly name="content" id="" rows="3">
                            {{$comment['comment']}}
                    </textarea>
                </div>
                <div class="form-group">
                    <label for="">创建时间</label>
                    <input type="text" class="form-control" name="title" readonly value="{{$comment['created_at']}}">
                </div>
                <div class="form-group">
                    <label for="">修改时间</label>
                    <input type="text" class="form-control" name="title" readonly value="{{$comment['updated_at']}}">
                </div>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted"></div>
    </div>
@endsection
