<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\contactUs;
use App\Models\Payment;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $payments=Payment::all();
        $events = Event::latest()->take(4)->get();
        return view('frontend.index', [
            'events' => $events,
            'sliders'=>Slider::all(),
            'payments'=>$payments
        ]);
    }
    public function eventsAll()
    {

        $events = Event::latest()->get();
        return view('frontend.home.events',[
            'events' => $events
        ]);
    }
    public function mission()
    {
        return view('frontend.home.mission');
    }
    public function aboutUs()
    {
        return view('frontend.home.about-us');
    }
    public function contactUs(Request $request){


        ContactUs::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ]);


        return back()->with(['success'=>'message sent successfully']);

    }


    public function eventDetails($id){
    $event= Event::with('imageble')->where('id',$id)->first();
       return view('frontend.home.event-details',compact('event'));
    }

}
