<?php

namespace App\Http\Controllers;

use App\Models\Additive;
use App\Models\Binder;
use App\Models\Brand;
use App\Models\Catalog;
use App\Models\Environment;
use App\Models\Number;
use App\Models\Product;
use App\Models\Resistance;
use App\Models\Substrate;
use App\Services\LikeService;
use Illuminate\Database\Eloquent\Model;
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
            'likes' => app(LikeService::class)->getLikedProductsId(),
            'compareProduct' => session()->get('products.compare') ?? [],



        ]);
    }
    //todo убрать отсюда
    public function addToCompare(int $productId){
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

//    public function brand($slug)
//    {
//        //сделал со слагом, чтобы был красивый адрес типа http://coating-search.test/products/brand/ppg
//        $brand = Brand::where('slug', $slug)->first();
//        return view('products.index', [
//            'products' => Brand::find($brand->id)->products()->paginate(10),
//            'param' => '(Бренд: ' . Str::upper($slug) . ')',
//            'likes' => app(LikeService::class)->getLikedProductsId(),
//            'compareProduct' => session()->get('products.compare') ?? [],
//
//
//        ]);
//    }

//    public function environment(Environment $environment)
//    {
//        return view('products.index', [
//            'products' => Environment::find($environment->id)->products()->paginate(10),
//            'likes' => app(LikeService::class)->getLikedProductsId(),
//            'compareProduct' => session()->get('products.compare') ?? [],
//            'param' => '(Cреда: ' . Str::ucfirst($environment->title) . ')',
//
//        ]);
//    }

//    public function binder($slug)
//    {
//        $binder = Binder::where('slug', $slug)->first();
//
//        return view('products.index', [
//            'products' => Binder::find($binder->id)->products()->paginate(10),
//            'likes' => app(LikeService::class)->getLikedProductsId(),
//            'compareProduct' => session()->get('products.compare') ?? [],
//            'param' => '(Основа: ' . Str::ucfirst($binder->title) . ')',
//
//        ]);
//    }
    public function indexBySlug($param, $slug)
    {
        //todo очень костыльно - доделать
        switch ($param) {
            case 'additive':
                $model = Additive::where('slug', $slug)->first();
                $products = Additive::find($model->id)->products()->paginate(10);
                break;
            case 'brand':
                $model = Brand::where('slug', $slug)->first();
                $products = Product::where('brand_id',$model->id)->paginate(10);
                break;
            case 'catalog':
                $model = Catalog::where('slug', $slug)->first();
                $products = Product::where('catalog_id',$model->id)->paginate(10);
                break;
            case 'binder':
                $model = Binder::where('slug', $slug)->first();
                $products = Binder::find($model->id)->products()->paginate(10);
                break;
            case 'environment':
                $model = Environment::where('slug', $slug)->first();
                $products = Environment::find($model->id)->products()->paginate(10);

                break;
            case 'number':
                $model = Number::where('slug', $slug)->first();
                $products = Number::find($model->id)->products()->paginate(10);

                break;
            case 'resistance':
                $model = Resistance::where('slug', $slug)->first();
                $products = Resistance::find($model->id)->products()->paginate(10);

                break;
            case 'substrate':
                $model = Substrate::where('slug', $slug)->first();
                $products = Substrate::find($model->id)->products()->paginate(10);

                break;
            default:
                //todo сделать, чтобы редиректил на все покрытия если что-то не так с запросом

            $products = Product::query()->paginate(10);
                return view('products.index', [
                    'products' => $products,
                    'likes' => app(LikeService::class)->getLikedProductsId(),
                    'compareProduct' => session()->get('products.compare') ?? [],


                ]);        }

        return view('products.index', [
            'products' => $products,
            'likes' => app(LikeService::class)->getLikedProductsId(),
            'compareProduct' => session()->get('products.compare') ?? [],
            'param' => '(' . Str::ucfirst($model->name) .': ' . Str::ucfirst($model->title) . ')',

        ]);
    }
    public function indexByParam($param, $value)
    {
        //todo очень костыльно - доделать
        $factor = 0.1;
        switch ($param) {

            case 'tolerance':
                $products = Product::query()->where($param, $value !== 0 ? $value : null)->paginate(10);
                $value = $value ? "Да" : 'Нет';
                $info = '(' . Str::ucfirst(Product::getFieldsToShow()[$param]) .': ' . $value .')';

                break;
            default:
                $products = Product::query()->whereBetween($param,[$value - $value * $factor, $value + $value * $factor])->paginate(10);
                $value = $value != 0 ? $value . ' ± ' . $value * $factor :'Нет';
                $info = '(' . Str::ucfirst(Product::getFieldsToShow()[$param]) .': ' . $value . ')';

        }

        return view('products.index', [
            'products' => $products,
            'likes' => app(LikeService::class)->getLikedProductsId(),
            'compareProduct' => session()->get('products.compare') ?? [],
            'param' => $info,

        ]);
    }

}
