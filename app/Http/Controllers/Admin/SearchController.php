<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Search;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.searches.index', [
            'searches' => Search::paginate(Config::get('constants.ITEMS_PER_PAGE')),
            'fields'=> Search::getFieldsToShow(),
            'user' => User::query(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Search $search
     * @return \Illuminate\Http\Response
     */
    public function destroy(Search $search)
    {
        $deleted = $search->delete();
        if($deleted){
            return redirect()->route('admin.searches')->with([
                'success' => __('messages.admin.searches.deleted.success'),
                'item' => $search->title,
            ]);
        }
        return back()->with([
            'error' => __('messages.admin.substrates.deleted.error'),
            'item' => $search->title,
        ])->withInput();

    }
}
