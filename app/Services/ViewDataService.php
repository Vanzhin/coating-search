<?php

namespace App\Services;

use App\Models\Product;

class ViewDataService
{
    public function getAllProducts()
    {
        if(!session()->has('products.count')){
            session(['products.count' => Product::all()->count()]);
        }
        return session('products.count');
    }

}
