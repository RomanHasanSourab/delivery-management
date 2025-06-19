<?php

namespace App\Http\Controllers;

use App\Models\PublicMessage;
use Illuminate\Http\Request;

class PublicMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        PublicMessage::where('seen', 2)->update([
            'seen' => 1,
        ]);
        $data = PublicMessage::orderBy('id', 'desc')->get();
        return view('layouts.backend.message.index', compact('data'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PublicMessage  $publicMessage
     * @return \Illuminate\Http\Response
     */
    public function show(PublicMessage $publicMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PublicMessage  $publicMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(PublicMessage $publicMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PublicMessage  $publicMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PublicMessage $publicMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PublicMessage  $publicMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(PublicMessage $publicMessage)
    {
        //
    }
}
