<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Search;
use App\Services\LikeService;
use App\Services\ProductSearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                ->paginate(10),
            'likes' => app(LikeService::class)->getLikedProductsId(),
            'compareProduct' => session()->get('products.compare') ?? [],
        ]);
    }
}
