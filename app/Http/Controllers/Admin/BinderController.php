<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Binders\CreateRequest;
use App\Http\Requests\Binders\UpdateRequest;
use App\Models\Binder;
use Illuminate\Support\Facades\Config;

class BinderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $binders = Binder::paginate(Config::get('constants.ITEMS_PER_PAGE'));

        return view('admin.binders.index', [
            'binders' => $binders,
            'fields'=> Binder::getFieldsToShow(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.binders.create', [
            'fields' => Binder::getFieldsToCreate(),
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

        $created = Binder::create($data);
        //slug генерируется за счет трейта Sluggable в модели Binder
        if($created){

            return redirect()->route('admin.binders')->with('success', __('messages.admin.binders.created.success'));
        }
        return back()->with('error', __('messages.admin.binders.created.error'))->withInput();
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
     * @param Binder $binder
     * @return \Illuminate\Http\Response
     */
    public function edit(Binder $binder)
    {
        return view('admin.binders.create', [
            'fields' => Binder::getFieldsToCreate(),
            'binder' => $binder,
            'method' => 'update',
            'param' => $binder,
            'title' => 'Обновление',
            'button' => 'Обновить'

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Binder $binder
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Binder $binder)
    {
        $data = $request->validated();
        $binder->slug = null;
        $updated = $binder->fill($data)->save();
        if($updated){

            return redirect()->route('admin.binders')->with('success', __('messages.admin.binders.updated.success'));
        }
        return back()->with('error',__('messages.admin.binders.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Binder $binder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Binder $binder)
    {
        $deleted = $binder->delete();
        if($deleted){
            return redirect()->route('admin.binders')->with('success', __('messages.admin.binders.deleted.success',));
        }
        return back()->with('error', __('messages.admin.binders.deleted.error'))->withInput();
    }
}
