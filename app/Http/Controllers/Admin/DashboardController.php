<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalMerchants = Merchant::count();
        $totalTransactions = Transaction::count();
        $totalRevenue = Transaction::where('transaction_status', 'settlement')->sum('gross_amount');

        // For chart, get monthly transactions
        $monthlyTransactions = Transaction::selectRaw("strftime('%m', created_at) as month, COUNT(*) as count")
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalMerchants',
            'totalTransactions',
            'totalRevenue',
            'monthlyTransactions'
        ));
    }
}
