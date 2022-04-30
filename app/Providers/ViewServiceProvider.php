<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Search;
use App\Models\User;
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
            $counts['products'] = Product::all()->count();
            $counts['users'] = User::all()->count();
            $counts['searches'] = Search::all()->count();
            $counts['compare'] = Search::all()->count();


            if(Auth::check()){
                $counts['userSearches'] = Search::query()
                    ->where('user_id', Auth::user()->id)
                    ->where('status','<>', 'deleted')
                    ->get()->count();
                $counts['userProducts'] = DB::table('product_likes')
                    ->where('user_id', Auth::user()->id)
                    ->get()->count();
            }


            return $view->with('counts', $counts);
        });

    }
}
