@extends('Home.Layouts.default')
@section('content')
    <style>
        .role input[type='file']{opacity:0;}
        .role{border:1px solid #c9cccf;text-align:center;width:200px;height:200px;line-height:200px;font-size:18px;margin-top:15px;float:left;margin-left:5px;}
        .role img{width: 198px;height: 198px;display: none;}
    </style>
    <link href="{{URL::asset('css/Upload/common.css')}}" type="text/css" rel="stylesheet">
    <link href="{{URL::asset('css/Upload/index.css')}}" type="text/css" rel="stylesheet">

    <form action="{{route('art.store')}}" method="post" id="art_form" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">添加作品</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">标题</label>
                    <input type="text" class="form-control" name="arts_title" value="{{old('arts_title')}}">
                </div>
                <div class="form-group">
                    <label for="">介绍</label>
                    <textarea class="form-control" name="arts_desc" id="" rows="3" value="">
                        {{old('arts_desc')}}
                    </textarea>
                </div>
                <div class="form-group">
                    <p class="up-p">
                        图片：<span class="up-span">最多可以上传5张图片</span>
                    </p>
                </div>
                <div class="role" onclick="file(this)">
                     <img src="" alt="" id="goods_1" class="file" >
                     <span style="color: #ccc;">上传图像</span>
                     <input type="file"  name="arts_imgs[]" class="file" value="" id="goods1" onchange="le(this)">
                </div>

                <div class="role" style="display: none" onclick="file(this)">
                     <img src="" alt="" id="goods_2" class="file" >
                     <span style="color: #ccc;">上传图像</span>
                     <input type="file"  name="arts_imgs[]" class="file" value="" id="goods2" onchange="le(this)">
                </div>

                <div class="role" onclick="copy(this)">
                      <span style="color: #ccc;">继续添加</span>
                </div>
            </div>
            <div class="card-footer text-muted"></div>
            <div class="card mt-2">
                <input type="submit" value='发布' class="btn btn-success mr-2">
            </div>
        </div>
    </form>
    <script src="{{URL::asset('js/jquery-1.8.3.min.js')}}"></script>
    <script src="{{URL::asset('js/Upload/imgUp.js')}}"></script>

    <script type="text/javascript">
        //点击圆框时上传图片
        function file(evn) {
            var img_obj = $(evn).children(".file")
            var file_id = $(img_obj[1]).attr("id")
            document.getElementById(file_id).click()
        }


        //点击时复制角色框
        function copy(evn) {
            var obj = $(evn).prev();
            var num =  $(".role").length
            console.log(num)
            $(obj).clone().insertBefore(evn);
            $(obj).css("display","block")
            var img_obj = $(obj).children(".file")
            console.log(img_obj)
            var img_id = $(img_obj[0]).attr("id","goods_"+num)
            var file_id = $(img_obj[1]).attr("id","goods"+num)
        }
        //左侧图像点击时显示图像
        function le(evn){
            var id = $(evn).attr('id');//获取id
            var num = "goods_"+id.substr(5,1);
            var file = event.target.files[0];
            if (window.FileReader) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                //监听文件读取结束后事件
                reader.onloadend = function (e) {
                    var divObj= $(evn).prev()  //获取div的DOM对象
                    $(divObj).html("") //插入文件名
                    $("#"+num).css("display","block");
                    $("#"+num).attr("src",e.target.result);    //e.target.result就是最后的路径地址
                };
            }
        }

    </script>
@endsection
