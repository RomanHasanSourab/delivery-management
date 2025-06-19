<?php

namespace App\Http\Controllers;

use App\Models\PaymentRequests;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PaymentRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role_id != 1 && auth()->user()->status == 2 || auth()->user()->status == 3){
            // return abort(403, 'Your account is not activate.');
            return view('layouts.backend.dashboard.not-active');
        }
        if(auth()->user()->role_id == 1){
            return view('layouts.backend.payment-request.index-admin');
        }else{
            return view('layouts.backend.payment-request.index');
        }
    }

    public function getRequest(){

        if(auth()->user()->role_id == 1){
            $data = PaymentRequests::orderBy('id', 'desc')->get();
        }else{
            $data = PaymentRequests::where('created_by', auth()->user()->id)->orderBy('id', 'desc')->with('requestCreatedBy', 'requestUpdatedBy')->get();
        }

        return DataTables::of($data)
        ->addColumn('checkbox', function ($data) {
            $checkbox = '<input name="checkGroup" type="checkbox" class="checkAll" value=' . $data->id . '>';
            return $checkbox;
        })
        ->editColumn('date', function($data){
            $date= strtotime($data->created_at);
            return date('d-M-Y | h:i A', $date);

        })
        ->editColumn('merchant', function($data){
            $name = $data->requestCreatedBy->name;
            $code = $data->requestCreatedBy->code;
            return $code.' - '.$name;
        })
        ->editColumn('description', function($data){
            return $data->description;
        })
        ->editColumn('status', function($data){

                if($data->status == 1){
                    $status = '<span class="badge badge-pill badge-success">'.'Solved'.'</span>';
                }else{
                    $status = '<span class="badge badge-pill badge-secondary">'.'Pending'.'</span>';
                }
            return $status;
        })
        ->editColumn('feedback', function($data){
            return $data->feedback;
        })
        ->rawColumns(['checkbox', 'status'])
        ->addIndexColumn()
        ->make(true);

        return view('layouts.backend.payment-request.index');
    }


    public function solveRequest(Request $request)
    {
        if(!$request->input('id') == null){
            $reqId = $request->input('id');
            $ids = explode(',', $reqId);

            foreach($ids as $id){
                PaymentRequests::where('id', $id)->update([
                    'status' => 1,
                    'updated_by' => auth()->user()->id,
                    'updated_at' => Carbon::now(),
                ]);
            }
            return back()->with('success', "Successfully Status Set 'Solved'");
        }
        return back();
    }

    public function pendingRequest(Request $request)
    {
        if(!$request->input('id') == null){
            $reqId = $request->input('id');
            $ids = explode(',', $reqId);

            foreach($ids as $id){
                PaymentRequests::where('id', $id)->update([
                    'status' => null,
                    'updated_by' => auth()->user()->id,
                    'updated_at' => Carbon::now(),
                ]);
            }
            return back()->with('success', "Successfully Status Set 'Pending'");
        }
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = new PaymentRequests;
        $input = $request->except(['_token']);
        $input['created_by'] = Auth::user()->id;
        $input['updated_at'] = null;
        PaymentRequests::create($input);
        return back()->with('success', 'Successfully Sent Payment Request');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PaymentRequests  $paymentRequests
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentRequests $paymentRequests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PaymentRequests  $paymentRequests
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentRequests $paymentRequests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PaymentRequests  $paymentRequests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentRequests $paymentRequests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PaymentRequests  $paymentRequests
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentRequests $paymentRequests)
    {
        //
    }
}
