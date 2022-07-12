<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Search;
use App\Models\User;
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
        View::composer(['components.admin.sidebar', 'components.header'], function ($view) {
// https://laravel.com/docs/9.x/views#sharing-data-with-all-views
            $counts['products'] = app(ViewDataService::class)->getAllProducts();
//            $counts['users'] = User::all()->count();
//            $counts['searches'] = Search::all()->count();
            $counts['compare'] = is_array(session()->get('products.compare')) ? count(session()->get('products.compare')) : 0;

            if (Auth::check()) {
                $counts['userSearches'] = Search::query()
                    ->where('user_id', Auth::user()->id)
                    ->where('is_deleted', 0)
                    ->get()->count();
                $counts['userProducts'] = app(ViewDataService::class)->getUserLikes(Auth::user()->id);
            }


            return $view->with('counts', $counts);
        });

    }
}
