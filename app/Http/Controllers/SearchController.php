<?php

namespace App\Http\Controllers;

use App\Http\Requests\Searches\CreateRequest;
use App\Models\Additive;
use App\Models\Binder;
use App\Models\Brand;
use App\Models\Catalog;
use App\Models\Environment;
use App\Models\Number;
use App\Models\Product;
use App\Models\Resistance;
use App\Models\Substrate;
use App\Services\ExtractValuesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isNull;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $selectionData= [];
         foreach (Product::getFieldsToMath() as $fieldName){
             $selectionData[$fieldName] = app(ExtractValuesService::class)
                 ->getValues('products', $fieldName);
         }

        return view('search', [
            'fields'=> Product::getFieldsToSearch(),
            'brands' => Brand::all(),
            'catalogs' => Catalog::all(),
            'linkedFields' => Product::getLinkedFields(),
            'binders' => Binder::query()->orderBy('title', 'asc')->get(),
            'environments' => Environment::query()->orderBy('title', 'asc')->get(),
            'numbers' => Number::all(),
            'resistances' => Resistance::query()->orderBy('title', 'asc')->get(),
            'substrates' => Substrate::query()->orderBy('title', 'asc')->get(),
            'additives' => Additive::query()->orderBy('title', 'asc')->get(),
            'selectionData' => $selectionData,

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $selectionData= [];
        foreach (Product::getFieldsToMath() as $fieldName){
            $selectionData[$fieldName] = app(ExtractValuesService::class)
                ->getValues('products', $fieldName);
        }
        //проверяю если значение null или меньше меньшего
        $searchData = [];
        foreach ($request->validated() as $key =>$value){
//            dd($request->validated(), $key, $value, $selectionData, key_exists('vs', $selectionData), 54<$selectionData['vs']['min'], !is_null(55));

            if (!is_null($value) && (key_exists($key, $selectionData) && $value >= $selectionData[$key]['min'])){
                $searchData[$key] = $value;
            }
        }
        dd($searchData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

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
