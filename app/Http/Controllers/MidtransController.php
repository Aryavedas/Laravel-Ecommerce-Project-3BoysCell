<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Transaction;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function generate_snap_token(Request $request)
    {
        $transaction = Transaction::with(['user'])->where('id', $request->transaction_id)->first();

        if (is_null($transaction->snap_token)) {
            $params = [
                "transaction_details" => [
                    "order_id" => $transaction->order_id,
                    "gross_amount" => $transaction->total_harga
                ],
                [
                    "user_details" => [
                        "first_name" => $transaction->user->name
                    ]
                ]
            ];
            $snap_token = Snap::getSnapToken($params);
            $transaction->snap_token = $snap_token;
            $transaction->save();

            return view("payment", ["snap_token" => $transaction->snap_token, "transaction_id" => $transaction->id]);
        }

        return view("payment", ["snap_token" => $transaction->snap_token, "transaction_id" => $transaction->id]);
    }
}
