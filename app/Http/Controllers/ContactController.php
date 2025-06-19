<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Email;
use App\Models\Helpline;
use App\Models\PublicMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helplines = Helpline::orderBy('id', 'desc')->with('helplineCreatedBy', 'helplineUpdatedBy')->get();
        $emails = Email::orderBy('id', 'desc')->with('emailCreatedBy', 'emailUpdatedBy')->get();
        $addresses = Address::orderBy('id', 'desc')->with('addressCreatedBy', 'addressUpdatedBy')->get();

        return view('layouts.backend.contact.index', compact('helplines', 'emails', 'addresses'));
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
    public function emailStore(Request $request)
    {
        $input = new Email();
        $input = $request->except(['_token']);
        $input['created_by'] = auth()->user()->id;
        $input['updated_at'] = null;
        Email::create($input);
        return back()->with('success', 'Successfully Added');
    }

    public function phoneStore(Request $request)
    {
        $input = new Helpline();
        $input = $request->except(['_token']);
        $input['created_by'] = auth()->user()->id;
        $input['updated_at'] = null;
        Helpline::create($input);
        return back()->with('success', 'Successfully Added');
    }

    public function addressStore(Request $request)
    {
        $input = new Address();
        $input = $request->except(['_token']);
        $input['created_by'] = auth()->user()->id;
        $input['updated_at'] = null;
        Address::create($input);
        return back()->with('success', 'Successfully Added');
    }

    public function messageStore(Request $request)
    {
        $input = new PublicMessage();
        $input = $request->except(['_token']);
        PublicMessage::create($input);
        return back()->with('success', 'Your message has been sent');
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
    public function emailEdit($id)
    {
        $data = Email::find($id);
        return view('layouts.backend.contact.edit-email', compact('data'));
    }

    public function addressEdit($id)
    {
        $data = Address::find($id);
        return view('layouts.backend.contact.edit-address', compact('data'));
    }

    public function phoneEdit($id)
    {
        $data = Helpline::find($id);
        return view('layouts.backend.contact.edit-phone', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function emailUpdate(Request $request, $id)
    {
        $input = $request->except(['_token', '_method']);
        $input['updated_by'] = auth()->user()->id;
        Email::where('id', $id)->update($input);
        return redirect()->route('admin-contact')->with('success', 'Successfully Updated');
    }

    public function addressUpdate(Request $request, $id)
    {
        $input = $request->except(['_token', '_method']);
        $input['updated_by'] = auth()->user()->id;
        Address::where('id', $id)->update($input);
        return redirect()->route('admin-contact')->with('success', 'Successfully Updated');
    }

    public function phoneUpdate(Request $request, $id)
    {
        $input = $request->except(['_token', '_method']);
        $input['updated_by'] = auth()->user()->id;
        Helpline::where('id', $id)->update($input);
        return redirect()->route('admin-contact')->with('success', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addressDestroy($id)
    {
        Address::where('id', $id)->delete();
        return back()->with('success', 'Successfully deleted');
    }

    public function phoneDestroy($id)
    {
        Helpline::where('id', $id)->delete();
        return back()->with('success', 'Successfully deleted');
    }

    public function emailDestroy($id)
    {
        Email::where('id', $id)->delete();
        return back()->with('success', 'Successfully deleted');
    }
}
