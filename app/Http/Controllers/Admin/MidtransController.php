<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;

class MidtransController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('APP_ENV') == 'production';
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createSnapToken(Order $order)
    {
        $payload = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_amount,
            ],
            'customer_details' => [
                'first_name' => $order->user->name,
                'email' => $order->user->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($payload);
        return response()->json(['snap_token' => $snapToken]);
    }
}

