<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactShow(){
        $contacts=ContactUs::latest()->get();
        return view("backend.contact.index",compact('contacts'));
    }
    public function contactDelete($id){
       $contact= ContactUs::find($id);
$contact->delete();

        return back()->with(['success'=>'Contact Deleted successfully']);

    }
    public function index()
    {
        $data = [
            'newRequestCount' => \App\Models\Request::where('status', 'request')->count(),
            'donation' => User::sum('donation'),
            'volunteerCount' => User::role('Volunteer')->count(),
            'donorCount' => User::role('Donor')->count(),
        ];

        return view("backend.dashboard", $data);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
