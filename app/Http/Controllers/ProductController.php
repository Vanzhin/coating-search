<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Environment;
use App\Models\Product;
use App\Services\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate(10);
        return view('products.index', [
            'products' => $products,
            'likes' => app(LikeService::class)->getLikedProductsId(),
            'compareProduct' => session()->get('products.compare') ?? [],


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
            'substrates' => $product->substrates,
            'additives' => $product->additives,

        ]);
    }
    //todo убрать отсюда
    public function addToCompare( int $productId){
        try {
            if (session()->has('products.compare') && in_array($productId, session()->get('products.compare'))){
                session()->pull('products.compare.' . array_search($productId, session()->get('products.compare')));
            }else{
                session()->push('products.compare', $productId);
            }
            return response()->json([
                'total' => count(session()->get('products.compare')),
                'product_id' => $productId,
            ]);

        }catch(\Exception $e){
            return response()->json('error', 400);
        } catch (NotFoundExceptionInterface $e) {
            return response()->json('error', 401);

        } catch (ContainerExceptionInterface $e) {
            return response()->json('error', 402);

        }

    }

    public function compare()
    {
        if (session()->exists('products.compare')){
            $products = Product::query()->whereIn('id', session()->get('products.compare'))->get();

        } else $products = [];

        return view('products.compare', [
            'products' => $products,
            'linkedFields' => Product::getLinkedFields(),
        ]);
    }

    public function brand( $slug)
    {
        //сделал со слагом, чтобы был красивый адрес типа http://coating-search.test/products/brand/ppg
        $brand = Brand::where('slug', $slug)->first();
        return view('products.index', [
            'products' => Brand::find($brand->id)->products()->paginate(10),
            'param' => '(Бренд: ' . Str::upper($slug) . ')',
            'likes' => app(LikeService::class)->getLikedProductsId(),
            'compareProduct' => session()->get('products.compare') ?? [],


        ]);
    }

    public function environment(Environment $environment)
    {
        return view('products.index', [
            'products' => Environment::find($environment->id)->products()->paginate(10),
            'likes' => app(LikeService::class)->getLikedProductsId(),
            'compareProduct' => session()->get('products.compare') ?? [],
            'param' => '(Cреда: ' . Str::ucfirst($environment->title) . ')',

        ]);
    }

}
