<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\District;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = User::where('role_id', '4')->where('status', '1')->orderBy('id', 'desc')->with('district')->get();
        return view('layouts.backend.customers.index', compact('datas'));
    }

    public function customerRequest(){
        $datas = User::where('role_id', '4')->where('status', '2')->orderBy('id', 'desc')->with('district')->get();
        return view('layouts.backend.customers.requests', compact('datas'));
    }

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
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        $districts = District::get();
        // dd($districts);
        return view('layouts.backend.customers.edit', compact('data', 'districts'));
    }

    public function customerActive($id){
        User::where('id', $id)->update([
            'status' => 1,
            'code' => 'C'.$id,
        ]);
        return redirect()->route('customer-requests')->with('success', 'Successfully Activated');
    }

    public function update(Request $request, $id)
    {
        $input = $request->except(['_token', '_method']);
        $input['updated_by'] = Auth::user()->id;
        User::where('id', $id)->update($input);
        return redirect()->route('customers.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
