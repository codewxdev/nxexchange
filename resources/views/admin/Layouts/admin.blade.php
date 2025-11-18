<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/logo3.png') }}" type="image/x-icon">

    <!-- Single Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <style>
        .dropdown-menu {
            background-color: #212529;
        }

        .dropdown-item {
            color: #fff;
        }

        .dropdown-item:hover {
            background-color: #343a40;
        }
    </style>
</head>

<body>
    {{-- Sidebar --}}
    <div class="d-flex" id="wrapper">
        <div class="bg-dark text-white p-3" id="sidebar">
            <h4 class="text-center mb-4">NX Exchange</h4>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link text-white"><i
                            class="bi bi-speedometer2"></i> Dashboard</a></li>
                <li class="nav-item"><a href="{{ route('admin.user') }}" class="nav-link text-white"><i
                            class="bi bi-people"></i> Users</a></li>
                <li class="nav-item"><a href="{{ route('admin.signals.index') }}" class="nav-link text-white"><i
                            class="bi bi-lightning"></i> Signals</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="transactionDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-lightning"></i> Transaction
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="transactionDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('deposits.index') }}">
                                <i class="bi bi-arrow-down-circle me-2"></i> Deposit
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('withdraw') }}">
                                <i class="bi bi-arrow-up-circle me-2"></i> Withdraw
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ url('transfer') }}">
                                <i class="bi bi-arrow-left-right me-2"></i> Transfer
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item"><a href="{{ route('trade.dashboard') }}" class="nav-link text-white"><i
                            class="bi bi-currency-bitcoin"></i> Trades</a></li>
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link text-white dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-wallet2"></i> Wallets
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li>
                            <a class="dropdown-item" href="{{ route('wallet.dashboard') }}">
                                <i class="bi bi-wallet me-2"></i>Management
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('wallet.transaction.index') }}">
                                <i class="bi bi-clock-history me-2"></i> Wallet History
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>

        {{-- Main Content --}}
        <div id="page-content-wrapper" class="w-100">
            <nav class="navbar navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <span class="navbar-brand">Admin Panel</span>
                    <div>
                        <button class="btn btn-outline-secondary btn-sm">Logout</button>
                    </div>
                </div>
            </nav>

            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- jQuery for Bootstrap compatibility -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Single Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>

</html>
