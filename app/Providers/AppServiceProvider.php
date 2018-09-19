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

        $this->app->bind('test', function ($app) {
            return new \App\test(['driver'=>'12345', 'table'=>'test', 'connection'=>'connection']);
        });

    }
}
