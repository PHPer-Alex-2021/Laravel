<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/version', function(){
    $laravel = app();
    return "Your Laravel version is ".$laravel::VERSION; //5.6.40
});

Route::get('test', 'Home\IndexController@test')->name('test');

Route::group(['namespace'=>'Home','middleware'=>['home.login']],function(){
    Route::get('/', 'IndexController@home')->name('home');
    //只有游客可以跳转到注册
//    Route::get('/home', 'IndexController@home')->name('home');

    Route::post('json_artData','IndexController@json_artData');

//前台用户登录
    Route::get('login', 'LoginController@login')->name('login');
    Route::post('login', 'LoginController@store')->name('login');
//前台用户退出
    Route::get('logout', 'LoginController@logout')->name('logout');

//前台用户管理
    //用户资源控制器
    Route::resource('user','UserController');
    Route::post('search','UserController@search')->name('search');
    Route::post('all','UserController@all')->name('all');

    //艺术作品资源控制器
    Route::resource('art','ArtController');
    Route::get('artComment/{id}','ArtController@artComment')
        ->where('id','.*');
    Route::post('artCommentStore','ArtController@artCommentStore')->name('artCommentStore');
    Route::get('artCommentList/{id}','ArtController@artCommentList');
    Route::get('artCommentShow/{id}','ArtController@artCommentShow');
    Route::get('artCommentDel/{id}','ArtController@artCommentDel');
    Route::get('artCommentEdit/{id}','ArtController@artCommentEdit');
    Route::post('artCommentUpdate','ArtController@artCommentUpdate')->name('artCommentUpdate');
    Route::get('artCommentDelRestore/{id}','ArtController@artCommentDelRestoreartCommentDelRestore');

    //全部撤销
    Route::get('artCommentDelRestore/{acids}','ArtController@artCommentDelRestore');
    //逐步撤销
    Route::get('artCommentDelRestoreRec/{acid}','ArtController@artCommentDelRestoreRec');

    Route::post('uploadArtPic','CommonController@uploadArtPic')->name('uploadArtPic');
    Route::post('upload/UploadAction','CommonController@UploadAction');

//前台博客管理
    Route::resource('blog','BlogController');
    //粉丝关注
    Route::post('follows/{user}', 'UserController@follows')->name('follows');
    Route::post('isFollow', 'UserController@isFollow')->name('isFollow');
    Route::get('follows/{user}', 'IndexController@home');
    //粉丝
    Route::get('follow/{user}','FollowerController@follow')->name('follow');
    Route::get('following/{user}','FollowerController@following')->name('following');
    //关注爱豆或者移除粉丝
    Route::get('delfollows/{user}', 'FollowerController@follows')->name('delfollows');

    //确认邮件的验证
    Route::get('confirmEmailToken/{token}', 'UserController@confirmEmailToken')->name('confirmEmailToken');

        //设置新密码
        Route::get('forgetPasswordByEmail', 'PasswordController@forgetPasswordByEmail')->name('forgetPasswordByEmail');
        Route::post('sendEmail', 'PasswordController@sendEmail')->name('sendEmail');
        Route::get('setNewPassword', 'PasswordController@setNewPassword')->name('setNewPassword');

//找回密码
    Route::get('findPasswordEmail', 'PasswordController@email')->name('findPasswordEmail');
    Route::post('findPasswordSend', 'PasswordController@send')->name('findPasswordSend');
    Route::get('findPasswordEdit/{token}', 'PasswordController@edit')->name('findPasswordEdit');
    Route::post('findPasswordUpdate', 'PasswordController@update')->name('findPasswordUpdate');

});

Route::group(['namespace'=>'Admin',],function() {
    //后台用户登录
    Route::get('adminLogin', 'CommonController@login')->name('superLogin');
    Route::post('adminLoginStore', 'CommonController@adminLoginStore')->name('adminLoginStore');
    //生成验证码
    Route::get('captcha/{tmp}', 'CommonController@captcha')->name('captcha');

    //后台用户注册
    Route::get('adminRegister', 'CommonController@register')->name('adminRegister');
});

Route::group(['namespace'=>'Admin','middleware'=>['admin.login']],function() {
//后台用户退出
    Route::get('adminlogout', 'CommonController@logout')->name('superLogout');

//后台用户管理 修改用户密码
    Route::get('updatePwd', 'CommonController@updatePwd')->name('updatePwd');
    Route::post('updatePwdStore', 'CommonController@updatePwdStore')->name('updatePwdStore');

    //后台用户管理
    Route::resource('users','UserController');

    //后台系统设置
    Route::resource('config','ConfigController');

//后台首页
    Route::get('adminIndex', 'IndexController@adminIndex')->name('adminIndex');

//后台样式管理
    Route::get('dashboard/{type}', 'IndexController@dashboard')->name('dashboard');

//后台分类管理
    Route::resource('category','CategoryController');

    //改变分类排序
    Route::post('changeOrder', 'CategoryController@changeOrder')->name('changeOrder');

//后台博客管理
    Route::resource('blogs','BlogController');
//后台图片文件上传
    Route::post('uploadPic','CommonController@uploadPic')->name('uploadPic');

//查看用户的博客
    Route::get('showUserBlogs/{user}', 'BlogController@showUserBlogs')->name('showUserBlogs');
    Route::get('show/{blog}', 'BlogController@show')->name('show');
});
