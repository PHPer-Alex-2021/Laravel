<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>海德漫</title>
    <link href="/css/app.css" rel="stylesheet" type="text/css">
    <script src="/js/app.js"></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="{{route('home')}}">首页</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('user.index')}}">用户列表<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                       <a class="nav-link" href="{{route('art.index')}}">作品列表<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{route('blog.index')}}">博客列表<span class="sr-only">(current)</span></a>
                    </li>
                </ul>

                @auth
                    <h4 style="color:white">{{session()->get('user')}}</h4>
                    <a href="{{route('logout')}}" class="btn btn-danger my-2 my-sm-0 mr-2">退出</a>
                @else
                    <h4 style="color:white">游客</h4>
                    <a href="{{route('user.create')}}" class="btn btn-danger my-2 my-sm-0 mr-2">注册</a>
                    <a href="{{route('login')}}" class="btn btn-success my-2 my-sm-0">登录</a>
                @endauth

                <a href="{{route('superLogin')}}" class="btn btn-success my-2 my-sm-0">后台登录</a>
            </div>
        </nav>
        @include('Home.Layouts.errors')
        @include('Home.Layouts.message')
        @yield('content')
    </div>
</body>
</html>
