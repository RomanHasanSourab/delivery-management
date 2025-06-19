<?php

namespace App\Http\Controllers;

use App\Models\AddRateInfo;
use Illuminate\Http\Request;

class AddRateInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AddRateInfo::orderBy('id', 'desc')->with('rateInfoCreatedBy', 'rateInfoUpdatedBy')->get();
        return view('layouts.backend.rate-info.index', compact('data'));
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
        $input = new AddRateInfo;
        $input = $request->except(['_token']);
        $input['created_by'] = auth()->user()->id;
        $input['updated_at'] = null;
        AddRateInfo::create($input);
        return back()->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AddRateInfo  $addRateInfo
     * @return \Illuminate\Http\Response
     */
    public function show(AddRateInfo $addRateInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AddRateInfo  $addRateInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(AddRateInfo $addRateInfo, $id)
    {
        $data = AddRateInfo::find($id);
        return view('layouts.backend.rate-info.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AddRateInfo  $addRateInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except(['_token', '_method']);
        $input['updated_by'] = auth()->user()->id;
        AddRateInfo::where('id', $id)->update($input);
        return redirect()->route('admin-rate-info.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AddRateInfo  $addRateInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AddRateInfo::where('id', $id)->delete();
        return back()->with('success', 'Successfully deleted');
    }
}
