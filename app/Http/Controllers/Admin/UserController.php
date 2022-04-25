<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use App\Services\DbService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::paginate(Config::get('constants.ITEMS_PER_PAGE')),
            'fields'=> User::getFieldsToShow(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create', [
            'fields' => User::getFieldsToCreate(),
            'method' => 'store',
            'param' => null,
            'title' => 'Добавление',
            'button' => 'Добавить',
            'statuses' => app(DbService::class)->getEnumValues('users', 'status'),
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
        $created = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => $data['status'],
            'role' => $data['role']
        ]);
        if($created){

            return redirect()->route('admin.users')->with('success', __('messages.admin.users.created.success'));
        }
        return back()->with('error', __('messages.admin.users.created.error'))->withInput();
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
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.create', [
            'fields' => User::getFieldsToUpdate(),
            'method' => 'update',
            'param' => $user,
            'user' => $user,
            'title' => 'Обновление',
            'button' => 'Обновить',
            'statuses' => app(DbService::class)->getEnumValues('users', 'status'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();

        $updated = $user->fill([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => $data['status'],
            'role' => $data['role'],
        ])->save();

        if($updated){
            return redirect()->route('admin.users')->with('success', __('messages.admin.users.updated.success'));
        }
        return back()->with('error', __('messages.admin.users.updated.error'))->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();
        if($deleted){
            return redirect()->route('admin.users')->with('success', __('messages.admin.users.deleted.success'));
        }
        return back()->with('error', __('messages.admin.users.deleted.error'))->withInput();
    }
}
