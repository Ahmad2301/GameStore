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

        // For chart, get daily transactions
        $dailyTransactions = Transaction::selectRaw("strftime('%Y-%m-%d', created_at) as date, COUNT(*) as count")
            ->whereYear('created_at', date('Y'))
            ->groupBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalMerchants',
            'totalTransactions',
            'totalRevenue',
            'dailyTransactions'
        ));
    }
}
