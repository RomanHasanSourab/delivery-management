<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // After Login Components
    public function index()
    {
        if(auth()->user()->role_id == 1 || auth()->user()->role_id == 6){
            $merchants = User::where('role_id', '3')->where('status', 1)->get();
            $customers = User::where('role_id', '4')->where('status', 1)->get();
            $branches = User::where('role_id', '2')->where('status', 1)->get();
            $superAdmin = User::where('role_id', '1')->get();
            $roles = Role::get();
        }

        if(auth()->user()->role_id == 3 || auth()->user()->role_id == 4){
            $deliveries = Delivery::where('created_by', auth()->user()->id)->count();
            $delivered = Delivery::where('created_by', auth()->user()->id)
                                    ->where('delivery_status', 3)
                                    ->count();
            $pending = Delivery::where('created_by', auth()->user()->id)
                                ->whereNotIn('delivery_status', [3])
                                ->count();

            $paidCount = Delivery::where('created_by', auth()->user()->id)
                                ->where('delivery_status', 3)
                                ->where('paid_status', 1)
                                ->count();
            $unpaidCount = Delivery::where('created_by', auth()->user()->id)
                                ->where('delivery_status', 3)
                                ->where('paid_status', 2)
                                ->count();

            $collection = Delivery::where('created_by', auth()->user()->id)
                                    ->where('paid_status', 2)
                                    ->whereIn('delivery_status', [2,3])
                                    ->sum('collect_amount');

            $charge = Delivery::where('created_by', auth()->user()->id)
                                ->whereIn('delivery_status', [2,3])
                                ->where('paid_status', 2)
                                ->sum('total_charge');

            $unpaid = $collection - $charge;

            $paidCollection = Delivery::where('created_by', auth()->user()->id)
                                ->where('paid_status', 1)
                                ->sum('collect_amount');

            $paidCharge = Delivery::where('created_by', auth()->user()->id)
                                ->where('paid_status', 1)
                                ->sum('total_charge');

            $paid = $paidCollection - $paidCharge;

            $deliveryData = Delivery::where('created_by', auth()->user()->id)->with('status')->orderBy('id', 'desc')->take(10)->get();

        }

        if(auth()->user()->role_id != 1 && auth()->user()->status == 2 || auth()->user()->status == 3){
            // return abort(403, 'Your account is not activate.');
            return view('layouts.backend.dashboard.not-active');
        }elseif(auth()->user()->role_id == 1 || auth()->user()->role_id == 6){
            return view('layouts.backend.dashboard.dashboard', compact('merchants', 'customers', 'branches', 'roles', 'superAdmin'));
        }elseif(auth()->user()->role_id == 3 || auth()->user()->role_id == 4){
            return view('layouts.backend.dashboard.dashboard', compact('deliveries', 'delivered', 'pending', 'charge', 'unpaid', 'paid', 'deliveryData', 'paidCount', 'unpaidCount'));
        }elseif(auth()->user()->role_id == 2){

            $deliveries = Delivery::where('assigned_agent_id', auth()->user()->id)->count();
            $delivered = Delivery::where('assigned_agent_id', auth()->user()->id)
                ->where('delivery_status', 3)
                ->count();
            $pending = Delivery::where('assigned_agent_id', auth()->user()->id)
                ->whereNotIn('delivery_status', [3])
                ->count();
            $deliveryData = Delivery::where('assigned_agent_id', auth()->user()->id)->with('status')->orderBy('id', 'desc')->take(10)->get();

            return view('layouts.backend.dashboard.dashboard', compact('deliveries', 'delivered', 'pending', 'deliveryData'));
        }
    }


    public function userManage($id){
        if(auth()->user()->role_id == 1){

            $deliveries = Delivery::where('created_by', $id)->count();
            $delivered = Delivery::where('created_by', $id)
                                ->where('delivery_status', 3)
                                ->count();
            $pending = Delivery::where('created_by', $id)
                                ->whereNotIn('delivery_status', [3])
                                ->count();

            $paidCount = Delivery::where('created_by', $id)
                                // ->where('delivery_status', 3)
                                ->where('paid_status', 1)
                                ->count();
            $unpaidCount = Delivery::where('created_by', $id)
                                // ->where('delivery_status', 3)
                                ->where('paid_status', 2)
                                ->count();
            $collection = Delivery::where('created_by', $id)
                               ->where('paid_status', 2)
                            //    ->whereIn('delivery_status', [2,3])
                               ->sum('collect_amount');

            $charge = Delivery::where('created_by', $id)
                            //    ->whereIn('delivery_status', [2,3])
                               ->where('paid_status', 2)
                               ->sum('total_charge');

            $unpaid = $collection - $charge;

            $getCharge = Delivery::where('created_by', $id)
                                // ->where('delivery_status', 3)
                                ->where('paid_status', 1)
                                ->sum('total_charge');

            $paidCollection = Delivery::where('created_by', $id)
                                ->where('paid_status', 1)
                                ->sum('collect_amount');

            $paidCharge = Delivery::where('created_by', $id)
                                ->where('paid_status', 1)
                                ->sum('total_charge');

            $paid = $paidCollection - $paidCharge;

            $agents = User::where('role_id', 2)->where('status', 1)->orderBy('id', 'desc')->get();
            return view('layouts.backend.merchants.manage', compact('deliveries', 'delivered', 'pending', 'charge', 'unpaid', 'paid', 'id', 'paidCount', 'unpaidCount', 'getCharge', 'agents'));
        }
        return back();
    }

}
