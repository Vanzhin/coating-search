<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Search;
use App\Models\User;
use App\Services\ProductSearchService;
use App\Services\ViewDataService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['components.header'], function ($view) {
            $counts['products'] = app(ViewDataService::class)->getAllProducts();
            $counts['compare'] = is_array(session()->get('products.compare')) ? count(session()->get('products.compare')) : 0;

            if (Auth::check()) {
                $counts['userSearches'] = app(ProductSearchService::class)
                    ->getAllSearches(Auth::user())
                    ->count();
                $counts['userProducts'] = app(ViewDataService::class)->getUserLikes(Auth::user());
                $counts['userCompilations'] = app(ViewDataService::class)->getUserCompilations(Auth::user());
            }


            return $view->with('counts', $counts);
        });
        View::composer(['components.admin.sidebar'], function ($view) {
            $counts['products'] = app(ViewDataService::class)->getAllProducts();
            $counts['compare'] = is_array(session()->get('products.compare')) ? count(session()->get('products.compare')) : 0;
            $counts['users'] = User::all()->count();
            $counts['searches'] = Search::all()->count();
            $counts['userSearches'] = app(ProductSearchService::class)
                ->getAllSearches(Auth::user())
                ->count();
            $counts['userProducts'] = app(ViewDataService::class)->getUserLikes(Auth::user());
            $counts['userCompilations'] = app(ViewDataService::class)->getUserCompilations(Auth::user());


            return $view->with('counts', $counts);
        });

    }

}
