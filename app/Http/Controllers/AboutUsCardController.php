<?php

namespace App\Http\Controllers;

use App\Models\AboutUsCard;
use Illuminate\Http\Request;

class AboutUsCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cardData = AboutUsCard::orderBy('id', 'desc')->with('createdBy', 'updatedBy')->get();
        // dd($cardData);
        // return view('layouts.backend.about-us.index', compact('cardData'));
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
        $input = new AboutUsCard();
        $input = $request->except(['_token']);
        $input['created_by'] = auth()->user()->id;
        $input['updated_at'] = null;
        AboutUsCard::create($input);
        return back()->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AboutUsCard  $aboutUsCard
     * @return \Illuminate\Http\Response
     */
    public function show(AboutUsCard $aboutUsCard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AboutUsCard  $aboutUsCard
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutUsCard $aboutUsCard, $id)
    {
        $data = AboutUsCard::find($id);
        return view('layouts.backend.about-us.edit-card', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutUsCard  $aboutUsCard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AboutUsCard $aboutUsCard, $id)
    {
        $input = $request->except(['_token', '_method']);
        $input['updated_by'] = auth()->user()->id;
        AboutUsCard::where('id', $id)->update($input);
        return redirect()->route('admin-about.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AboutUsCard  $aboutUsCard
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutUsCard $aboutUsCard, $id)
    {
        AboutUsCard::where('id', $id)->delete();
        return back()->with('success', 'Successfully deleted');
    }
}
