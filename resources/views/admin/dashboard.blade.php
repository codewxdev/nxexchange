@extends('admin.Layouts.admin')

@section('title', 'Admin Dashboard Overview')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3 text-dark">Dashboard Overview</h4>

        <!-- Statistics Cards with Icons on Left -->
        <div class="row mb-3">
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded p-3 me-3">
                                <i class="bi bi-people text-white fs-4"></i>
                            </div>
                            <div>
                                <h6 class="card-title text-muted mb-1">Total Users</h6>
                                <h4 class="mb-0 text-dark">{{ $totalUsers }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-success rounded p-3 me-3">
                                <i class="bi bi-graph-up text-white fs-4"></i>
                            </div>
                            <div>
                                <h6 class="card-title text-muted mb-1">Total Trades</h6>
                                <h4 class="mb-0 text-dark">{{ $totalTrades }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-info rounded p-3 me-3">
                                <i class="bi bi-arrow-down-circle text-white fs-4"></i>
                            </div>
                            <div>
                                <h6 class="card-title text-muted mb-1">Total Deposit</h6>
                                <h4 class="mb-0 text-dark">${{ number_format($totalDeposit, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning rounded p-3 me-3">
                                <i class="bi bi-arrow-up-circle text-white fs-4"></i>
                            </div>
                            <div>
                                <h6 class="card-title text-muted mb-1">Total Withdrawal</h6>
                                <h4 class="mb-0 text-dark">${{ number_format($totalWithdrawal, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Row: Latest Users (Left) and Pie Chart (Right) -->
        <div class="row mb-3">
            <!-- Left Side - Latest 5 Users with Scroll -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-2">
                        <h6 class="m-0 font-weight-bold ">Latest Users</h6>
                    </div>
                    <div class="card-body p-0">
                        <div style="max-height: 250px; overflow-y: auto;">
                            <table class="table table-sm table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-0 ps-3">Email</th>
                                        <th class="border-0">Level</th>
                                        <th class="border-0">Status</th>
                                        <th class="border-0 pe-3">Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($latestUsers->take(5) as $user)
                                        <tr>
                                            <td class="ps-3">
                                                <small class="text-dark">{{ Str::limit($user->email, 20) }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">Level {{ $user->level }}</span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $user->account_status == 'active' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($user->account_status) }}
                                                </span>
                                            </td>
                                            <td class="pe-3">
                                                @if ($user)
                                                      <small class="text-muted">{{ $user->created_at }}</small>

                                                      @else
                                                        <small class="text-muted">Not available</small>
                                                @endif
                                               
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($latestUsers->count() > 5)
                                        @foreach ($latestUsers->skip(5) as $user)
                                            <tr>
                                                <td class="ps-3">
                                                    <small class="text-dark">{{ Str::limit($user->email, 20) }}</small>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">Level {{ $user->level }}</span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge bg-{{ $user->account_status == 'active' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($user->account_status) }}
                                                    </span>
                                                </td>
                                                <td class="pe-3">
                                                    <small
                                                        class="text-muted">{{ $user->created_at->format('M d') }}</small>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Users Pie Chart -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white py-2">
                        <h6 class="m-0 font-weight-bold">Users Status</h6>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center p-2">
                        <canvas id="usersPieChart" width="150" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Row: Last Month Trades Graph -->
        <div class="row">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-2">
                        <h6 class="m-0 font-weight-bold ">Last Month Trades</h6>
                    </div>
                    <div class="card-body p-3">
                        <canvas id="tradesLineChart" width="100%" height="auto"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <!-- Chart.js Library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        $(document).ready(function() {
            // Users Pie Chart - Active vs Deactivated (Small Size)
            const usersCtx = document.getElementById('usersPieChart').getContext('2d');
            const usersChart = new Chart(usersCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Active ({{ $activeUsers }})', 'Deactivated ({{ $deactivatedUsers }})'],
                    datasets: [{
                        data: [{{ $activeUsers }}, {{ $deactivatedUsers }}],
                        backgroundColor: ['#10b981', '#ef4444'],
                        borderWidth: 1,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                boxWidth: 10,
                                font: {
                                    size: 10
                                }
                            }
                        }
                    },
                    cutout: '50%'
                }
            });

            // Last Month Trades Line Chart with Real Data (Small Size)
            const tradesCtx = document.getElementById('tradesLineChart').getContext('2d');
            const tradesChart = new Chart(tradesCtx, {
                type: 'line',
                data: {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    datasets: [{
                        label: 'Trades',
                        data: @json($lastMonthTradesData),
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        borderColor: '#3b82f6',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#3b82f6',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 3
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            },
                            ticks: {
                                precision: 0,
                                font: {
                                    size: 10
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 10
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            bodyFont: {
                                size: 11
                            },
                            titleFont: {
                                size: 11
                            },
                            callbacks: {
                                label: function(context) {
                                    return `Trades: ${context.raw}`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <style>
        .card {
            background-color: #f8f9fa;
        }

        .card-header {
            border-bottom: 1px solid #e3e6f0;
        }

        .table td {
            padding: 0.4rem;
        }

        .bg-primary {
            background-color: #3b82f6 !important;
        }

        .bg-success {
            background-color: #10b981 !important;
        }

        .bg-info {
            background-color: #06b6d4 !important;
        }

        .bg-warning {
            background-color: #f59e0b !important;
        }

        /* Smaller font sizes for compact design */
        .card-body h4 {
            font-size: 1.25rem;
        }

        .card-body h6 {
            font-size: 0.8rem;
        }

        .table small {
            font-size: 0.75rem;
        }

        .badge {
            font-size: 0.7rem;
        }
    </style>
@endsection
