<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function index()
    {
        $merchants = Merchant::with('user')->paginate(10);
        return view('admin.merchants.index', compact('merchants'));
    }

    public function show(Merchant $merchant)
    {
        $merchant->load(['user', 'games.products', 'orders', 'withdrawals']);
        return view('admin.merchants.show', compact('merchant'));
    }

    public function verify(Merchant $merchant)
    {
        $merchant->update(['verified_at' => now(), 'status' => 'active']);
        return redirect()->back()->with('success', 'Merchant verified successfully');
    }

    public function deactivate(Merchant $merchant)
    {
        $merchant->update(['status' => 'inactive']);
        return redirect()->back()->with('success', 'Merchant deactivated');
    }

    public function activate(Merchant $merchant)
    {
        $merchant->update(['status' => 'active']);
        return redirect()->back()->with('success', 'Merchant activated');
    }
}

