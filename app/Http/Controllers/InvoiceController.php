<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Delivery;
use App\Models\District;
use App\Models\Email;
use App\Models\Helpline;
use App\Models\Invoice;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
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
        return view('layouts.backend.invoice.index');
    }

    public function getInvoice(){
        $data = Invoice::orderBy('id', 'desc')->with('invCreator')->get();
        if(auth()->user()->role_id == 3 || auth()->user()->role_id == 4){
            $data = Invoice::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->get();
        }
        if(auth()->user()->role_id == 2){
            $data = Invoice::where('created_by', auth()->user()->id)->with('invCreator')->orderBy('id', 'desc')->get();
        }

        return DataTables::of($data)
        ->editColumn('date', function($data){
            $date = strtotime($data->created_at);
            return date('d-M-Y | h:i A', $date);

        })
        ->addColumn('creator', function($data){
            return $data->invCreator->name.' || '.$data->invCreator->code;
        })
        ->editColumn('invoice_id', function($data){
            return $data->code;
        })
        ->editColumn('merchant', function($data){
            $merchantId = User::where('id', $data->user_id)->pluck('code')->first();
            $merchant = User::where('id', $data->user_id)->pluck('name')->first();
            return $merchantId.' - '.$merchant;
        })
        ->editColumn('mobile', function($data){
            $phone = User::where('id', $data->user_id)->pluck('phone')->first();
            return $phone;
        })
        ->editColumn('total_deliveries', function($data){
            $ids = explode(',', $data->delivery_id);
            return count($ids);
        })
        ->editColumn('total_payout', function($data){
            $ids = explode(',', $data->delivery_id);

            $collection = Delivery::whereIn('id', $ids)
                                    ->sum('collect_amount');

            $charge = Delivery::whereIn('id', $ids)
                                ->sum('total_charge');

          return $collection - $charge;
        })
        ->addColumn('action', function($data){
            // $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">'.$data->code.'</button>';
            // return $data->id;
            if(auth()->user()->role_id == 1 && auth()->user()->id == 1){
                $data = 1;
            }elseif (auth()->user()->role_id == 1 && auth()->user()->id != 1){
                $data = 3;
            }else{
                $data = 2;
            }
            return $data;
        })
        ->addIndexColumn()
        ->make(true);

    }



    public function getInvoiceInfo(Request $request){
        if(!$request->input('delivery_id') == null){
            $input = new Invoice();
            $input = $request->except(['_token']);
            $input['user_id'] = $input['user_id'];
            $input['delivery_id'] = $input['delivery_id'];
            $input['created_by'] = auth()->user()->id;
            $input['updated_at'] = null;
            Invoice::create($input);
            $invoiceId = Invoice::where('delivery_id', $request->input('delivery_id'))->orderBy('id', 'desc')->pluck('id')->first();
            Invoice::where('id', $invoiceId)->update([
                'code' => 'INV-'.$invoiceId,
            ]);

            return back()->with('success', 'Invoice Successfully Generated');
        }
        return back();
    }

    public function getInvoiceInfoAgent(Request $request){
        if(!$request->input('delivery_id') == null){
            $allDelIds = explode(",", $request->input('delivery_id'));
            $merchants = Delivery::whereIn('id', $allDelIds)->groupBy('created_by')->pluck('created_by')->toArray();

            foreach ($merchants as $merchant){
                $delIds = Delivery::whereIn('id', $allDelIds)->where('created_by', $merchant)->groupBy('id')->pluck('id')->toArray();
                $delIdImplode = implode(",", $delIds);
                $input['user_id'] = $merchant;
                $input['delivery_id'] = $delIdImplode;
                $input['created_by'] = auth()->user()->id;
                $input['updated_at'] = null;
                Invoice::create($input);
                $invoiceId = Invoice::where('delivery_id', $delIdImplode)->orderBy('id', 'desc')->pluck('id')->first();
                Invoice::where('id', $invoiceId)->update([
                    'code' => 'INV-'.$invoiceId,
                ]);
            }

            return back()->with('success', 'Invoice Successfully Generated');
        }
        return back();
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $helplines = Helpline::get();
        $emails = Email::get();
        $addresses = Address::get();

        $invoice = Invoice::find($id);
        $deliveryIds = explode(',', $invoice->delivery_id);
        $userInfo = User::where('id', $invoice->user_id)->first();
        $district = District::where('id', $userInfo->district_id)->first();
        $deliveryInfos = Delivery::whereIn('id', $deliveryIds)->get();

        $collection = Delivery::whereIn('id', $deliveryIds)
                                ->sum('collect_amount');

        $charge = Delivery::whereIn('id', $deliveryIds)
                            ->sum('total_charge');

        $payout = $collection - $charge;

        if (auth()->user()->role_id == 1){
            return view('layouts.backend.invoice.invoice', compact('invoice', 'userInfo', 'deliveryInfos', 'district', 'collection', 'charge', 'payout', 'helplines', 'emails', 'addresses'));
        }else{
            if (auth()->user()->role_id == 3 || auth()->user()->role_id == 4){
                $allInvoices = Invoice::where('user_id', auth()->user()->id)->get()->pluck('id')->toArray();
                if (in_array($id, $allInvoices)){
                    return view('layouts.backend.invoice.invoice', compact('invoice', 'userInfo', 'deliveryInfos', 'district', 'collection', 'charge', 'payout', 'helplines', 'emails', 'addresses'));
                }else{
                    return back();
                }
            }elseif (\auth()->user()->role_id == 2){
                $allInvoices = Invoice::where('created_by', auth()->user()->id)->get()->pluck('id')->toArray();
                if (in_array($id, $allInvoices)){
                    return view('layouts.backend.invoice.invoice', compact('invoice', 'userInfo', 'deliveryInfos', 'district', 'collection', 'charge', 'payout', 'helplines', 'emails', 'addresses'));
                }else{
                    return back();
                }
            }
        }
    }


    public function export($id){
        $helplines = Helpline::get();
        $emails = Email::get();
        $addresses = Address::get();

        $invoice = Invoice::find($id);
        $deliveryIds = explode(',', $invoice->delivery_id);
        $userInfo = User::where('id', $invoice->user_id)->first();
        $district = District::where('id', $userInfo->district_id)->first();
        $deliveryInfos = Delivery::whereIn('id', $deliveryIds)->get();


        $collection = Delivery::whereIn('id', $deliveryIds)
                                ->sum('collect_amount');

        $charge = Delivery::whereIn('id', $deliveryIds)
                            ->sum('total_charge');

        $payout = $collection - $charge;

        if (auth()->user()->role_id == 1){
            return view('layouts.backend.invoice.invoice-pdf', compact('invoice', 'userInfo', 'deliveryInfos', 'district', 'collection', 'charge', 'payout', 'helplines', 'emails', 'addresses'));
        }else{
            if (auth()->user()->role_id == 3 || auth()->user()->role_id == 4){
                $allInvoices = Invoice::where('user_id', auth()->user()->id)->get()->pluck('id')->toArray();
                if (in_array($id, $allInvoices)){
                    return view('layouts.backend.invoice.invoice-pdf', compact('invoice', 'userInfo', 'deliveryInfos', 'district', 'collection', 'charge', 'payout', 'helplines', 'emails', 'addresses'));
                }else{
                    return back();
                }
            }elseif (\auth()->user()->role_id == 2){
                $allInvoices = Invoice::where('created_by', auth()->user()->id)->get()->pluck('id')->toArray();
                if (in_array($id, $allInvoices)){
                    return view('layouts.backend.invoice.invoice-pdf', compact('invoice', 'userInfo', 'deliveryInfos', 'district', 'collection', 'charge', 'payout', 'helplines', 'emails', 'addresses'));
                }else{
                    return back();
                }
            }
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Invoice::where('id', $id)->delete();
        return back()->with('success', 'Successfully deleted');
    }
}
