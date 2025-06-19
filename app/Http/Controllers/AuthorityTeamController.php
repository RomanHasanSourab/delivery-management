<?php

namespace App\Http\Controllers;

use App\Models\AuthorityTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorityTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AuthorityTeam::orderBy('id', 'desc')->with('authorityCreatedBy', 'authorityUpdatedBy')->get();
        return view('layouts.backend.authority-team.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd('hi');
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
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('authority-team/', $filename);
        }


        $input = new AuthorityTeam();
        $input = $request->except(['_token']);
        $input['created_by'] = Auth::user()->id;
        $input['updated_at'] = null;
        $input['image'] =$filename;
        AuthorityTeam::create($input);
        return back()->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AuthorityTeam  $authorityTeam
     * @return \Illuminate\Http\Response
     */
    public function show(AuthorityTeam $authorityTeam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AuthorityTeam  $authorityTeam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = AuthorityTeam::find($id);
        return view('layouts.backend.authority-team.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AuthorityTeam  $authorityTeam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $uploadedFile = $request->file('image');

        if ($request->file('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('authority-team/', $filename);
        }

        $input = $request->except(['_token', '_method']);
        $input['updated_by'] = Auth::user()->id;
        if ($uploadedFile){
            $input['image'] =$filename;
        }
        AuthorityTeam::where('id', $id)->update($input);
        return redirect()->route('authority-teams.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AuthorityTeam  $authorityTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AuthorityTeam::where('id', $id)->delete();
        return back()->with('success', 'Successfully deleted');
    }
}
