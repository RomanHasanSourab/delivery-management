<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class MerchantController extends Controller
{

    public function index()
    {
        $datas = User::where('role_id', '3')->where('status', '1')->orderBy('id', 'desc')->with('district')->get();

        return view('layouts.backend.merchants.index', compact('datas'));
    }


    public function getIndexAdmin(){

        $data = User::where('role_id', '3')->where('status', '1')->orderBy('id', 'desc')->with('district')->get();

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
        ->editColumn('shop_name', function($data){
            return $data->shop_name;
        })
        ->editColumn('address', function($data){
            return $data->address;
        })
        ->editColumn('phone', function($data){
            return $data->phone;
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

        return view('layouts.backend.merchants.index');
    }


    public function merchantRequest(){
        $datas = User::where('role_id', '3')->where('status', '2')->orderBy('id', 'desc')->with('district')->get();
        return view('layouts.backend.merchants.requests', compact('datas'));
    }

    public function merchantInactive(){
        $datas = User::where('role_id', '3')->where('status', '3')->orderBy('id', 'asc')->with('district')->get();
        return view('layouts.backend.merchants.inactive', compact('datas'));
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Merchant $merchant)
    {
        //
    }


    public function edit($id)
    {
        if(auth()->user()->id == $id || auth()->user()->role_id == 1){
            $data = User::find($id);
            $districts = District::get();
            $city = District::where('id', $data->district_id)->pluck('title')->first();
            return view('layouts.backend.merchants.edit', compact('data', 'districts', 'city'));
        }
        return back();
    }

    public function merchantActive($id){
        User::where('id', $id)->update([
            'status' => 1,
            'code' => 'M'.$id,
        ]);
        return redirect()->route('merchant-requests')->with('success', 'Successfully Activated');
    }

    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'phone' => ['min:5|max:11']
        ]);

        $input = $request->except(['_token', '_method']);
        $input['updated_by'] = Auth::user()->id;
        if($request->input('password') == null){
            $input = $request->except(['_token', '_method', 'password']);
        }else{
            $input['password'] = Hash::make($request->input('password'));
        }

        User::where('id', $id)->update($input);
        if(auth()->user()->role_id == 3){
            return redirect()->route('merchants.edit', $id)->with('success', 'Successfully Updated');
        }
        return redirect()->route('merchants.index')->with('success', 'Successfully Updated');
    }


    public function destroy(Merchant $merchant)
    {
        //
    }
}
