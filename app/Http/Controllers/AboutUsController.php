<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\AboutUsCard;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aboutData = AboutUs::orderBy('id', 'desc')->with('aboutCreatedBy', 'aboutUpdatedBy')->get();
        $cardData = AboutUsCard::orderBy('id', 'desc')->with('aboutCardCreatedBy', 'aboutCardUpdatedBy')->get();

        return view('layouts.backend.about-us.index', compact('aboutData', 'cardData'));
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
        $input = new AboutUs();
        $input = $request->except(['_token']);
        $input['created_by'] = auth()->user()->id;
        $input['updated_at'] = null;
        AboutUs::create($input);
        return back()->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function show(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutUs $aboutUs, $id)
    {
        $data = AboutUs::find($id);
        return view('layouts.backend.about-us.edit-description', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AboutUs $aboutUs, $id)
    {
        $input = $request->except(['_token', '_method']);
        $input['updated_by'] = auth()->user()->id;
        AboutUs::where('id', $id)->update($input);
        return redirect()->route('admin-about.index')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutUs $aboutUs, $id)
    {
        AboutUs::where('id', $id)->delete();
        return back()->with('success', 'Successfully deleted');
    }
}
