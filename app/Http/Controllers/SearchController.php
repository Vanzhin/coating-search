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
use App\Models\Search;
use App\Models\Substrate;
use App\Services\ExtractValuesService;
use App\Services\ProductSearchService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        return view('searches.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectionData= [];
        foreach (Product::getFieldsToMath() as $fieldName){
            $selectionData[$fieldName] = app(ExtractValuesService::class)
                ->getValues('products', $fieldName);
        }

        return view('searches.create', [
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
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $data = app(ProductSearchService::class)->getSearchData($request->validated());
        if (sizeof($data)){


        $title = app(ProductSearchService::class)->getSearchDescription($data);
        dd($title);
        if (Auth::guest()){
            $created = Search::updateOrCreate(
                ['session_token' => $request->session()->get('_token')],
                [
                    'data' => json_encode($data),
                    'description' => 'hello',
                    'session_token' => $request->session()->get('_token')
                ]
            );

        } else {
//            $created = Search::create([
//                'data' => json_encode($data),
//                'token' => $request->session()->get('_token'),
//
//            ]);
        }
        }else {
            return back()->with('error', __('messages.searches.created.empty'))->withInput();

        }


//        $created = app(ProductSearchService::class)
//            ->getProducts($data)->paginate(Config::get('constants.ITEMS_PER_PAGE'));
        if($created){

            return redirect()->route('search.show', [$created])->with('success', __('messages.searches.created.success'));
        }
        return back()->with('error', __('messages.searches.created.error'))->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param Search $search
     * @return \Illuminate\Http\Response
     */
    public function show(Search $search)
    {
        $q = json_decode($search->data, true);

        return view('searches.show', [
            'products' => app(ProductSearchService::class)
            ->getProducts($q)->paginate(Config::get('constants.ITEMS_PER_PAGE')),
            'search' => $search,
        ]);
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
