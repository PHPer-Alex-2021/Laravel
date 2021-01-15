@extends('Home.Layouts.default')
@section('content')
    <link href="{{URL::asset('css/Upload/common.css')}}" type="text/css" rel="stylesheet">
    <link href="{{URL::asset('css/Upload/index.css')}}" type="text/css" rel="stylesheet">

    <form action="{{route('art.store')}}" method="post" id="art_form" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-header">添加作品</div>
            <div class="card-body">
                <div class="form-group">
                    <label for="">标题</label>
                    <input type="text" class="form-control" name="title" value="">
                </div>
                <div class="form-group">
                    <div class="">
                        <section class=" img-section">
                            <p class="up-p">
                                图片：<span class="up-span">最多可以上传5张图片</span>
                            </p>
                            <div class="z_photo upimg-div clear" >
                                <section class="z_file fl">
                                    <img src="{{URL::asset('images/Uploads/a11.png')}}" class="add-img">
                                    <input type="file" name="goods_imgs[]" id="file" class="file" accept="image/jpg,image/jpeg,image/png,image/bmp" multiple="multiple" />
                                </section>
                            </div>
                        </section>
                    </div>
                    <aside class="mask works-mask">
                        <div class="mask-content">
                            <p class="del-p ">您确定要删除作品图片吗？</p>
                            <p class="check-p"><span class="del-com wsdel-ok">确定</span><span class="wsdel-no">取消</span></p>
                        </div>
                    </aside>
                </div>

                <div class="form-group">
                    <label for="">介绍</label>
                    <textarea class="form-control" name="content" id="" rows="3">
                    </textarea>
                </div>
            </div>
            <div class="card-footer text-muted"></div>
            <button type="submit" class="btn btn-success">发布</button>
            <input type="button" class="back" onclick="history.go(-1)" value="返回">
        </div>
    </form>

    <script src="{{URL::asset('js/jquery-1.8.3.min.js')}}"></script>
    <script src="{{URL::asset('js/Upload/imgUp.js')}}"></script>


@endsection
