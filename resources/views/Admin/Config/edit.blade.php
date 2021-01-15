@extends('Admin.Commont.index')
@section('inner_content')
    <form action="{{route('config.update',$config)}}" method="post">
        @csrf
        @method('PUT')
        <div class="card">
            <div class="card-header">修改系统设置</div>
            @include('Admin.Commont.errors')
            @include('Admin.Commont.message')
            <div class="card-body">
                <div class="form-group">
                    <label for="">标题</label>
                    <input type="text" class="form-control" name="conf_title" value="{{$config['conf_title']}}">
                    <label for="">名称</label>
                    <input type="text" class="form-control" name="conf_name" value="{{$config['conf_name']}}">
                    <label for="">类型</label><br>
                    <label class="btn btn-primary">
                        文本:<input type="radio" onclick="showValue()" name="conf_type" value="1" autocomplete="off" checked>
                    </label>
                    <label class="btn btn-primary">
                        单选:<input type="radio" onclick="showValue()" name="conf_type" value="2" autocomplete="off">
                    </label>
                    <label class="btn btn-primary">
                        文本框:<input type="radio" onclick="showValue()" name="conf_type" value="3" autocomplete="off ">
                    </label>
                    <div class="form-group">
                        <label for="">类型值
                            <p><span>（类型值只有在单选的情况下才需要配置 格式 1|开启,0|关闭）</span></p>
                        </label>
                        <input type="text" class="form-control conf_content" name="conf_content" value="{{$config['conf_content']}}">
                    </div>
                    <div class="form-group">
                        <label for="">说明</label>
                        <textarea class="form-control" name="conf_tips" id="" rows="3">
                            {{$config['conf_tips']}}
                        </textarea>
                    </div>
                    <label for="">排序</label>
                    <input type="text" class="form-control" name="conf_order" value="{{$config['conf_order']}}">
                </div>
            </div>
            <div class="card-footer text-muted"></div>
            <button type="submit" class="btn btn-success">添加</button>
        </div>
    </form>
    <script type="text/javascript">
        showValue()
        function showValue(){
            var type=$('input[name=conf_type]:checked').val();
            //1文本 2单选 3文本框
            if(type==2){
                $('.conf_content').show();
            }else{
                $('.conf_content').hide();
            }
        }
    </script>
@endsection
