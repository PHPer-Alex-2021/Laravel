@extends('Admin.Commont.commont')
@section('content')
    <body class="inner_page login">
    <div class="full_container">
        <div class="container">
            <div class="center verticle_center full_height">
                <div class="login_section">
                    <div class="logo_login">
                        <div class="center">
                            <img width="210" src="{{URL::asset('images/Admin/Login/logo.png')}}" alt="#" />
                        </div>
                    </div>
                    <div class="login_form">
                        <form class="mws-form" action="{{route('adminLoginStore')}}" method="post">
                            @csrf
                            <div>
                                @include('Admin.Commont.errors')
                                @include('Admin.Commont.message')
                            </div>
                            <fieldset>
                                <div class="field">
                                    <label class="label_field">邮箱</label>
                                    <input type="email" name="email" placeholder="E-mail" />
                                </div>
                                <div class="field">
                                    <label class="label_field">密码</label>
                                    <input type="password" name="password" placeholder="密码" />
                                </div>
                                <div class="field">
                                    <label class="label_field">验证码</label>
                                    <a onclick="javascript:re_captcha();" >
                                        <img class="text-center" src="{{ route('captcha',1) }}" alt="验证码" title="刷新图片" width="200" height="50" id="captcha" border="0">
                                    </a>
                                    <input type="text" name="captcha" placeholder="验证码" value="" />
                                </div>
                                <div class="field text-center">
                                    <label class="label_field hidden">hidden label</label>
                                    <label class="form-check-label">
                                        <input type="checkbox" class="form-check-input"> 记住密码
                                    </label>
                                    <a class="forgot" href="">Forgotten Password?</a>
                                </div>
                                <div class="field margin_0">
                                    <label class="label_field hidden">hidden label</label>
                                    <button class="main_bt">Sing In</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    <script>
        function re_captcha() {
            $url = "{{ URL('captcha') }}";
            $url = $url + "/" + Math.random();
            document.getElementById('captcha').src=$url;
        }
    </script>
@endsection
