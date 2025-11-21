@extends('admin.Layouts.admin')

@section('title', 'Transfer Management')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Transfer Amount Detail</h2>
        </div>

        <!-- Filters Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('transfers.index') }}" id="filterForm">
                    <div class="row">
                        <!-- From Account Filter -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">From Account</label>
                            <select class="form-select" name="from_account" id="from_account">
                                <option value="all">All From Accounts</option>
                                <option value="exchange" {{ request('from_account') == 'exchange' ? 'selected' : '' }}>
                                    Exchange</option>
                                <option value="trade" {{ request('from_account') == 'trade' ? 'selected' : '' }}>Trade
                                </option>
                            </select>
                        </div>

                        <!-- To Account Filter -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">To Account</label>
                            <select class="form-select" name="to_account" id="to_account">
                                <option value="all">All To Accounts</option>
                                <option value="exchange" {{ request('to_account') == 'exchange' ? 'selected' : '' }}>
                                    Exchange</option>
                                <option value="trade" {{ request('to_account') == 'trade' ? 'selected' : '' }}>Trade
                                </option>
                            </select>
                        </div>

                        <!-- Status Filter -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="all">All Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                                </option>
                            </select>
                        </div>

                        <!-- Date Filter -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" id="date"
                                value="{{ request('date') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel me-1"></i> Apply Filters
                            </button>
                            <a href="{{ route('transfers.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Transfers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTransfers }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-arrow-left-right fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Amount</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalAmount, 8) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-currency-dollar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Transfers</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingTransfers }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Total Deduction</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalDeduction, 8) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-percent fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transfers Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Transfer Transactions</h6>
                <span class="text-muted">
                    Showing {{ $transfers->count() }} transfers
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="transferTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Email</th>
                                <th>From Account</th>
                                <th>To Account</th>
                                <th class="text-end">Amount</th>
                                <th class="text-end">Deduction</th>
                                <th>Status</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($transfers as $transfer)
                                @php
                                    $badgeColor = match ($transfer->status) {
                                        'pending' => 'bg-warning',
                                        'completed' => 'bg-success',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($transfer->user)->email ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($transfer->from_account) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($transfer->to_account) }}
                                        </span>
                                    </td>
                                    <td class="text-end">{{ number_format($transfer->amount, 8) }}</td>
                                    <td class="text-end">
                                        {{ $transfer->deduction ? number_format($transfer->deduction, 8) : '-' }}
                                    </td>
                                    <td>
                                        <span class="badge {{ $badgeColor }}">
                                            {{ ucfirst($transfer->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $transfer->date_time->format('Y-m-d H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">
                                        <i class="bi bi-inbox fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">No transfers found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Auto submit form when select filters change
            $('#from_account, #to_account, #status').change(function() {
                $('#filterForm').submit();
            });

            // Date filter auto-submit
            $('#date').change(function() {
                if ($(this).val()) {
                    $('#filterForm').submit();
                }
            });

            // Set max date to today for date input
            var today = new Date().toISOString().split('T')[0];
            $('#date').attr('max', today);
        });
    </script>

    <style>
        .table th {
            border-top: none;
            font-weight: 600;
            background-color: #f8f9fa;
        }

        .badge {
            font-size: 0.75em;
            padding: 0.5em 0.75em;
        }

        .text-end {
            text-align: right;
        }
    </style>
@endsection
