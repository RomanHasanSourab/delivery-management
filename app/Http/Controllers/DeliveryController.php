<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Delivery;
use App\Models\DeliveryStatus;
use App\Models\District;
use App\Models\Email;
use App\Models\Helpline;
use App\Models\InterCityRate;
use App\Models\SpecialMerchant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agents = User::where('role_id', 2)->where('status', 1)->orderBy('id', 'desc')->get();
        $data = Delivery::where('created_by', auth()->user()->id)->orderBy('id', 'desc')->get();
        $districts = District::orderBy('id', 'desc')->get();
        $selfCity = User::where('id', auth()->user()->id)->with('district')->first();
        if(auth()->user()->role_id != 1 && auth()->user()->status == 2 || auth()->user()->status == 3){
            // return abort(403, 'Your account is not activate.');
            return view('layouts.backend.dashboard.not-active');
        }else{
            return view('layouts.backend.deliveries.index', compact('data', 'districts', 'selfCity', 'agents'));
        }
    }

    public function indexAdmin()
    {
        $agents = User::where('role_id', 2)->where('status', 1)->orderBy('id', 'desc')->get();
        $data = Delivery::orderBy('id', 'desc')->with('deliveryTo', 'deliveryFrom', 'deliveryCreatedBy', 'status')->get();
        $districts = District::orderBy('id', 'desc')->get();
        $from = User::with(['district', 'role'])->get();
        if(auth()->user()->role_id != 1 && auth()->user()->status == 2){
            return abort(403, 'Your account is not activate.');
        }else{
            if (\auth()->user()->role_id == 2){
                return view('layouts.backend.deliveries.index-agent', compact('data', 'districts', 'from', 'agents'));
            }
            return view('layouts.backend.deliveries.index-admin', compact('data', 'districts', 'from', 'agents'));
        }
    }

    public function getIndexAdmin(){
        if(auth()->user()->role_id == 1){
            $data = Delivery::where('delivery_status', 1)->orderBy('id', 'desc')->with('deliveryTo', 'deliveryFrom', 'deliveryCreatedBy', 'agent')->get();
        }else{
            $data = Delivery::where('created_by', auth()->user()->id)->orderBy('id', 'desc')->with('deliveryTo', 'deliveryFrom', 'deliveryCreatedBy')->get();
        }

        $districts = District::orderBy('id', 'desc')->get();
        $from = User::with(['district', 'role'])->get();
        return DataTables::of($data)
        ->addColumn('checkbox', function ($data) {
            $checkbox = '<input name="checkGroup" type="checkbox" class="checkAll" value=' . $data->id . '>';
            return $checkbox;
        })
        ->editColumn('date', function($data){
            $date= strtotime($data->created_at);
            return date('d-M-Y | h:i A', $date);

        })
        ->addColumn('assign', function($data){
            if (isset($data->agent)){
                return $data->agent['code'].' | '.$data->agent['name'];
            }

        })
        ->editColumn('merchant', function($data){
            return $data->deliveryCreatedBy->name;
        })
        ->editColumn('from', function($data){
            if($data->deliveryFrom){
                return $data->deliveryFrom->title;
            }
        })
        ->editColumn('to', function($data){
            if($data->deliveryTo){
                return $data->deliveryTo->title;
            }
        })
        ->editColumn('payout', function($data){
            $payout = $data->collect_amount - $data->total_charge;
            return $payout;
        })
        ->editColumn('delivery_status_id', function($data){
            $status = $data->delivery_status;
            return $status;
        })
        ->editColumn('delivery_status', function($data){
            if($data->status){
                if($data->status->id == 1){
                    $status = '<span class="badge badge-pill badge-secondary">'.$data->status->title.'</span>';
                }elseif($data->status->id == 2){
                    $status = '<span class="badge badge-pill badge-info">'.$data->status->title.'</span>';
                }elseif($data->status->id == 3){
                    $status = '<span class="badge badge-pill badge-success">'.$data->status->title.'</span>';
                }elseif($data->status->id == 4){
                    $statusW = '<span class="badge badge-pill badge-warning">'.$data->status->title.'</span>';
                    $status = nl2br("$statusW\nClick on 'View' button to see remark");
                }elseif($data->status->id == 5){
                    $statusW = '<span class="badge badge-pill badge-danger">'.$data->status->title.'</span>';
                    $status = nl2br("$statusW\nClick on 'View' button to see remark");
                }
            }else{
                $status = null;
            }
            $dateTime= strtotime($data->delivery_status_changed_at);
            $date = date('d-M-Y', $dateTime);
            $time = date('h:i A', $dateTime);
            // return nl2br("$status.\n$date.\n$time");
            return $status;
        })
        ->editColumn('payment_status', function($data){
            if($data->paid_status == 1){
                $status = '<span class="badge badge-pill badge-success">Paid</span>';
            }elseif($data->paid_status == 2){
                $status = null;
            }else{
                $status = null;
            }
            return $status;
        })
        ->editColumn('delivery_type', function($data){
            if($data->delivery_type == 1){
                return 'Standard delivery';
            }elseif($data->delivery_type == 2){
                return 'Food delivery';
            }elseif($data->delivery_type == 3){
                return 'Urgent delivery( within 6 hours)';
            }
        })
        ->addColumn('action', function($data){
            // $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">'.$data->code.'</button>';
            // return $data->id;
            return $data;
        })
        ->rawColumns(['checkbox', 'delivery_status', 'payment_status'])
        ->addIndexColumn()
        ->make(true);

        return view('layouts.backend.deliveries.index-admin');
    }


    public function getIndexAgent(){

        $data = Delivery::where('assigned_agent_id', auth()->user()->id)->where('delivery_status', 1)->orderBy('id', 'desc')->with('deliveryTo', 'deliveryFrom', 'deliveryCreatedBy')->get();

        $districts = District::orderBy('id', 'desc')->get();
        $from = User::with(['district', 'role'])->get();
        return DataTables::of($data)
            ->addColumn('checkbox', function ($data) {
                $checkbox = '<input name="checkGroup" type="checkbox" class="checkAll" value=' . $data->id . '>';
                return $checkbox;
            })
            ->editColumn('date', function($data){
                $date= strtotime($data->created_at);
                return date('d-M-Y | h:i A', $date);

            })
            ->addColumn('assign', function($data){
                if (isset($data->agent)){
                    return $data->agent['code'].' | '.$data->agent['name'];
                }

            })
            ->editColumn('merchant', function($data){
                return $data->deliveryCreatedBy->name;
            })
            ->editColumn('from', function($data){
                if($data->deliveryFrom){
                    return $data->deliveryFrom->title;
                }
            })
            ->editColumn('to', function($data){
                if($data->deliveryTo){
                    return $data->deliveryTo->title;
                }
            })
            ->editColumn('payout', function($data){
                $payout = $data->collect_amount - $data->total_charge;
                return $payout;
            })
            ->editColumn('delivery_status_id', function($data){
                $status = $data->delivery_status;
                return $status;
            })
            ->editColumn('delivery_status', function($data){
                if($data->status){
                    if($data->status->id == 1){
                        $status = '<span class="badge badge-pill badge-secondary">'.$data->status->title.'</span>';
                    }elseif($data->status->id == 2){
                        $status = '<span class="badge badge-pill badge-info">'.$data->status->title.'</span>';
                    }elseif($data->status->id == 3){
                        $status = '<span class="badge badge-pill badge-success">'.$data->status->title.'</span>';
                    }elseif($data->status->id == 4){
                        $statusW = '<span class="badge badge-pill badge-warning">'.$data->status->title.'</span>';
                        $status = nl2br("$statusW\nClick on 'View' button to see remark");
                    }elseif($data->status->id == 5){
                        $statusW = '<span class="badge badge-pill badge-danger">'.$data->status->title.'</span>';
                        $status = nl2br("$statusW\nClick on 'View' button to see remark");
                    }
                }else{
                    $status = null;
                }
                $dateTime= strtotime($data->delivery_status_changed_at);
                $date = date('d-M-Y', $dateTime);
                $time = date('h:i A', $dateTime);
                // return nl2br("$status.\n$date.\n$time");
                return $status;
            })
            ->editColumn('payment_status', function($data){
                if($data->paid_status == 1){
                    $status = '<span class="badge badge-pill badge-success">Paid</span>';
                }elseif($data->paid_status == 2){
                    $status = null;
                }else{
                    $status = null;
                }
                return $status;
            })
            ->editColumn('delivery_type', function($data){
                if($data->delivery_type == 1){
                    return 'Standard delivery';
                }elseif($data->delivery_type == 2){
                    return 'Food delivery';
                }elseif($data->delivery_type == 3){
                    return 'Urgent delivery( within 6 hours)';
                }
            })
            ->addColumn('action', function($data){
                // $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">'.$data->code.'</button>';
                // return $data->id;
                return $data;
            })
            ->rawColumns(['checkbox', 'delivery_status', 'payment_status'])
            ->addIndexColumn()
            ->make(true);

    }

    public function indexAll()
    {
        $agents = User::where('role_id', 2)->where('status', 1)->orderBy('id', 'desc')->get();
        $data = Delivery::orderBy('id', 'desc')->with('deliveryTo', 'deliveryFrom', 'deliveryCreatedBy', 'status')->get();
        $districts = District::orderBy('id', 'desc')->get();
        $from = User::with(['district', 'role'])->get();
        if(auth()->user()->role_id != 1 && auth()->user()->status == 2){
            return abort(403, 'Your account is not activate.');
        }else
        return view('layouts.backend.deliveries.index-all-delivery', compact('data', 'districts', 'from', 'agents'));
    }

    public function getAll(){
        if(auth()->user()->role_id == 1){
            $data = Delivery::orderBy('id', 'desc')->with('deliveryTo', 'deliveryFrom', 'deliveryCreatedBy', 'agent')->get();
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
        ->addColumn('assign', function($data){
            if (isset($data->agent)){
                return $data->agent['code'].' | '.$data->agent['name'];
            }

        })
        ->editColumn('merchant', function($data){
            return $data->deliveryCreatedBy->name;
        })
        ->editColumn('from', function($data){
            if($data->deliveryFrom){
                return $data->deliveryFrom->title;
            }
        })
        ->editColumn('to', function($data){
            if($data->deliveryTo){
                return $data->deliveryTo->title;
            }
        })
        ->editColumn('payout', function($data){
            $payout = $data->collect_amount - $data->total_charge;
            return $payout;
        })
        ->editColumn('delivery_status_id', function($data){
            $status = $data->delivery_status;
            return $status;
        })
        ->editColumn('delivery_status', function($data){
            if($data->status){
                if($data->status->id == 1){
                    $status = '<span class="badge badge-pill badge-secondary">'.$data->status->title.'</span>';
                }elseif($data->status->id == 2){
                    $status = '<span class="badge badge-pill badge-info">'.$data->status->title.'</span>';
                }elseif($data->status->id == 3){
                    $status = '<span class="badge badge-pill badge-success">'.$data->status->title.'</span>';
                }elseif($data->status->id == 4){
                    $statusW = '<span class="badge badge-pill badge-warning">'.$data->status->title.'</span>';
                    $status = nl2br("$statusW\nClick on 'View' button to see remark");
                }elseif($data->status->id == 5){
                    $statusW = '<span class="badge badge-pill badge-danger">'.$data->status->title.'</span>';
                    $status = nl2br("$statusW\nClick on 'View' button to see remark");
                }
            }else{
                $status = null;
            }
            $dateTime= strtotime($data->delivery_status_changed_at);
            $date = date('d-M-Y', $dateTime);
            $time = date('h:i A', $dateTime);
            // return nl2br("$status.\n$date.\n$time");
            return $status;
        })
        ->editColumn('payment_status', function($data){
            if($data->paid_status == 1){
                $status = '<span class="badge badge-pill badge-success">Paid</span>';
            }elseif($data->paid_status == 2){
                $status = null;
            }else{
                $status = null;
            }
            return $status;
        })
        ->editColumn('delivery_type', function($data){
            if($data->delivery_type == 1){
                return 'Standard delivery';
            }elseif($data->delivery_type == 2){
                return 'Food delivery';
            }elseif($data->delivery_type == 3){
                return 'Urgent delivery( within 6 hours)';
            }
        })
        ->addColumn('action', function($data){
            // $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">'.$data->code.'</button>';
            // return $data->id;
            return $data;
        })
        ->rawColumns(['checkbox', 'delivery_status', 'payment_status'])
        ->addIndexColumn()
        ->make(true);

        return view('layouts.backend.deliveries.index-all-delivery');
    }

    public function manageDelivery(Request $request){

        $userId = $request->input('user_id');
        $data = Delivery::where('created_by', $userId)->orderBy('id', 'desc')->with('deliveryTo', 'deliveryFrom', 'deliveryCreatedBy')->get();

        $districts = District::orderBy('id', 'desc')->get();
        $from = User::with(['district', 'role'])->get();
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
            return $data->deliveryCreatedBy->name;
        })
        ->editColumn('from', function($data){
            if($data->deliveryFrom){
                return $data->deliveryFrom->title;
            }
        })
        ->editColumn('to', function($data){
            if($data->deliveryTo){
                return $data->deliveryTo->title;
            }
        })
        ->editColumn('payout', function($data){
            $payout = $data->collect_amount - $data->total_charge;
            return $payout;
        })
        ->editColumn('delivery_status_id', function($data){
            $status = $data->delivery_status;
            return $status;
        })
        ->editColumn('delivery_status', function($data){
            if($data->status){
                if($data->status->id == 1){
                    $status = '<span class="badge badge-pill badge-secondary">'.$data->status->title.'</span>';
                }elseif($data->status->id == 2){
                    $status = '<span class="badge badge-pill badge-info">'.$data->status->title.'</span>';
                }elseif($data->status->id == 3){
                    $status = '<span class="badge badge-pill badge-success">'.$data->status->title.'</span>';
                }elseif($data->status->id == 4){
                    $statusW = '<span class="badge badge-pill badge-warning">'.$data->status->title.'</span>';
                    $status = nl2br("$statusW\nClick on 'View' button to see remark");
                }elseif($data->status->id == 5){
                    $statusW = '<span class="badge badge-pill badge-danger">'.$data->status->title.'</span>';
                    $status = nl2br("$statusW\nClick on 'View' button to see remark");
                }
            }else{
                $status = null;
            }
            $dateTime= strtotime($data->delivery_status_changed_at);
            $date = date('d-M-Y', $dateTime);
            $time = date('h:i A', $dateTime);
            // return nl2br("$status.\n$date.\n$time");
            return $status;
        })
        ->editColumn('payment_status', function($data){
            if($data->paid_status == 1){
                $status = '<span class="badge badge-pill badge-success">Paid</span>';
            }elseif($data->paid_status == 2){
                $status = null;
            }else{
                $status = null;
            }
            return $status;
        })
        ->editColumn('delivery_type', function($data){
            if($data->delivery_type == 1){
                return 'Standard delivery';
            }elseif($data->delivery_type == 2){
                return 'Food delivery';
            }elseif($data->delivery_type == 3){
                return 'Urgent delivery( within 6 hours)';
            }
        })
        ->addColumn('action', function($data){
            // $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">'.$data->code.'</button>';
            // return $data->id;
            return $data;
        })
        ->rawColumns(['checkbox', 'delivery_status', 'payment_status'])
        ->addIndexColumn()
        ->make(true);

        return view('layouts.backend.merchants.manage', compact('userId'));
    }



    public function getDeliveryInfo(Request $request){

        $id=$request->input('data');

        $data = Delivery::where('id', $id)->first();
        $relation = Delivery::where('id', $id)->with('deliveryCreatedBy')->first();
        $relData = $relation->deliveryCreatedBy;
        if($relation->delivery_type == 1){
            $delType = 'Standard delivery';
        }elseif($relation->delivery_type == 2){
            $delType = 'Food delivery';
        }elseif($relation->delivery_type == 3){
            $delType = 'Urgent delivery( within 6 hours)';
        }
        $cityFrom = District::where('id', $data->district_id_from)->pluck('title')->first();
        $cityTo = District::where('id', $data->district_id)->pluck('title')->first();
        $totalPayout = $data->collect_amount - $data->total_charge;
        $status = DeliveryStatus::where('id', $data->delivery_status)->pluck('title')->first();

        // $dateTime= strtotime($data->created_at);
        $dateTime = date('d-M-Y | h:i A', strtotime($data->created_at));

        if($data->paid_status == 1){
            $paymentStatus = 'Paid';
        }elseif($data->paid_status == 2){
            $paymentStatus = 'Pending';
        }

       return json_encode([$data,$relData, $delType, $totalPayout, $cityFrom, $cityTo, $status, $paymentStatus, $dateTime]);

        //return $data;
    }

    public function noStatus(Request $request)
    {
        if(!$request->input('id') == null){
            $reqId = $request->input('id');
            $ids = explode(',', $reqId);

            foreach($ids as $id){
                Delivery::where('id', $id)->update([
                    'delivery_status' => 1,
                    'delivery_status_changed_by' => auth()->user()->id,
                    'delivery_status_changed_at' => null,
                ]);
            }
            // return redirect()->route('deliveries-admin')->with('success', 'Successfully Delivered');
            return back()->with('success', 'Successfully Status Done No Status Yet');
        }
        return back();
    }
    public function delivered(Request $request)
    {
        if(!$request->input('id') == null){
            $reqId = $request->input('id');
            $ids = explode(',', $reqId);

            foreach($ids as $id){
                Delivery::where('id', $id)->update([
                    'delivery_status' => 3,
                    'delivery_status_changed_by' => auth()->user()->id,
                    'delivery_status_changed_at' => Carbon::now(),
                ]);
            }
            // return redirect()->route('deliveries-admin')->with('success', 'Successfully Delivered');
            return back()->with('success', 'Successfully Status Done Delivered');
        }
        return back();
    }
    public function pickup(Request $request)
    {
        if(!$request->input('id') == null){
            $reqId = $request->input('id');
            $ids = explode(',', $reqId);

            foreach($ids as $id){
                Delivery::where('id', $id)->update([
                    'delivery_status' => 2,
                    'delivery_status_changed_by' => auth()->user()->id,
                    'delivery_status_changed_at' => null,
                ]);
            }
            return back()->with('success', 'Successfully Status Done Pickuped');
        }
        return back();
    }
    public function cancel(Request $request)
    {
        if(!$request->input('id') == null){
            $reqId = $request->input('id');
            $ids = explode(',', $reqId);

            foreach($ids as $id){
                Delivery::where('id', $id)->update([
                    'delivery_status' => 5,
                    'delivery_remark' => $request->input('delivery_remark'),
                    'delivery_status_changed_by' => auth()->user()->id,
                    'delivery_status_changed_at' => null,
                ]);
            }
            return back()->with('success', 'Successfully Status Done Pickuped');
        }
        return back();
    }
    public function hold(Request $request)
    {
        if(!$request->input('id') == null){
            $reqId = $request->input('id');
            $ids = explode(',', $reqId);

            foreach($ids as $id){
                Delivery::where('id', $id)->update([
                    'delivery_status' => 4,
                    'delivery_remark' => $request->input('delivery_remark'),
                    'delivery_status_changed_by' => auth()->user()->id,
                    'delivery_status_changed_at' => null,
                ]);
            }
            return back()->with('success', 'Successfully Status Done Pickuped');
        }
        return back();
    }
    public function paid(Request $request)
    {
        if(!$request->input('id') == null){
            $reqId = $request->input('id');
            $ids = explode(',', $reqId);

            foreach($ids as $id){
                Delivery::where('id', $id)->update([
                    'paid_status' => 1,
                    'paid_status_changed_by' => auth()->user()->id,
                    'paid_at' => Carbon::now(),
                ]);
            }
            return back()->with('success', 'Successfully Status Done Paid');
        }
        return back();
    }
    public function unPaid(Request $request)
    {
        if(!$request->input('id') == null){
            $reqId = $request->input('id');
            $ids = explode(',', $reqId);

            foreach($ids as $id){
                Delivery::where('id', $id)->update([
                    'paid_status' => 2,
                    'paid_status_changed_by' => auth()->user()->id,
                    'paid_at' => Carbon::now(),
                ]);
            }
            return back()->with('success', 'Successfully Status Done Unpaid');
        }
        return back();
    }

    public function printInfoDelivery($id){
        $delivery = Delivery::with('deliveryFrom', 'deliveryTo')->find($id);
        $userInfo = User::where('id', $delivery->created_by)->first();
        $helplines = Helpline::get();
        $emails = Email::get();
        $addresses = Address::get();
        if (\auth()->user()->role_id == 1){
            return view('layouts.backend.deliveries.print-delivery-info', compact('delivery', 'userInfo', 'helplines', 'emails', 'addresses'));
        }else{
            if (\auth()->user()->role_id == 3 || \auth()->user()->role_id == 4){
                $availDelIds = Delivery::where('created_by', \auth()->user()->id)->get()->pluck('id')->toArray();
                if (in_array($id, $availDelIds)){
                    return view('layouts.backend.deliveries.print-delivery-info', compact('delivery', 'userInfo', 'helplines', 'emails', 'addresses'));
                }else{
                    return back();
                }
            }elseif (\auth()->user()->role_id == 2){
                $availDelIds = Delivery::where('assigned_agent_id', \auth()->user()->id)->get()->pluck('id')->toArray();
                if (in_array($id, $availDelIds)){
                    return view('layouts.backend.deliveries.print-delivery-info', compact('delivery', 'userInfo', 'helplines', 'emails', 'addresses'));
                }else{
                    return back();
                }
            }
        }
    }

    public function printInfoPickup($id){
        $delivery = Delivery::with('deliveryFrom', 'deliveryTo')->find($id);
        $userInfo = User::where('id', $delivery->created_by)->first();
        $helplines = Helpline::get();
        $emails = Email::get();
        $addresses = Address::get();
        return view('layouts.backend.deliveries.print-pickup-info', compact('delivery', 'userInfo', 'helplines', 'emails', 'addresses'));
    }

    public function delete(Request $request){
        $reqId = $request->input('id');
        $ids = explode(',', $reqId);
        Delivery::whereIn('id', $ids)->delete();
        return back()->with('success', 'Successfully deleted');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(strlen((string)$request->input('phone')) != 11){
            return back()->with('error', 'Phone number must be 11 digits');
        }
        // $request->validate([
        //     'phone' => ['required', 'digits:11'],
        // ]);


        $self_district_id = auth()->user()->district_id;
        $specialIds = SpecialMerchant::get()->pluck('merchant_id');
        $total_charge = null;
        if(count($specialIds) > 0){
            foreach($specialIds as $specialId){
                if($specialId == auth()->user()->id){
                    $total_charge = SpecialMerchant::where('merchant_id', auth()->user()->id)
                                                    ->where('district_id_from', $self_district_id)
                                                    ->where('district_id_to', $request->input('district_id'))
                                                    ->pluck('charge')
                                                    ->first();
                break;
                }
            }
        }

        if($total_charge == null){
            $total_charge = InterCityRate::where('district_id_from', $self_district_id)
                                            ->where('district_id_to', $request->input('district_id'))
                                            ->pluck('charge')
                                            ->first();
        }

        $input = new Delivery();
        $input = $request->except(['_token']);
        $input['created_by'] = auth()->user()->id;
        $input['updated_at'] = null;
        $input['total_charge'] = $total_charge;
        $input['district_id_from'] = $self_district_id;

        Delivery::create($input);
        $newId =  Delivery::orderBy('id', 'desc')->pluck('id')->first();
        Delivery::where('id', $newId)->update([
            'code' => 'D'.$newId,
        ]);
        return back()->with('success', 'Successfully Added');
    }

    public function statuses()
    {
        DB::table('delivery_statuses')->truncate();
        $statuses = [
            [
                'title' => 'No Status Yet',
                'created_by' => auth()->user()->id,
            ],
            [
                'title' => 'Pickup',
                'created_by' => auth()->user()->id,
            ],
            [
                'title' => 'Delivered',
                'created_by' => auth()->user()->id,
            ],
            [
                'title' => 'On Hold',
                'created_by' => auth()->user()->id,
            ],
            [
                'title' => 'Cancelled',
                'created_by' => auth()->user()->id,
            ]
        ];
        DB::table('delivery_statuses')->insert($statuses);
        return back()->with('success', 'Successfully Added');
    }

    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $preUrl = url()->previous();
        $data = Delivery::find($id);
        $districts = District::get();
        if($data->delivery_status == 1 && $data->created_by == auth()->user()->id){
            return view('layouts.backend.deliveries.edit', compact('data', 'districts'));
        }

        if(auth()->user()->role_id == 1){
            return view('layouts.backend.deliveries.edit', compact('data', 'districts', 'preUrl'));
        }

        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(Delivery::where('id', $id)->pluck('delivery_status')->first() == 1 || auth()->user()->role_id == 1){
            $specialIds = SpecialMerchant::get()->pluck('merchant_id');

            $total_charge = null;
            if(count($specialIds) > 0){
                foreach($specialIds as $specialId){
                    if($specialId == $request->input('user_id')){
                        $total_charge = SpecialMerchant::where('merchant_id', $request->input('user_id'))
                                                        ->where('district_id_from', $request->input('district_id_from'))
                                                        ->where('district_id_to', $request->input('district_id'))
                                                        ->pluck('charge')
                                                        ->first();
                    break;
                    }
                }
            }

            if($total_charge == null){
                $total_charge = InterCityRate::where('district_id_from', $request->input('district_id_from'))
                                                ->where('district_id_to', $request->input('district_id'))
                                                ->pluck('charge')
                                                ->first();
            }
            if ($request->input('total_charge')){
                $total_charge = $request->input('total_charge');
            }

            $input = $request->except(['_token', '_method', 'user_id', 'edit_from', 'pre_url']);
            $input['updated_by'] = Auth::user()->id;
            $input['total_charge'] = $total_charge;
            Delivery::where('id', $id)->update($input);

            if(auth()->user()->role_id == 1){
                $deliveryCreator = Delivery::where('id', $id)->pluck('created_by')->first();
//                return redirect()->route('user.manage', $deliveryCreator)->with('success', 'Successfully Updated');
                return redirect()->to($request->input('pre_url'))->with('success', 'Successfully Updated');
            }else{
                return redirect()->route('deliveries.index')->with('success', 'Successfully Updated');
            }
        }
        return redirect()->route('deliveries.index')->with('error', 'No permission for edit the delivery request');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        //
    }
}
