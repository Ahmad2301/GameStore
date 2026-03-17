<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['order.merchant', 'order.user'])->paginate(10);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['order.merchant.user', 'order.user']);
        return view('admin.transactions.show', compact('transaction'));
    }
}

