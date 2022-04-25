<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Additives\CreateRequest;
use App\Http\Requests\Additives\UpdateRequest;
use App\Models\Additive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class AdditiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $additives = Additive::paginate(Config::get('constants.ITEMS_PER_PAGE'));

        return view('admin.additives.index', [
            'additives' => $additives,
            'fields'=> Additive::getFieldsToShow(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.additives.create', [
            'fields' => Additive::getFieldsToCreate(),
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

        $created = Additive::create($data);
        //slug генерируется за счет трейта Sluggable в модели Catalog
        if($created){

            return redirect()->route('admin.additives')->with('success', __('messages.admin.additives.created.success'));
        }
        return back()->with('error', __('messages.admin.additives.created.error'))->withInput();
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
     * @param Additive $additive
     * @return \Illuminate\Http\Response
     */
    public function edit(Additive $additive)
    {
        return view('admin.additives.create', [
            'fields' => Additive::getFieldsToCreate(),
            'additive' => $additive,
            'method' => 'update',
            'param' => $additive,
            'title' => 'Обновление',
            'button' => 'Обновить'

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Additive $additive
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Additive $additive)
    {
        $data = $request->validated();
        $additive->slug = null;
        $updated = $additive->fill($data)->save();
        if($updated){

            return redirect()->route('admin.additives')->with('success', __('messages.admin.additives.updated.success'));
        }
        return back()->with('error',__('messages.admin.additives.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Additive $additive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Additive $additive)
    {
        $deleted = $additive->delete();
        if($deleted){
            return redirect()->route('admin.additives')->with('success', __('messages.admin.additives.deleted.success',));
        }
        return back()->with('error', __('messages.admin.additives.deleted.error'))->withInput();
    }
}
