@extends('Admin.Commont.index')
@section('inner_content')
{{--    <style type="text/css">--}}
{{--        body {--}}
{{--            font: 13px Arial, Helvetica, Sans-serif;--}}
{{--        }--}}
{{--    </style>--}}

{{--    uploadify --}}
    <link rel="stylesheet" type="text/css" href="{{URL::asset('Org/Uploadify/uploadify.css')}}">

    <form action="{{route('blogs.store')}}" method="post" id="art_form" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">添加文章</div>
            @include('Admin.Commont.errors')
            @include('Admin.Commont.message')
            <div class="card-body">
                <div class="form-group">
                    <label for="">父级分类</label>
                    <select class="form-control" name="" id="">
                        <option>顶级</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">文章标题</label>
                    <input type="text" class="form-control" name="title" value="{{old('title')}}">
                </div>
                <div class="form-group">
                    <label for="">*缩略图</label>
                    <img src="{{URL::asset('images/Uploads/file.jpg')}}" id="pic" style="width:80px;cursor: pointer;"/>
                    <input type="file" name="photo" id="photo_upload" style="display: none;" />
                </div>
                <div class="form-group">
                    <label for="">关键词</label>
                    <input type="text" class="form-control" name="keywords" value="">
                </div>
                <div class="form-group">
                    <label for="">描述</label>
                    <textarea class="form-control" name="description" id="" rows="3">
                    </textarea>
                </div>
                <div class="form-group">
                    <div id="editorDiv"></div>
                    <label for="">内容</label>
                    <script id="editor" name="content" value="{{old('content')}}" type="text/plain" style="width:1000px;height:200px;"></script>
                </div>
                <div class="form-group">
                    <label for="">文章排序</label>
                    <input type="text" class="form-control" name="order" value="{{old('order')}}">
                </div>
            </div>
            <div class="card-footer text-muted"></div>
            <button type="submit" class="btn btn-success">添加</button>
            <input type="button" class="back" onclick="history.go(-1)" value="返回">
        </div>
    </form>

{{--    uploadify --}}
    <script src="{{URL::asset('Org/Uploadify/jquery.uploadify.min.js')}}" type="text/javascript"></script>

{{--    Ueditor --}}
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('Org/Ueditor/ueditor.js')}}"></script>

{{--   图片上传 --}}
    <script type="text/javascript">
        $('#pic').on('click', function(){
            $('#photo_upload').trigger('click');
            $('#photo_upload').on('change', function(){
                var obj = this;
                //用整个from表单初始化FormData
                var formData = new FormData($('#art_form')[0]);

                $.ajax({
                    url: '{{route('uploadPic')}}',
                    type: 'post',
                    data: formData,
                    // 因为data值是FormData对象，不需要对数据做处理
                    processData: false,
                    contentType: false,
                    beforeSend:function(){
                        // 菊花转转图
                        $('#pic').attr('src', '{{URL::asset('images/Uploads/load.gif')}}');
                    },
                    success: function(data){
                        console.log(4324);
                        if(data['ServerNo']=='200'){
                            // 如果成功
                            $('#pic').attr('src', '/uploads/'+data['ResultData']);
                            $('input[name=pic]').val(data);
                            $(obj).off('change');
                        }else{
                            // 如果失败
                            alert(data['ResultData']);
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        var number = XMLHttpRequest.status;
                        var info = "错误号"+number+"文件上传失败!";
                        // 将菊花换成原图
                        $('#pic').attr('src', '/file.png');
                        alert(info);
                    },
                    async: true
                });
            });
        });
    </script>
@endsection
