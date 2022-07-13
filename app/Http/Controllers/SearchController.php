<?php

namespace App\Http\Controllers;

use App\Http\Requests\Searches\CreateRequest;
use App\Http\Requests\Searches\UpdateRequest;
use App\Models\Product;
use App\Models\Search;
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
        if (Auth::check()) {
            $searches = Search::query()
                ->where('user_id', Auth::user()->getAuthIdentifier())
                ->where('is_deleted', '=', 0)
                ->orderByDesc('updated_at')
                ->paginate(Config::get('constants.ITEMS_PER_PAGE'));
        } else $searches = [];
        return view('searches.index', [
            'searches' => $searches
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product = null)
    {
        //продукт передается в метод при точном подборе аналога вручную;
        // удаляю из сессии идентификатор поиска
        session()->forget('searchId');

        $data = [
            'product' => $product,
            'fields' => Product::getFieldsToSearch(),
            'fieldsToOrderBy' => Product::getFieldsToOrderBy(),
            'linkedFields' => Product::getLinkedFields(),
            'selectionData' => Product::getSelectionData(),
            'button' => 'Поиск'
        ];
        //todo
        $varsArr = array_merge(Product::getLinkedFields(), ['brands' => 'Производитель', 'catalogs' => 'Каталог']);
        // объединяю массивы с необходимыми данными, то же самое для метода update
        $viewData = array_merge(Product::getRelationsFromArray($varsArr), $data);

        return view('searches.create', $viewData);
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
        $searchId = session('searchId');
        if (sizeof($data)) {
            $dataToFill = [
                'data' => json_encode($data),
                'description' => app(ProductSearchService::class)->getSearchDescription($data),
                'user_id' => Auth::user() ? Auth::user()->getAuthIdentifier() : null,
            ];
            if (is_null($searchId)) {
                $search = Search::create($dataToFill);
                session(['searchId' => $search->id]);
            } else {
                $search = Search::find($searchId);
                $search->fill(
                    $dataToFill
                )->save();
            }
        } else {
            //todo поработать над самим реквестом, потому как сейчас он включает в себя данные, которые не нужны
            return back()->with('error', __('messages.searches.created.empty'));
        }
        if ($search) {

            return redirect()->route('search.show', [$search])->with('success', __('messages.searches.created.success'));
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
        $products = app(ProductSearchService::class)->getProducts($searchData);
        return view('searches.show', [
            'products' => $products->paginate(Config::get('constants.ITEMS_PER_PAGE')),
            'search' => $search,
            'searchData' => $searchData,
            'fieldsToOrderBy' => Product::getFieldsToOrderBy(),
            'fields' => array_merge(Product::getFieldsToCreate(), Product::getLinkedFields()),
            'linkedFields' => Product::getLinkedFields(),
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
        $data = [
            'fields' => Product::getFieldsToSearch(),
            'fieldsToOrderBy' => Product::getFieldsToOrderBy(),
            'linkedFields' => Product::getLinkedFields(),
            'selectionData' => Product::getSelectionData(),
            'search' => $search,
            'searchData' => json_decode($search->data, true),
            'method' => 'update',
            'button' => 'Повторить поиск',
            'product' => null
        ];
        $varsArr = array_merge(Product::getLinkedFields(), ['brands' => 'Производитель', 'catalogs' => 'Каталог']);
        $viewData = array_merge(Product::getRelationsFromArray($varsArr), $data);

        return view('searches.create', $viewData);
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
        if(Auth::user()->getAuthIdentifier() !==  $search->user_id){
            $data['user_id'] = Auth::user()->getAuthIdentifier();
        }
        //todo зачем это?
        if (count($data) == 1 && isset($data['order-by'])) {
            $data = array_merge(json_decode($search->data, 1), $data);
        }
        if (key_exists('search_title', $data)) {
            $data['title'] = $data['search_title'];
            unset($data['search_title']);
            session()->forget('searchId');

        } else{
            $data['data'] = json_encode($data);
            $data['description'] = app(ProductSearchService::class)->getSearchDescription($data);
            unset($data['title']);
            session(['searchId' => $search->id]);

        }

        $updated = $search->fill(
            $data
        )->save();

        if ($updated) {

            return redirect()->route('search.show', $search)->with('success', __('messages.searches.updated.success'));
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
            $search->is_deleted = 1;
            $search->save();
            return response()->json('ok');

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function quickProductSearch(Request $request)
    {
        $request->get('title');
        try {
            return response()->json(app(ProductSearchService::class)->quickSearch($request->get('text')));

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
