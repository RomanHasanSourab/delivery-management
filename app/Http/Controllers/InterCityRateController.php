<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\InterCityRate;
use Illuminate\Http\Request;

class InterCityRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = InterCityRate::orderBy('id', 'desc')
                                ->with('cityRateCreatedBy', 'cityRateUpdatedBy', 'districtFrom', 'districtTo')
                                ->get();

        $districts = District::orderBy('id', 'desc')->get();
        return view('layouts.backend.inter-city-rates.index', compact('data', 'districts'));
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
        $input = new InterCityRate;
        $input = $request->except(['_token']);
        $input['created_by'] = auth()->user()->id;
        $input['updated_at'] = null;
        $input['district_id'] = $request->input('district_id_from');
        InterCityRate::create($input);
        return back()->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InterCityRate  $interCityRate
     * @return \Illuminate\Http\Response
     */
    public function show(InterCityRate $interCityRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InterCityRate  $interCityRate
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = InterCityRate::find($id);
        $districts = District::orderBy('id', 'desc')->get();
        return view('layouts.backend.inter-city-rates.edit', compact('data', 'districts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InterCityRate  $interCityRate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except(['_token', '_method']);
        $input['updated_by'] = auth()->user()->id;
        InterCityRate::where('id', $id)->update($input);
        return redirect()->route('admin-inter-city-rates.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InterCityRate  $interCityRate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InterCityRate::where('id', $id)->delete();
        return back()->with('success', 'Successfully deleted');
    }
}
