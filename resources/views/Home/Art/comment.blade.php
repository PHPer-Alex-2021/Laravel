@extends('Home.Layouts.default')
@section('content')
    <style>
        #editorDiv{
            width:100%;
        }
    </style>

    <form action="{{route('artCommentStore')}}" method="post" id="art_form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="sr-only" for="inputName">Hidden input label</label>
            <input type="hidden" class="form-control" value="{{$art['id']}}" name="art_id" id="inputName" placeholder="">
        </div>
        <div class="card">
            <div class="card-header">添加评论</div>
            <div class="card-body">
                <div class="form-group">
                    <div id="editorDiv"></div>
                    <label for="">内容</label>
                    <script id="editor" name="arts_comment" value="" type="text/plain" style="width:1000px;height:200px;">
                    </script>
                </div>
            </div>
            <div class="card-footer text-muted"></div>

            <div class="card mt-2">
                <input type="submit" value='发布' class="btn btn-success mr-2">
            </div>
        </div>
    </form>
    <script src="{{URL::asset('js/jquery-1.8.3.min.js')}}"></script>

{{--    Ueditor--}}
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('Org/Ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('Org/Ueditor/ueditor.all.min.js')}}"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('Org/Ueditor/lang/zh-cn/zh-cn.js')}}"></script>

    <script type="text/javascript" charset="utf-8" src="{{URL::asset('Org/Ueditor/ueditor.js')}}"></script>

@endsection
