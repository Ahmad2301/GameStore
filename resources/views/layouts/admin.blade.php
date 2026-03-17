<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Game Store') </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-dark sidebar vh-100 position-fixed" style="width: 280px;">
            <div class="p-3 mb-2">
                <h4 class="text-white">Game Store Admin</h4>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'active bg-primary' : '' }}" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-house-door me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('admin.merchants.*') ? 'active bg-primary' : '' }}" href="{{ route('admin.merchants.index') }}">
                        <i class="bi bi-shop me-2"></i> Merchants
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('admin.games.*') ? 'active bg-primary' : '' }}" href="{{ route('admin.games.index') }}">
                        <i class="bi bi-controller me-2"></i> Games
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('admin.orders.*') ? 'active bg-primary' : '' }}" href="{{ route('admin.orders.index') }}">
                        <i class="bi bi-cart me-2"></i> Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('admin.transactions.*') ? 'active bg-primary' : '' }}" href="{{ route('admin.transactions.index') }}">
                        <i class="bi bi-credit-card me-2"></i> Transactions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('admin.withdrawals.*') ? 'active bg-primary' : '' }}" href="{{ route('admin.withdrawals.index') }}">
                        <i class="bi bi-cash me-2"></i> Withdrawals
                    </a>
                </li>
            </ul>
            <div class="mt-auto p-3">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex-grow-1 ms-3 p-4">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>

