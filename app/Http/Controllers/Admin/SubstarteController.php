<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Substrates\CreateRequest;
use App\Http\Requests\Substrates\UpdateRequest;
use App\Models\Substrate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SubstarteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $substartes = Substrate::paginate(Config::get('constants.ITEMS_PER_PAGE'));

        return view('admin.substrates.index', [
            'substrates' => $substartes,
            'fields'=> Substrate::getFieldsToShow(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.substrates.create', [
            'fields' => Substrate::getFieldsToCreate(),
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

        $created = Substrate::create($data);
        //slug генерируется за счет трейта Sluggable в модели Substrate
        if($created){

            return redirect()->route('admin.substrates')->with('success', __('messages.admin.substrates.created.success'));
        }
        return back()->with('error', __('messages.admin.substrates.created.error'))->withInput();
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
     * @param Substrate $substrate
     * @return \Illuminate\Http\Response
     */
    public function edit(Substrate $substrate)
    {
        return view('admin.substrates.create', [
            'fields' => Substrate::getFieldsToCreate(),
            'substrate' => $substrate,
            'method' => 'update',
            'param' => $substrate,
            'title' => 'Обновление',
            'button' => 'Обновить'

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Substrate $substrate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Substrate $substrate)
    {
        $data = $request->validated();
        $substrate->slug = null;
        $updated = $substrate->fill($data)->save();
        if($updated){

            return redirect()->route('admin.substrates')->with('success', __('messages.admin.substrates.updated.success'));
        }
        return back()->with('error',__('messages.admin.substrates.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Substrate $substrate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Substrate $substrate)
    {
        $deleted = $substrate->delete();
        if($deleted){
            return redirect()->route('admin.substrates')->with('success', __('messages.admin.substrates.deleted.success',));
        }
        return back()->with('error', __('messages.admin.substrates.deleted.error'))->withInput();
    }
}
