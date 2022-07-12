<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ViewDataService
{
    public function getAllProducts()
    {
        if(!session()->has('products.count')){
            session(['products.count' => Product::all()->count()]);
        }
        return session('products.count');
    }

    public function getUserLikes(int $UserId)
    {
        if(!session()->has('user.likes')){
            session(['user.likes' => DB::table('product_likes')
                ->where('user_id', $UserId)
                ->get()->count()]);
        }
        return session('user.likes');
    }

}
