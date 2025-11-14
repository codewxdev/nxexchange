<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/logo3.png')}}" type="image/x-icon">
    {{-- Tailwind or Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <!-- In <head> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Before </body> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
                    <ul class="dropdown-menu" aria-labelledby="transactionDropdown">
                        <li><a class="dropdown-item" href="{{ route('deposits.index') }}">Deposit</a></li>
                        <li><a class="dropdown-item" href="{{ url('withdraw') }}">Withdraw</a></li>
                        <li><a class="dropdown-item" href="{{ url('transfer') }}">Transfer</a></li>
                    </ul>
                </li>

                <li class="nav-item"><a href="#" class="nav-link text-white"><i
                            class="bi bi-currency-bitcoin"></i> Trades</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-white"><i class="bi bi-wallet2"></i>
                        Wallets</a></li>
                {{-- <li class="nav-item"><a href="#" class="nav-link text-white"><i class="bi bi-graph-up"></i>
                        Reports</a></li> --}}
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
