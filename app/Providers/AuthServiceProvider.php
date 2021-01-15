<?php

namespace App\Providers;

use App\Http\Model\ArtComment;
use App\Http\Model\Category;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Policies\UserPolicy;
use App\Policies\BlogPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\ConfigPolicy;
use App\Policies\ArtPolicy;
use App\Policies\ArtCommentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        'App\Http\Model\User' => UserPolicy::class,
        'App\Http\Model\Blog' => BlogPolicy::class,
        'App\Http\Model\Category' => CategoryPolicy::class,
        'App\Http\Model\Config' => ConfigPolicy::class,
        'App\Http\Model\Art' => ArtPolicy::class,
        'App\Http\Model\ArtComment' => ArtCommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
