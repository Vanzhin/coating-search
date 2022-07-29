<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExports;
use App\Models\Product;
use App\Services\LikeService;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Pdf;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->paginate(config('constants.ITEMS_PER_PAGE'));
        return view('products.index', [
            'products' => $products,
            'likes' => app(LikeService::class)->getLikedProductsId(),
            'compareProduct' => session()->get('products.compare') ?? [],
        ]);
    }

    public function show(Product $product): object
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

    public function compare()
    {
        if (session()->exists('products.compare')) {
            $products = Product::with(Product::relations())->whereIn('id', session('products.compare'))->get();

        } else $products = [];

        return view('products.compare', [
            'products' => $products,
            'linkedFields' => Product::getLinkedFields(),
        ]);
    }

    public function indexBySlug($param, $value)
    {
        //если связь или параметр есть, то вывожу данные, иначе показываю общую инфо
        if (key_exists($param, Product::getFieldsToShow())) {
            $factor = config('constants.FACTOR');
            if ($value == 0) {
                $products = Product::query()
                    ->where($param, $value)
                    ->orWhere($param, '=', null)
                    ->paginate(config('constants.ITEMS_PER_PAGE'));
            } else {
                $products = Product::query()
                    ->whereBetween($param, [$value - abs($value) * $factor, $value + abs($value) * $factor])
                    ->paginate(config('constants.ITEMS_PER_PAGE'));
            }
            $info = $value != 0 ? $value . ' ± ' . abs($value) * $factor : 'Нет';

            if ($param === 'tolerance') {
                $info = $value ? 'Да' : 'Нет';
            }
            $string = '(' . Str::ucfirst(Product::getFieldsToShow()[$param]) . ': ' . $info . ')';

        } else if (method_exists(Product::class, $param)) {
            $string = '\App\Models\\' . ucfirst(Str::singular($param));
            $instance = new $string();
            $model = $instance->where('slug', $value)->first();

            $products = $model->products()->paginate(config('constants.ITEMS_PER_PAGE'));
            //todo подумать как сократить код и убрать это условие
            if (in_array($param, ['brand', 'catalog'])) {
                $info = match ($param) {
                    'brand' => 'Производитель',
                    'catalog' => 'Каталог',
                };
            } else {

                $info = array_key_exists($param, Product::getLinkedFields()) ? Product::getLinkedFields()[$param] : null;
            }
            $string = '(' . Str::upper($info) . ': ' . Str::upper($model->title) . ')';

        } else {
            $products = Product::query()->paginate(config('constants.ITEMS_PER_PAGE'));
        }

        return view('products.index', [
            'products' => $products,
            'likes' => app(LikeService::class)->getLikedProductsId(),
            'compareProduct' => session()->get('products.compare') ?? [],
            'string' => $string,
        ]);
    }

    /**
     * @param array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed $product_ids
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export(array $product_ids = null)
    {
        if (!isset($product_ids)) {
            $product_ids = session('products.compare');
        }
        return Excel::download(new ProductsExports($product_ids), 'products.xlsx');
    }


    public function createPdf()
    {
        $products = Product::with(Product::relations())->whereIn('id', session('products.compare'))->get();
        $pdf = Pdf::loadView('products.pdf', [
            'products' => $products,
            'linkedFields' => Product::getLinkedFields(),
            'fieldsToShow' => Product::getFieldsToShow(),
        ]);

        return $pdf->download('compare_products.pdf');
    }

    public function viewPdf(){
        $products = Product::with(Product::relations())->whereIn('id', session('products.compare'))->get();

        return view('products.pdf',[
            'products' => $products,
            'linkedFields' => Product::getLinkedFields(),
            'fieldsToShow' => Product::getFieldsToShow(),
        ]);

    }

}
