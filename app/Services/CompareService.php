<?php

namespace App\Services;

class CompareService
{
    public function add(int $productId): \Illuminate\Http\JsonResponse
    {
        try {
            if (session()->has('products.compare') && in_array($productId, session()->get('products.compare'))) {
                session()->pull('products.compare.' . array_search($productId, session()->get('products.compare')));
            } else {
                session()->push('products.compare', $productId);
            }
            return response()->json([
                'total' => count(session()->get('products.compare')),
                'product_id' => $productId,
            ]);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

}
