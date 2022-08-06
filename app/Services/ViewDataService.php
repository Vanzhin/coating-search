<?php

namespace App\Services;

use App\Models\Product;
use App\Models\User;
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

    public function getUserLikes(User $user)
    {
        if(!session()->has('user.likes')){
            session(['user.likes' => DB::table('product_likes')
                ->where('user_id', $user->id)
                ->get()->count()]);
        }
        return session('user.likes');
    }

    public function getUserCompilations(User $user)
    {
        if(!session()->has('user.compilations')){
            session(['user.compilations' => $user->compilations->count()]);
        }
        return session('user.compilations');
    }

}
