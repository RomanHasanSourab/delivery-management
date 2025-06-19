<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\SpecialMerchant;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\Specificity;

class SpecialMerchantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = SpecialMerchant::orderBy('id', 'desc')
                            ->with('sMCreatedBy', 'sMUpdatedBy', 'merchantInfo', 'districtFrom', 'districtTo')
                            ->get();

        $districts = District::orderBy('id', 'desc')->get();
        $merchants = User::where('role_id', 3)->orderBy('id', 'desc')->get();
        // dd($data, $districts, $merchants);
        return view('layouts.backend.special-merchants.index', compact('data', 'districts', 'merchants'));
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
        $input = new SpecialMerchant;
        $input = $request->except(['_token','merchant_code']);
        $input['created_by'] = auth()->user()->id;
        $input['updated_at'] = null;
        $input['merchant_id'] = $request->input('merchant_code');
        SpecialMerchant::create($input);
        return back()->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpecialMerchant  $specialMerchant
     * @return \Illuminate\Http\Response
     */
    public function show(SpecialMerchant $specialMerchant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpecialMerchant  $specialMerchant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = SpecialMerchant::find($id);
        $districts = District::orderBy('id', 'desc')->get();
        $merchantCode = User::where('id', $data->merchant_id)->pluck('code')->first();
        return view('layouts.backend.special-merchants.edit', compact('data', 'districts', 'merchantCode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpecialMerchant  $specialMerchant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->except(['_token', '_method']);
        $input['updated_by'] = auth()->user()->id;
        SpecialMerchant::where('id', $id)->update($input);
        return redirect()->route('special-merchants.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpecialMerchant  $specialMerchant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SpecialMerchant::where('id', $id)->delete();
        return back()->with('success', 'Successfully deleted');
    }
}
