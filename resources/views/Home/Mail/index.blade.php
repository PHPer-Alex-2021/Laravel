<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div style="background-color:#ECECEC; padding: 35px;">
    <table cellpadding="0" align="center"
           style="width: 600px; margin: 0px auto; text-align: left; position: relative; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 5px; border-bottom-left-radius: 5px; font-size: 14px; font-family:微软雅黑, 黑体; line-height: 1.5; box-shadow: rgb(153, 153, 153) 0px 0px 5px; border-collapse: collapse; background-position: initial initial; background-repeat: initial initial;background:#fff;">
        <tbody>
        <tr>
            <th valign="middle"
                style="height: 25px; line-height: 25px; padding: 15px 35px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #42a3d3; background-color: #49bcff; border-top-left-radius: 5px; border-top-right-radius: 5px; border-bottom-right-radius: 0px; border-bottom-left-radius: 0px;">
                <font face="微软雅黑" size="5" style="color: rgb(255, 255, 255); ">注册成功! （星影心推荐）</font>
            </th>
        </tr>
        <tr>
            <td>
                <div style="padding:25px 35px 40px; background-color:#fff;">
                    <h2 style="margin: 5px 0px; ">
                        <font color="#333333" style="line-height: 20px; ">
                            <font style="line-height: 22px; " size="4">
                                亲爱的 {{$user->name}}</font>
                        </font>
                    </h2>
                    <p>首先感谢您加入大家庭！下面是您的账号信息<br>
                        您的账号：<b>{{$user->name}}</b><br>
                        您的邮箱：<b>{{$user->email}}</b><br>
                        您注册时的日期：<b>{{ date('Y-m-d h:i:s', time()) }}</b><br>
                        您注册时的IP：<b>{{ $_SERVER['REMOTE_ADDR'] }}</b><br>
                        当您在使用本网站时，遵守当地法律法规。<br>
                        如果您有什么疑问可以联系管理员，Email: 3278143864@qq.com</p>
                    <p align="right">星影心推荐</p>
                    <p align="right">{{ $_SERVER['REMOTE_ADDR'] }}</p>
                    <div style="width:700px;margin:0 auto;">
                        <div style="padding:10px 10px 0;border-top:1px solid #ccc;color:#747474;margin-bottom:20px;line-height:1.3em;font-size:12px;">
                            <p>此为系统邮件，请勿回复<br>
                                请保管好您的邮箱，避免账号被他人盗用
                            </p>
                            <p>©***</p>
                        </div>
                    </div>
                    <a href="{{route('confirmEmailToken')}}">点击链接完成注册</a>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
