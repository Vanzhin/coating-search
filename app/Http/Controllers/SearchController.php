<?php

namespace App\Http\Controllers;

use App\Http\Requests\Searches\CreateRequest;
use App\Http\Requests\Searches\UpdateRequest;
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
use App\Services\ProductSearchService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()){
            $searches = Search::query()
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->whereIn('status', ['saved', 'active'])->orderByDesc('updated_at')
                ->paginate(Config::get('constants.ITEMS_PER_PAGE'));
        } else $searches = [];
        return view('searches.index',[
            'searches' => $searches
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $selectionData = Product::getSelectionData();

        return view('searches.create', [
            'fields'=> Product::getFieldsToSearch(),
            'fieldsToOrderBy'=> Product::getFieldsToOrderBy(),
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
            'button' => 'Поиск'

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
            // если не зарегистрирован, то сохранять поиски нельзя
            if (Auth::guest()){
                $created = Search::updateOrCreate(
                ['session_token' => $request->session()->get('_token')],
                [
                    'data' => json_encode($data),
                    'description' => app(ProductSearchService::class)->getSearchDescription($data),
                    'session_token' => $request->session()->get('_token')
                ]
            );

        } else {
                $created = Search::updateOrCreate(
                    [
                        'status' => 'active',
                        'user_id' => Auth::user()->getAuthIdentifier()
                    ],
                    [
                        'data' => json_encode($data),
                        'description' => app(ProductSearchService::class)->getSearchDescription($data),
                        'session_token' => $request->session()->get('_token'),
                        'user_id' => Auth::user()->getAuthIdentifier()
                    ]);
            }
        }else {
            return back()->with('error', __('messages.searches.created.empty'))->withInput();

        }
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
        $searchData = json_decode($search->data, true);

        return view('searches.show', [
            'products' => app(ProductSearchService::class)
                ->getProducts($searchData)
                ->paginate(Config::get('constants.ITEMS_PER_PAGE')),
            'search' => $search,
            'searchData' => $searchData,
            'fieldsToOrderBy'=> Product::getFieldsToOrderBy(),
            'fields' => array_merge(Product::getFieldsToCreate(), Product::getLinkedFields()),
            'linkedFields' => Product::getLinkedFields(),
            //если есть данные по сравнению в сессии выдаю их, если нет, то пустой массив
            'compareProduct' => session()->get('products.compare') ?? [],


        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Search $search
     * @return \Illuminate\Http\Response
     */
    public function edit(Search $search)
    {
        $selectionData = Product::getSelectionData();

        return view('searches.create', [
            'fields'=> Product::getFieldsToSearch(),
            'fieldsToOrderBy'=> Product::getFieldsToOrderBy(),
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
            'search' => $search,
            'searchData' => json_decode($search->data, true),
            'method' => 'update',
            'button' => 'Повторить поиск'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Search $search
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Search $search)
    {
        $data = app(ProductSearchService::class)->getSearchData($request->validated());

        if (count($data) == 1 && isset($data['order-by'])){
            $data = array_merge(json_decode($search->data, 1), $data);
        }

        $updatedData = app(ProductSearchService::class)->getUpdatedData($search, $data);

        $updated = $search->fill(
            [
                'data' => json_encode($updatedData),
                'description' => app(ProductSearchService::class)->getSearchDescription($updatedData),
                'session_token' => $request->session()->get('_token'),
                'title' => $data['search_title'] ?? $search->title ?? null,
                'status' => $data['status'] ?? $search->status ?? 'active',
            ]
        )->save();


        if($updated){

            return redirect()->route('search.show', [$search])->with('success', __('messages.searches.updated.success'));
        }
        return back()->with('error', __('messages.searches.updated.error'))->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Search $search
     * @return \Illuminate\Http\Response
     */
    public function destroy(Search $search)
    {

        try {
            $search->status = 'deleted';
            $search->save();
            return response()->json('ok');

        }catch(\Exception $e){
            return response()->json('error', 400);
        }
    }

    public function quickProductSearch(Request $request)
    {
        $request->get('text');
        try {
            return response()->json(app(ProductSearchService::class)->quickSearch($request->get('text')));

        }catch(\Exception $e){
            return response()->json('error', 400);
        }    }
}
