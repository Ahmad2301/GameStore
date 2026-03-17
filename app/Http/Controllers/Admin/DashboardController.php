<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Merchant;
use App\Models\Transaction;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTransactions = Transaction::count();
        $totalUsers = \App\Models\User::count();
        $totalMerchants = Merchant::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        
        $dailyTransactions = Transaction::selectRaw('DATE(created_at) as date, count(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(7)
            ->get();

        return view('admin.dashboard', compact(
            'totalTransactions', 
            'totalUsers', 
            'totalMerchants', 
            'totalRevenue',
            'dailyTransactions'
        ));
    }
}

