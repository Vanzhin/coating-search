<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Resistances\CreateRequest;
use App\Http\Requests\Resistances\UpdateRequest;
use App\Models\Resistance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ResistanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resistances = Resistance::paginate(Config::get('constants.ITEMS_PER_PAGE'));

        return view('admin.resistances.index', [
            'resistances' => $resistances,
            'fields'=> Resistance::getFieldsToShow(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.resistances.create', [
            'fields' => Resistance::getFieldsToCreate(),
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

        $created = Resistance::create($data);
        //slug генерируется за счет трейта Sluggable в модели Resistance
        if($created){

            return redirect()->route('admin.resistances')->with('success', __('messages.admin.resistances.created.success'));
        }
        return back()->with('error', __('messages.admin.resistances.created.error'))->withInput();
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
     * @param Resistance $resistance
     * @return \Illuminate\Http\Response
     */
    public function edit(Resistance $resistance)
    {
        return view('admin.resistances.create', [
            'fields' => Resistance::getFieldsToCreate(),
            'resistance' => $resistance,
            'method' => 'update',
            'param' => $resistance,
            'title' => 'Обновление',
            'button' => 'Обновить'

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Resistance $resistance
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Resistance $resistance)
    {
        $data = $request->validated();
        $resistance->slug = null;
        $updated = $resistance->fill($data)->save();
        if($updated){

            return redirect()->route('admin.resistances')->with('success', __('messages.admin.resistances.updated.success'));
        }
        return back()->with('error',__('messages.admin.resistances.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Resistance $resistance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resistance $resistance)
    {
        $deleted = $resistance->delete();
        if($deleted){
            return redirect()->route('admin.resistances')->with('success', __('messages.admin.resistances.deleted.success',));
        }
        return back()->with('error', __('messages.admin.resistances.deleted.error'))->withInput();
    }
}
