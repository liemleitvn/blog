<?php

namespace App\Providers;

use App\Models\Post;
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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\PostRepositoryInterface',
            'App\Repositories\Eloquents\PostRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\CategoryRepositoryInterface',
            'App\Repositories\Eloquents\CategoryRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\RoleRepositoryInterface',
            'App\Repositories\Eloquents\RoleRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\PermissionRepositoryInterface',
            'App\Repositories\Eloquents\PermissionRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquents\UserRepository'
        );


    }
}
