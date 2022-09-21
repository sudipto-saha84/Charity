<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StripePaymentController extends Controller
{
    public function donate()
    {
        if (Auth::check() && Auth::user()->status != 0) {
            return redirect()->back()->with('error', 'You must be accepted by admin to donate');
        }
        return view('backend.stripe.card');
    }

    public function stripePost(Request $request)
    {
        $request->validate([
            'amount' => 'required',
            'paid_for' => 'required|string',
            'paid_by' => 'required|string',
            'transaction_id' => 'required',
        ]);
//        if (!Auth::check() && Auth::user()->status != 1) {
//            return response(['error'=>'You must be accepted by admin to donate'],401);
//        }
        try{
            Payment::create([
                'paid_by' => auth()->id(),
                'paid_amount' => $request->paid_by == 'stripe' ? $request->amount * 100 : $request->amount,
                'paid_for' => $request->paid_for,
                'transaction_id' => $request->transaction_id,
            ]);
            User::find(auth()->id())->increment('donation', $request->amount);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception->getMessage()]);
        }

        return response()->json(['success' => 'Payment Successful']);
    }
}
