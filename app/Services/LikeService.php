<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeService
{
    public function getLikedProductsId()
    {
        $likedProductsId = [];
        $data = Auth::check() ? DB::table('product_likes')
            ->where('user_id', Auth::user()->getAuthIdentifier())
            ->get()->toArray() : [];
        foreach ($data as $key => $value){
            $likedProductsId[] = $value->product_id;
        }
        return $likedProductsId;
    }

    public function likeHandle(Product $product)
    {
        try {
            $count = session('user.likes');
            $like = DB::table('product_likes')
                ->where('product_id', '=', $product->id)
                ->where('user_id', '=', Auth::user()->getAuthIdentifier());
            if ($like->exists()){
                $like->delete();
                $response = [
                    'state' => 'like',
                ];
                session(['user.likes' => $count-1]);
            } else{
                DB::table('product_likes')->insert([
                    'product_id' => $product->id,
                    'user_id' => Auth::user()->getAuthIdentifier(),
                ]);
                $response = [
                    'state' => 'dislike',
                ];
                session(['user.likes' => $count+1]);
            }
            $response['total'] = $count;
            return response()->json($response);

        }catch(\Exception $e){
            return response()->json($e->getMessage(), 400);
        }

    }

}
