<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brands\CreateRequest;
use App\Http\Requests\Brands\UpdateRequest;
use App\Models\Brand;
use Illuminate\Support\Facades\Config;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(Config::get('constants.ITEMS_PER_PAGE'));

        return view('admin.brands.index', [
            'brands' => $brands,
            'fields'=> Brand::getFieldsToShow(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create', [
            'fields' => Brand::getFieldsToCreate(),
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

        $created = Brand::create($data);
        //slug генерируется за счет трейта Sluggable в модели Binder
        if($created){

            return redirect()->route('admin.brands')->with('success', __('messages.admin.brands.created.success'));
        }
        return back()->with('error', __('messages.admin.brands.created.error'))->withInput();
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
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.create', [
            'fields' => Brand::getFieldsToCreate(),
            'brand' => $brand,
            'method' => 'update',
            'param' => $brand,
            'title' => 'Обновление',
            'button' => 'Обновить'

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Brand $brand)
    {
        $data = $request->validated();
        $brand->slug = null;
        $updated = $brand->fill($data)->save();
        if($updated){

            return redirect()->route('admin.brands')->with('success', __('messages.admin.brands.updated.success'));
        }
        return back()->with('error',__('messages.admin.brands.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $deleted = $brand->delete();
        if($deleted){
            return redirect()->route('admin.brands')->with('success', __('messages.admin.brands.deleted.success',));
        }
        return back()->with('error', __('messages.admin.brands.deleted.error'))->withInput();
    }
}
