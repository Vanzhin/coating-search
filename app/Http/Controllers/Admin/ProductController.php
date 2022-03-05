<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Binder;
use App\Models\Brand;
use App\Models\Catalog;
use App\Models\Environment;
use App\Models\Number;
use App\Models\Product;
use App\Models\Resistance;
use App\Models\Substrate;
use Illuminate\Http\Request;
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
        $products = Product::paginate(Config::get('constants.ITEMS_PER_PAGE'));

        return view('admin.products.index', [
            'products' => $products,
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
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
