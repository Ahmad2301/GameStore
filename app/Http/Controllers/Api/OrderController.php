<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\MidtransController;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = \App\Models\Product::findOrFail($request->product_id);
        if ($product->stock < $request->quantity) {
            return response()->json(['error' => 'Stock tidak mencukupi'], 400);
        }

        $order = Order::create([
            'user_id' => Auth::id(),
            'merchant_id' => $product->merchant_id,
            'total_amount' => $product->price * $request->quantity,
            'status' => 'pending',
        ]);

        Transaction::create([
            'order_id' => $order->id,
            'midtrans_id' => 'TEMP_' . $order->id,
            'payment_type' => 'unknown',
            'status' => 'pending',
            'amount' => $order->total_amount,
        ]);

        $midtrans = new MidtransController();
        $snapToken = $midtrans->createSnapToken($order)->getData()->snap_token;

        return response()->json([
            'order' => $order,
            'snap_token' => $snapToken
        ]);
    }
}

