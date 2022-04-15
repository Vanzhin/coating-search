<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Numbers\CreateRequest;
use App\Http\Requests\Numbers\UpdateRequest;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class NumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numbers = Number::paginate(Config::get('constants.ITEMS_PER_PAGE'));

        return view('admin.numbers.index', [
            'numbers' => $numbers,
            'fields'=> Number::getFieldsToShow(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.numbers.create', [
            'fields' => Number::getFieldsToCreate(),
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

        $created = Number::create($data);
        //slug генерируется за счет трейта Sluggable в модели Number
        if($created){

            return redirect()->route('admin.numbers')->with('success', __('messages.admin.numbers.created.success'));
        }
        return back()->with('error', __('messages.admin.numbers.created.error'))->withInput();
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
     * @param Number $number
     * @return \Illuminate\Http\Response
     */
    public function edit(Number $number)
    {
        return view('admin.numbers.create', [
            'fields' => Number::getFieldsToCreate(),
            'number' => $number,
            'method' => 'update',
            'param' => $number,
            'title' => 'Обновление',
            'button' => 'Обновить'

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Number $number
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Number $number)
    {
        $data = $request->validated();
        $number->slug = null;
        $updated = $number->fill($data)->save();
        if($updated){

            return redirect()->route('admin.numbers')->with('success', __('messages.admin.numbers.updated.success'));
        }
        return back()->with('error',__('messages.admin.numbers.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Number $number
     * @return \Illuminate\Http\Response
     */
    public function destroy(Number $number)
    {
        $deleted = $number->delete();
        if($deleted){
            return redirect()->route('admin.numbers')->with('success', __('messages.admin.numbers.deleted.success',));
        }
        return back()->with('error', __('messages.admin.numbers.deleted.error'))->withInput();
    }
}
