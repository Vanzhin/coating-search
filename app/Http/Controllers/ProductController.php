<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Environment;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate(10);
        return view('products.index', [
            'products' => $products,

        ]);
    }

    public function show(Product $product) :object
    {
        return view('products.show', [
            'product' => $product,
            'brand' => $product->brand,
            'catalog' => $product->catalog,
            'binders' => $product->binders,
            'environments' => $product->environments,
            'numbers' => $product->numbers,
            'resistances' => $product->resistances,
            'substrates' => $product->substrates
        ]);
    }

    public function brand(Brand $brand)
    {
        return view('products.index', [
            'products' => Brand::find($brand->id)->products()->paginate(10),
        ]);
    }

    public function environment(Environment $environment)
    {
        return view('products.index', [
            'products' => Environment::find($environment->id)->products()->paginate(10),
        ]);
    }

}
