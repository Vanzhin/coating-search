<?php

namespace App\Providers;

use App\Services\ExtractValuesService;
use App\Services\LikeService;
use App\Services\MinMaxValuesService;
use App\Services\ProductSearchService;
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
        $this->app->bind(ExtractValuesService::class);
        $this->app->bind(ProductSearchService::class);
        $this->app->bind(LikeService::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();

    }
}
