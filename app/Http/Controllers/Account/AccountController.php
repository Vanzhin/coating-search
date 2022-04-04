<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\LikeService;
use Illuminate\Http\Request;

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
        return view('account.index');
    }

    public function showFavoriteProducts()
    {
        return view('account.products', [
            'products' => Product::query()
                ->whereIn('id', app(LikeService::class)->getLikedProductsId())
                ->paginate(10),
        ]);
    }
}
