<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->role_id == 1 && auth()->user()->id == 1) {
            $data = User::where('role_id', 1)->whereNotIn('id', [1])->with('district')->orderBy('id', 'desc')->with('district')->get();
            $districts = District::get();
            return view('layouts.backend.super-admin.index', compact('data', 'districts'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $districts = District::get();
        return view('layouts.backend.super-admin.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->role_id == 1 && auth()->user()->id == 1) {
            $data = $request->input();
            $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:users'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'phone' => ['required', 'numeric', 'unique:users'],
                'address' => ['required', 'string'],
                'password' => ['required', 'string', 'min:6'],
            ]);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'role_id' => 1,
                'district_id' => $data['district_id'],
                'password' => Hash::make($data['password']),
                'status' => 1,
            ]);
            User::where('id', $user->id)->update([
                'status' => 1
            ]);
            return redirect()->route('user.index')->with('success', 'Successfully User Created');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->id == $id){
            $old = User::where('id',$id)->with('district')->first();
            $districts = District::get();
        }else{
            return back();
        }
        return view('layouts.backend.super-admin.edit', compact('districts', 'old'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_method', '_token']);
        if (auth()->user()->role_id == 1 && auth()->user()->id == 1) {
            if ($data['password']){
                $data['password'] = Hash::make($data['password']);
            }else{
                $prePass = User::where('id', $id)->pluck('password')->first();
                $data['password'] = $prePass;
            }
            User::where('id', $id)->update($data);
            return redirect()->route('user.index')->with('success', 'Successfully User Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->role_id == 1 && auth()->user()->id == 1) {
            User::where('id', $id)->delete();
            return redirect()->route('user.index')->with('success', 'Successfully User Deleted');
        }
    }
}
