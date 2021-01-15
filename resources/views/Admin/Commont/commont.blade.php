<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>星影心推荐</title>
    <style type="text/css">
        #editorDiv{
            width:100%;
        }
    </style>

    <link rel="stylesheet" href="/css/app.css"  type="text/css">

{{--bootstrap--}}
    <link rel="stylesheet" href="{{URL::asset('css/Admin/Commont/bootstrap.min.css')}}" />

    <!-- site css -->
    <link rel="stylesheet" href="{{URL::asset('css/Admin/Commont/style.css')}}" />
    <!-- custom css -->
    <link rel="stylesheet" href="{{URL::asset('css/Admin/Commont/custom.css')}}" />
    <!-- responsive css -->
    <link rel="stylesheet" href="{{URL::asset('css/Admin/Commont/responsive.css')}}" />
    <!-- select bootstrap -->
    <link rel="stylesheet" href="{{URL::asset('css/Admin/Commont/bootstrap-select.css')}}" />
    <!-- scrollbar css -->
    <link rel="stylesheet" href="{{URL::asset('css/Admin/Commont/perfect-scrollbar.css')}}" />

@yield('content_css')

    <script src="/js/app.js"></script>
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

{{--    layer--}}
    <script src="{{URL::asset('js/Org/layer/layer.js')}}"></script>

{{--    jquery--}}
    <script src="{{URL::asset('js/jquery-1.8.3.min.js')}}"></script>

{{--    bootstrap--}}
    <script src="{{URL::asset('js/Admin/Commont/bootstrap.min.js')}}"></script>

{{--    Ueditor--}}
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('Org/Ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('Org/Ueditor/ueditor.all.min.js')}}"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="{{URL::asset('Org/Ueditor/lang/zh-cn/zh-cn.js')}}"></script>

    <!-- chart js -->
    <script src="{{URL::asset('js/Admin/Commont/utils.js')}}"></script>
    <script src="{{URL::asset('js/Admin/Commont/analyser.js')}}"></script>
    <script src="{{URL::asset('js/Admin/Commont/Chart.min.js')}}"></script>
    <script src="{{URL::asset('js/Admin/Commont/Chart.bundle.min.js')}}"></script>

    <!-- custom js -->
    <script src="{{URL::asset('js/Admin/Commont/custom.js')}}"></script>
    <!-- wow animation -->
    <script src="{{URL::asset('js/Admin/Commont/animate.js')}}"></script>

    <script src="{{URL::asset('js/Admin/Commont/popper.min.js')}}"></script>

    <!-- owl carousel -->
    <script src="{{URL::asset('js/Admin/Commont/owl.carousel.js')}}"></script>
    <!-- select country -->
    <script src="{{URL::asset('js/Admin/Commont/bootstrap-select.js')}}"></script>

    <!-- nice scrollbar -->
    <script src="{{URL::asset('js/Admin/Commont/perfect-scrollbar.min.js')}}"></script>

    <script>
        var ps = new PerfectScrollbar('#sidebar');
    </script>

</head>
@yield('content')
