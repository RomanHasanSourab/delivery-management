<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\AddRateInfo;
use App\Models\Address;
use App\Models\AuthorityTeam;
use App\Models\Client;
use App\Models\District;
use App\Models\Email;
use App\Models\Helpline;
use App\Models\InterCityRate;
use App\Models\Service;
use App\Models\ValuableClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $services = Service::orderBy('id', 'desc')->take(3)->get();
        $aboutData = AboutUs::orderBy('id', 'desc')->with('aboutCreatedBy', 'aboutUpdatedBy')->first();
        $clients = Client::get();
        $authors = AuthorityTeam::get();
        return view('layouts.frontend.home', compact('services', 'aboutData', 'clients', 'authors'));
    }

    public function optimizeCache()
    {
        Artisan::call('optimize');
        Artisan::call('route:cache');
        Artisan::call('config:cache');
        Artisan::call('view:cache');
        return 'All caches optimized!';
    }
    
    public function pricing()
    {
        $datas = InterCityRate::with('districtFrom', 'districtTo')->get()->groupBy('district_id');

        $rates = AddRateInfo::orderBy('id', 'desc')->with('rateInfoCreatedBy', 'rateInfoUpdatedBy')->get();
        // dd($datas);
        return view('layouts.frontend.pricing', compact('datas', 'rates'));
    }

    public function services()
    {
        $datas = Service::orderBy('id', 'desc')->get();
        return view('layouts.frontend.service', compact('datas'));
    }

    public function contact()
    {
        $helplines = Helpline::get();
        $emails = Email::get();
        $addresses = Address::get();
        return view('layouts.frontend.contact', compact('helplines', 'emails', 'addresses'));
    }


    // After Login Components
    public function dashboard()
    {
        return view('layouts.backend.dashboard.dashboard');
    }
}

