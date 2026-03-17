@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Dashboard</h2>
</div>

<!-- Stats Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-primary text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Transaksi</h5>
                        <h2>{{ number_format($totalTransactions) }}</h2>
                    </div>
                    <i class="bi bi-receipt fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-success text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total User</h5>
                        <h2>{{ number_format($totalUsers) }}</h2>
                    </div>
                    <i class="bi bi-people fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-info text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Total Merchant</h5>
                        <h2>{{ number_format($totalMerchants) }}</h2>
                    </div>
                    <i class="bi bi-shop fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card bg-warning text-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5>Pendapatan</h5>
                        <h2>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h2>
                    </div>
                    <i class="bi bi-currency-exchange fs-1 opacity-75"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart -->
<div class="row">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                <h5>Transaksi Harian</h5>
            </div>
            <div class="card-body">
                <canvas id="transactionChart"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
const ctx = document.getElementById('transactionChart').getContext('2d');
const chart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json(array_reverse($dailyTransactions->pluck('date')->toArray())),
        datasets: [{
            label: 'Transaksi',
            data: @json(array_reverse($dailyTransactions->pluck('count')->toArray())),
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
@endpush
@endsection

