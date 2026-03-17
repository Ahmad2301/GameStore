<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['merchant.user', 'user'])->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['merchant.user', 'user', 'transactions']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,cancelled,completed']);
        $order->update(['status' => $request->status]);

        // Wallet logic for completed
        if ($request->status == 'completed' && $order->getOriginal('status') != 'completed') {
            $commission = $order->total_amount * 0.1;
            $merchant_amount = $order->total_amount - $commission;
            $order->merchant->increment('balance', $merchant_amount);
        }

        return redirect()->back()->with('success', 'Order status updated');
    }
}

