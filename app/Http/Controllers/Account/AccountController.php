<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Compilation;
use App\Models\Product;
use App\Models\Search;
use App\Services\LikeService;
use App\Services\ProductSearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('account.index', [
            'countSearches' => app(ProductSearchService::class)->getAllSearches(Auth::user())
            ->count(),
            'countLikes' => count(app(LikeService::class)->getLikedProductsId()),
        ]);
    }

    public function showFavoriteProducts()
    {
        return view('account.products', [
            'products' => Product::query()
                ->whereIn('id', app(LikeService::class)->getLikedProductsId())
                ->paginate(9),
            'likes' => app(LikeService::class)->getLikedProductsId(),
            'compareProduct' => session()->get('products.compare') ?? [],
        ]);
    }

    public function showCompilations()
    {
        return view('compilations.index', [
            'compilations' => Compilation::query()
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->orderBy('updated_at', 'desc')
                ->paginate(Config::get('constants.ITEMS_PER_PAGE')),
        ]);    }
}
