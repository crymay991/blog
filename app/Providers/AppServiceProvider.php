<?php

namespace App\Providers;

use App\Models\Blog;
use App\Observers\BlogObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 分页默认视图修改为bootsrap
        Paginator::useBootstrap();

        // 默认分页视图
        Paginator::defaultView('vendor.pagination.my-page');
        Paginator::defaultSimpleView('vendor.pagination.my-page');

        // 注册观察者
        Blog::observe(BlogObserver::class);
    }
}
