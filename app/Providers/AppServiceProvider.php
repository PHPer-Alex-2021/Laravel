<?php

namespace App\Providers;

use App\ObServer\UserObserver;
use App\Http\Model\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //模型定义事件 observer 模型操作前后调用
        User::observe(UserObserver::class);

        //utf8mb4 字符默认长度 Alex
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //允许应用程序在非生产环境中加载Laravel IDE Helper 插件
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
        //
    }
}
