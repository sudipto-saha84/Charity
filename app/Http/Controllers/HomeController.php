<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function totalDonate()
    {
        $payments = Payment::with('user')->get();
        $totalDonate = Payment::sum('paid_amount');
        return view('frontend.home.totalDonate', compact('payments', 'totalDonate'));
    }
}
