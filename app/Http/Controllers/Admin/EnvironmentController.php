<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Environments\CreateRequest;
use App\Http\Requests\Environments\UpdateRequest;
use App\Models\Environment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class EnvironmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $environments = Environment::paginate(Config::get('constants.ITEMS_PER_PAGE'));

        return view('admin.environments.index', [
            'environments' => $environments,
            'fields'=> Environment::getFieldsToShow(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.environments.create', [
            'fields' => Environment::getFieldsToCreate(),
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

        $created = Environment::create($data);
        //slug генерируется за счет трейта Sluggable в модели Environment
        if($created){

            return redirect()->route('admin.environments')->with('success', __('messages.admin.environments.created.success'));
        }
        return back()->with('error', __('messages.admin.environments.created.error'))->withInput();
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
     * @param Environment $environment
     * @return \Illuminate\Http\Response
     */
    public function edit(Environment $environment)
    {
        return view('admin.environments.create', [
            'fields' => Environment::getFieldsToCreate(),
            'environment' => $environment,
            'method' => 'update',
            'param' => $environment,
            'title' => 'Обновление',
            'button' => 'Обновить'

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Environment $environment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Environment $environment)
    {
        $data = $request->validated();
        $environment->slug = null;
        $updated = $environment->fill($data)->save();
        if($updated){

            return redirect()->route('admin.environments')->with('success', __('messages.admin.environments.updated.success'));
        }
        return back()->with('error',__('messages.admin.environments.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Additive $additive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Environment $environment)
    {
        $deleted = $environment->delete();
        if($deleted){
            return redirect()->route('admin.environments')->with('success', __('messages.admin.environments.deleted.success',));
        }
        return back()->with('error', __('messages.admin.environments.deleted.error'))->withInput();
    }
}
