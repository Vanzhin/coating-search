<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalogs\CreateRequest;
use App\Http\Requests\Catalogs\UpdateRequest;
use App\Models\Brand;
use App\Models\Catalog;
use Illuminate\Support\Facades\Config;

class CatalogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogs = Catalog::paginate(Config::get('constants.ITEMS_PER_PAGE'));

        return view('admin.catalogs.index', [
            'catalogs' => $catalogs,
            'fields'=> Catalog::getFieldsToShow(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.catalogs.create', [
            'fields' => Catalog::getFieldsToCreate(),
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

        $created = Catalog::create($data);
        //slug генерируется за счет трейта Sluggable в модели Catalog
        if($created){

            return redirect()->route('admin.catalogs')->with('success', __('messages.admin.catalogs.created.success'));
        }
        return back()->with('error', __('messages.admin.catalogs.created.error'))->withInput();
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
     * @param Catalog $catalog
     * @return \Illuminate\Http\Response
     */
    public function edit(Catalog $catalog)
    {
        return view('admin.catalogs.create', [
            'fields' => Catalog::getFieldsToCreate(),
            'catalog' => $catalog,
            'method' => 'update',
            'param' => $catalog,
            'title' => 'Обновление',
            'button' => 'Обновить'

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Catalog $catalog
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Catalog $catalog)
    {
        $data = $request->validated();
        $catalog->slug = null;
        $updated = $catalog->fill($data)->save();
        if($updated){

            return redirect()->route('admin.catalogs')->with('success', __('messages.admin.catalogs.updated.success'));
        }
        return back()->with('error',__('messages.admin.catalogs.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Catalog $catalog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalog $catalog)
    {
        $deleted = $catalog->delete();
        if($deleted){
            return redirect()->route('admin.catalogs')->with('success', __('messages.admin.catalogs.deleted.success',));
        }
        return back()->with('error', __('messages.admin.catalogs.deleted.error'))->withInput();
    }
}
