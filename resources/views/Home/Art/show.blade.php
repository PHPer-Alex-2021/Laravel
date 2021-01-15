@extends('Home.Layouts.default')
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h1>{{$art['user']['name']}}</h1>
        </div>
        <a href="/artComment/{{$art->id}}" type="button" class="btn btn-success mr-2">
            <i class="fas fa-edit">添加评论</i>
        </a>
        <div class="card-body">
            <table class="table">
                <tbody>
                    <div class="form-group">
                        <label for="">标题</label>
                        <input type="text" class="form-control" name="title" readonly value="{{$art['title']}}">
                    </div>
                    <div class="form-group">
                        <label for="">介绍</label>
                        <textarea class="form-control" readonly name="content" id="" rows="3">
                            {{$art['content']}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="">创建时间</label>
                        <input type="text" class="form-control" name="title" readonly value="{{$art['created_at']}}">
                    </div>
                    <div class="form-group">
                        <label for="">修改时间</label>
                        <input type="text" class="form-control" name="title" readonly value="{{$art['updated_at']}}">
                    </div>
                    <div class="box">
                        @if(!empty($art['imgs']))
                            <div class="info">
                                <div class="title"><a href="#">{{$art['title']}}</a></div>
                                <div class="pic">
                                    @foreach($art['imgs'] as $v)
                                        <img src="{{URL::asset('/uploads/artsImg/'.$v['img'])}}">
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </tbody>
            </table>
        </div>
        <div class="card-footer text-muted"></div>
    </div>
@endsection
