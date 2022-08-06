<?php

namespace App\Http\Controllers;

use App\Http\Requests\Compilations\CreateRequest;
use App\Http\Requests\Compilations\UpdateRequest;
use App\Models\Compilation;
use App\Models\Product;
use App\Services\LikeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class CompilationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('compilations.index', [
            'compilations' => Compilation::query()
                ->orderBy('updated_at', 'desc')
                ->paginate(Config::get('constants.ITEMS_PER_PAGE')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        $data['user_id'] = Auth::user()->getAuthIdentifier();
        $created = Compilation::create($data);
        if($created){
            session()->forget('user.compilations');
            $created->products()->attach($request->input('product_id'));
            return back()->with([
                'success' => __('messages.compilations.created.success'),
                'item' => Product::find($request->input('product_id'))->title . ' добавлен в подборку ' .  $created->title,
                ]);
        }
        return back()->with('error', __('messages.compilations.created.error'))->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Compilation  $compilation
     * @return \Illuminate\Http\Response
     */
    public function show(Compilation $compilation)
    {
        return view('compilations.show', [
            'compilation' => $compilation,
            'likes' => app(LikeService::class)->getLikedProductsId(),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Compilation  $compilation
     * @return \Illuminate\Http\Response
     */
    public function edit(Compilation $compilation)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Compilation  $compilation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Compilation $compilation)
    {
        $data = $request->validated();
        $updated = $compilation->fill($data)->save();
        if($updated){
            return back()->with([
                'success' => __('messages.compilations.updated.success'),
            ]);
        }
        return back()->with('error',__('messages.compilations.updated.error'))->withInput();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Compilation  $compilation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Compilation $compilation)
    {
        try {
            $compilation->delete();
            session()->forget('user.compilations');
            return response()->json('ok');

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function addProduct(Product $product, Compilation $compilation)
    {
        if(!$compilation->products->contains($product)) {
            $compilation->products()->attach($product);
            return back()->with([
                'success' => __('messages.compilations.updated.success'),
                'item' => $product->title . ' добавлен в подборку ' .  $compilation->title,
            ]);
        }
        return back()->with('error', __('messages.compilations.updated.error'));

    }

    public function deleteProduct(Product $product, Compilation $compilation)
    {
        if($compilation->products->contains($product)) {
            $compilation->products()->detach($product);
            return back()->with([
                'success' => __('messages.compilations.updated.success'),
                'item' => $product->title . ' удален из подборки ' .  $compilation->title,
            ]);
        }
        return back()->with('error', __('messages.compilations.updated.error'));

    }
    public function moveProduct(Product $product, Compilation $compFrom, Compilation $compTo)
    {
        if($compFrom->products->contains($product) && !$compTo->products->contains($product)) {
            $compFrom->products()->detach($product);
            $compTo->products()->attach($product);
            return back()->with([
                'success' => __('messages.compilations.updated.success'),
                'item' => $product->title . ' перенесен из подборки ' .  $compFrom->title . ' в подборку ' . $compTo->title,
            ]);
        }
        return back()->with('error', __('messages.compilations.updated.error'));

    }
    public function privateHandle(Compilation $compilation)
    {
        try {
            if ($compilation->is_private) {
                $compilation->is_private = false;
            } else {
                $compilation->is_private = true;
            }

            $compilation->save();

            $response['is_private'] = $compilation->is_private;

            return response()->json($response);

        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }

    }
}
