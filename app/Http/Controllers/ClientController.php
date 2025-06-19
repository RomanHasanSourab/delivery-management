<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Client::orderBy('id', 'desc')->with('clientUpdatedBy', 'clientUpdatedBy')->get();
        return view('layouts.backend.client-team.index', compact('data'));
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
        $uploadedFile = $request->file('image');

        if ($request->file('image')){
            // $filename = uniqid() . '-' . $uploadedFile->getClientOriginalName();
            //  $r = Storage::disk('public')->putFileAs(
            //     'clients',
            //     $uploadedFile,
            //     $filename
            // );
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('clients/', $filename);
        }


        $input = new Client();
        $input = $request->except(['_token']);
        $input['created_by'] = Auth::user()->id;
        $input['updated_at'] = null;
        $input['image'] =$filename;
        Client::create($input);
        return back()->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client, $id)
    {
        $data = Client::find($id);
        return view('layouts.backend.client-team.client-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $uploadedFile = $request->file('image');

        if ($request->file('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('clients/', $filename);
        }

        $input = $request->except(['_token', '_method']);
        $input['updated_by'] = Auth::user()->id;
        if ($uploadedFile){
            $input['image'] =$filename;
        }
        Client::where('id', $id)->update($input);
        return redirect()->route('admin-client.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::where('id', $id)->delete();
        return back()->with('success', 'Successfully deleted');
    }
}
