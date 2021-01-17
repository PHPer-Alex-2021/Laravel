<?php

Route::group(['middleware' => 'web', 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function() {

    Route::name('admin.')->group(function(){
        //后台登录
        Auth::routes();
        //验证码
        Route::get('captcha/{tmp}', 'AdminController@captcha')->name('captcha');
    });

});

Route::group(['middleware' => ['web','auth:admin'], 'prefix' => 'admin', 'namespace' => 'Modules\Admin\Http\Controllers'], function()
{
    //后台首页
    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::resource('/user', 'UserController', [
        'names' => [
            'create' => 'super.create',
            // etc...
        ]
    ]);

//    Route::resource('/role', 'RoleController', [
//        'names' => [
//            'create' => 'role.create',
//            // etc...
//        ]
//    ]);

    //角色
    Route::resource('role', 'RoleController');
    Route::get('role/permission/{role}', 'RoleController@permission')->name('admin.permission');

});
