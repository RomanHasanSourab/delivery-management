<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Hub;
use App\Models\District;
use App\Models\Merchant;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class HubController extends Controller
{

    public function registerHub(){
        $districts = District::get();
        return view('auth.register-hub', compact('districts'));
    }


    public function index()
    {
        $datas = User::where('role_id', '2')->where('status', '1')->orderBy('id', 'desc')->with('district')->get();

        return view('layouts.backend.agents.index', compact('datas'));
    }

    public function indexAll()
    {
        $agents = User::where('role_id', 2)->where('status', 1)->orderBy('id', 'desc')->get();
        $data = Delivery::orderBy('id', 'desc')->with('deliveryTo', 'deliveryFrom', 'deliveryCreatedBy', 'status')->get();
        $districts = District::orderBy('id', 'desc')->get();
        $from = User::with(['district', 'role'])->get();

        return view('layouts.backend.deliveries.index-all-delivery-agent', compact('data', 'districts', 'from', 'agents'));
    }

    public function getAll(){
        if(auth()->user()->role_id == 2){
            $data = Delivery::where('assigned_agent_id', \auth()->user()->id)->orderBy('id', 'desc')->with('deliveryTo', 'deliveryFrom', 'deliveryCreatedBy', 'agent')->get();
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

    }

    public function getIndexAdmin(){

        $data = User::where('role_id', '2')->where('status', '1')->orderBy('id', 'desc')->with('district', 'hubInfo')->get();

        return DataTables::of($data)
            ->editColumn('name', function($data){
                return $data->name;
            })
            ->editColumn('code', function($data){
                return $data->code;
            })
            ->editColumn('email', function($data){
                return $data->email;
            })
            ->editColumn('service_name', function($data){
                return $data->hubInfo['service_name'];
            })
            ->editColumn('address', function($data){
                return $data->address;
            })
            ->editColumn('phone', function($data){
                return $data->phone;
            })
            ->editColumn('phone2', function($data){
                return $data->hubInfo['phone2'];
            })
            ->editColumn('license', function($data){
                return $data->hubInfo['license'];
            })
            ->editColumn('identy_no', function($data){
                return $data->hubInfo['identy_no'];
            })
            ->editColumn('identy_image', function($data){
                return $data->hubInfo['identy_image'];
            })
            ->editColumn('city', function($data){
                return $data->district->title;
            })
            ->editColumn('status', function($data){
                return $data->status;
            })
            ->editColumn('registered_at', function($data){
                $date= strtotime($data->created_at);
                return date('d-M-Y | h:i A', $date);
            })
            ->editColumn('activated_at', function($data){
                $date= strtotime($data->updated_at);
                return date('d-M-Y | h:i A', $date);
            })
            ->addColumn('action', function($data){
                return $data;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);

    }


    public function manageDelivery(Request $request){

        $userId = $request->input('user_id');
        $data = Delivery::where('assigned_agent_id', $userId)->orderBy('id', 'desc')->with('deliveryTo', 'deliveryFrom', 'deliveryCreatedBy')->get();

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

    }

    public function agentRequest(){
        $datas = User::where('role_id', '2')->where('status', '2')->orderBy('id', 'desc')->with('district', 'hubInfo')->get();
        return view('layouts.backend.agents.requests', compact('datas'));
    }

    public function agentInactive(){
        $datas = User::where('role_id', '2')->where('status', '3')->orderBy('id', 'asc')->with('district')->get();
        return view('layouts.backend.agents.inactive', compact('datas'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Hub $hub)
    {
        //
    }


    public function edit($id)
    {
        if(auth()->user()->id == $id || auth()->user()->role_id == 1){
            $data = User::where('id',$id)->with('district', 'hubInfo')->first();

            $districts = District::get();
            $city = District::where('id', $data->district_id)->pluck('title')->first();
            return view('layouts.backend.agents.edit', compact('data', 'districts', 'city'));
        }
        return back();
    }

    public function agentActive($id){
        User::where('id', $id)->update([
            'status' => 1,
            'code' => 'A'.$id,
        ]);
        return redirect()->route('agent-requests')->with('success', 'Successfully Activated');
    }

    public function update(Request $request, $id)
    {
        $preData = User::where('id', $id)->with('district', 'hubInfo')->first();
        $input = $request->except(['_token', '_method']);
        if($request->input('password') == null){
            $password = $preData->password;
        }else{
            $password = Hash::make($request->input('password'));
        }

        if (isset($input['identy_image'])){
            $filePath = public_path()."agent";
            if(\File::exists($filePath.$preData->hubInfo->identy_image)){
                $removeFile = $filePath.$preData->hubInfo->identy_image;
                unlink($removeFile);
            }

            $file = $input['identy_image'];
            $oriName = $file->getClientOriginalName();
            $filename = time().'.'.$oriName;
            $file->move('agent/', $filename);
        }else{
            $filename = $preData->hubInfo ? $preData->hubInfo->identy_image : null;
        }

        if (\auth()->user()->role_id == 2){
            User::where('id', $id)->update([
                'phone' => $input['phone'],
                'password' => $password,
                'updated_by' => Auth::user()->id
            ]);
            Hub::where('user_id', $id)->update([
                'phone2' => $input['phone2']
            ]);
            return redirect()->route('agents.edit', $id)->with('success', 'Successfully Updated');
        }else{
            User::where('id', $id)->update([
                'name' => $input['name'],
                'email' => $input['email'],
                'address' => $input['address'],
                'phone' => $input['phone'],
                'status' => $input['status'],
                'district_id' => $input['district_id'],
                'password' => $password,
                'updated_by' => Auth::user()->id
            ]);
            Hub::where('user_id', $id)->update([
                'service_name' => $input['service_name'],
                'phone2' => $input['phone2'],
                'license' => $input['license'],
                'identy_no' => $input['identy_no'],
                'identy_image' => $filename,
            ]);
            return redirect()->route('agents.index')->with('success', 'Successfully Updated');
        }
    }

    public function userManage($id){
        if(auth()->user()->role_id == 1){

            $deliveries = Delivery::where('assigned_agent_id', $id)->count();
            $delivered = Delivery::where('assigned_agent_id', $id)
                ->where('delivery_status', 3)
                ->count();
            $pending = Delivery::where('assigned_agent_id', $id)
                ->whereNotIn('delivery_status', [3])
                ->count();


            return view('layouts.backend.agents.manage', compact('deliveries', 'delivered', 'pending', 'id'));
        }
        return back();
    }

    public function assign(Request $request){
        if(!$request->input('delivery_id') == null){
            $agent_id = $request->input('agent_id');
            $delivery_ids = explode(',', $request->input('delivery_id'));

            foreach($delivery_ids as $delivery_id){
                Delivery::where('id', $delivery_id)->update([
                    'assigned_agent_id' => $agent_id
                ]);
            }
            return back()->with('success', 'Successfully Assigned');
        }
        return back();
    }

    public function downloadIdentyImg($fileName){
        $file = public_path()."agent/".$fileName;
//        $headers = array('Content-Type: application/pdf',);
        return \Illuminate\Support\Facades\Response::download($file, $fileName);
    }

    public function destroy(Hub $hub)
    {
        //
    }
}
