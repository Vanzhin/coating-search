<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Additive;
use App\Models\Binder;
use App\Models\Brand;
use App\Models\Catalog;
use App\Models\Environment;
use App\Models\Number;
use App\Models\Product;
use App\Models\Resistance;
use App\Models\Substrate;
use App\Services\UploadService;
use Illuminate\Support\Facades\Config;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index', [
            'products' => Product::paginate(Config::get('constants.ITEMS_PER_PAGE')),
            'fields'=> Product::getFieldsToShow(),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create', [
            'fields' => Product::getFieldsToCreate(),
            'brands' => Brand::all(),
            'catalogs' => Catalog::all(),
            'linkedFields' => Product::getLinkedFields(),
            'binders' => Binder::query()->orderBy('title', 'asc')->get(),
            'environments' => Environment::query()->orderBy('title', 'asc')->get(),
            'numbers' => Number::all(),
            'resistances' => Resistance::query()->orderBy('title', 'asc')->get(),
            'substrates' => Substrate::query()->orderBy('title', 'asc')->get(),
            'additives' => Additive::query()->orderBy('title', 'asc')->get(),
            'method' => 'store',
            'param' => null,
            'title' => 'Добавление',
            'button' => 'Добавить'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = $request->validated();
        if($request->hasFile('pds-local')){
            $data['pds'] = app(UploadService::class)
                ->savePds($request->file('pds-local'), 'pds');
        }else{
            $data['pds'] = $data['pds-link'];
        };
        unset($data['pds-link'],$data['pds-local']);

        if(key_exists('tolerance', $data)){
            $data['tolerance'] = 1;
        } else{
            $data['tolerance'] = 0;
        }
        $created = Product::create($data);
        //slug генерируется за счет трейта Sluggable в модели Product
        if($created){

            //заполняю сводные таблицы
            foreach (Product::getLinkedFields() as $key => $item){
                $created->$key()->attach($request->input($key));
            }

            return redirect()->route('admin.products')->with('success', __('messages.admin.products.created.success'));
        }
        return back()->with('error', __('messages.admin.products.created.error'))->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.products.create', [
            'fields' => Product::getFieldsToCreate(),
            'brands' => Brand::all(),
            'catalogs' => Catalog::all(),
            'linkedFields' => Product::getLinkedFields(),
            'binders' => Binder::query()->orderBy('title', 'asc')->get(),
            'environments' => Environment::query()->orderBy('title', 'asc')->get(),
            'numbers' => Number::all(),
            'resistances' => Resistance::query()->orderBy('title', 'asc')->get(),
            'substrates' => Substrate::query()->orderBy('title', 'asc')->get(),
            'additives' => Additive::query()->orderBy('title', 'asc')->get(),
            'product' => $product,
            'method' => 'update',
            'param' => $product,
            'title' => 'Обновление',
            'button' => 'Обновить'

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        if($request->hasFile('pds-local')){
            $data['pds'] = app(UploadService::class)
                ->savePds($request->file('pds-local'), 'pds');
            // если сохранился файл, то старый удаляю
            if ($data['pds']){
                app(UploadService::class)->deletePds($product->pds);
            }
        }else{
            $data['pds'] = $data['pds-link'];
        };
        unset($data['pds-link'],$data['pds-local']);
        $product->slug = null;
        $updated = $product->fill($data)->save();
        if($updated){

            //сначала удаляю старые записи из связанных таблиц, потом записываю новые
            foreach (Product::getLinkedFields() as $key => $item){
                $product->$key()->detach();
                $product->$key()->attach($request->input($key));
            }

            return redirect()->route('admin.products')->with('success', __('messages.admin.products.updated.success'));
        }
        return back()->with('error',__('messages.admin.products.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $deleted = $product->delete();
        if($deleted){
            return redirect()->route('admin.products')->with('success', __('messages.admin.products.deleted.success',));
        }
        return back()->with('error', __('messages.admin.products.deleted.error'))->withInput();
    }
}
