<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate(10);
        return view('products.index', [
            'productsList' => $products,

        ]);
    }

    public function show(Product $product) :object
    {
        return view('products.show', [
            'product' => $product,
        ]);
    }
}
