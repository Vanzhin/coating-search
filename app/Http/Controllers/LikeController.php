<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\LikeService;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function likeHandling(Product $product)
    {

        return app(LikeService::class)->likeHandle($product);
    }
}
