<?php
/** .-------------------------------------------------------------------
 * |      Site: www.hdcms.com  www.houdunren.com
 * |      Date: 2018/7/2 上午12:54
 * |    Author: 向军大叔 <2300071698@qq.com>
 * '-------------------------------------------------------------------*/
/**
 * 权限配置
 * 为了避免其他模块有同名的权限，权限标识要以 '控制器@方法' 开始
 */
return [
    [
        'group' => '系统管理',
        'permissions' => [
            ['title' => '用户列表',
                'name' => 'Admin::user-list',
                'guard' => 'admin'],
            ['title' => '角色列表',
                'name' => 'Admin::role-list',
                'guard' => 'admin'],
            ['title' => '权限管理',
                'name' => 'Admin::permission-manage',
                'guard' => 'admin'],
            ['title' => '网站配置',
                'name' => 'Admin::config-site',
                'guard' => 'admin'],
            ['title' => '微信配置',
                'name' => 'Admin::wechat-config',
                'guard' => 'admin'],
            ['title' => '邮件配置',
                'name' => 'Admin::config-mail',
                'guard' => 'admin'],
        ],
    ],
];
