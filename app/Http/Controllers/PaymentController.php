<?php

namespace App\Http\Controllers;

use App\Models\MontlyBill;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $request->bill,
                'gross_amount' => $request->cost,
            ),
            'customer_details' => array(
                'first_name' => $request->name,
                'last_name' => $request->name,
                'email' => 'customer@mail.com',
                'phone' => '080000000000',
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return response()->json(['snap_token' => $snapToken]);
    }

    // public function midtransCallback(Request $request) 
    // {
    //     $serverKey = config('midtrans.server_key');
    //     $hashed = hash('sha512', $request->order_id.$request->status_code.$request->gross_amount.$serverKey);
    //     if ($hashed == $request->signature_key) {
    //         if($request->transaction_status == 'capture') {
    //             $bill = MontlyBill::find($request->order_id);
    //             $bill->status = 'paid';
    //         }
    //     }
    // }

    public function payCallback($bill_id)
    {
        $bill = MontlyBill::find($bill_id);
        $bill->status = 'paid';
        $bill->save();
    }
}
