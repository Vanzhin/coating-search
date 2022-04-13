<?php

namespace App\Providers;

use App\Contracts\OAuth;
use App\Models\Product;
use App\Models\User;
use App\Services\DbService;
use App\Services\ExtractValuesService;
use App\Services\LikeService;
use App\Services\OAuthService;
use App\Services\ProductSearchService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ExtractValuesService::class);
        $this->app->bind(ProductSearchService::class);
        $this->app->bind(LikeService::class);
        $this->app->bind(DbService::class);
        $this->app->bind( OAuth::class, OAuthService::class);
        Schema::defaultStringLength(191);


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
        View::composer(['components.admin.sidebar', 'components.header'], function ($view) {
//todo убрать отсюда https://laravel.com/docs/9.x/views#sharing-data-with-all-views
            $links = [];
            $links['products'] = Product::all()->count();
            $links['users'] = User::all()->count();

            return $view->with('links', $links);
        });

    }
}
