<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function status($midtrans_id)
    {
        $transaction = Transaction::where('midtrans_id', $midtrans_id)->with('order')->firstOrFail();
        return response()->json($transaction);
    }
}

