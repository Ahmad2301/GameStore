<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::with('merchant.user')->paginate(10);
        return view('admin.withdrawals.index', compact('withdrawals'));
    }

    public function approve(Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Withdrawal not pending');
        }

        $withdrawal->update([
            'status' => 'approved',
            'approved_at' => now()
        ]);

        $withdrawal->merchant->decrement('balance', $withdrawal->amount);

        return redirect()->back()->with('success', 'Withdrawal approved');
    }

    public function reject(Request $request, Withdrawal $withdrawal)
    {
        if ($withdrawal->status !== 'pending') {
            return redirect()->back()->with('error', 'Withdrawal not pending');
        }

        $withdrawal->update([
            'status' => 'rejected',
            'reason' => $request->reason
        ]);

        return redirect()->back()->with('success', 'Withdrawal rejected');
    }
}

