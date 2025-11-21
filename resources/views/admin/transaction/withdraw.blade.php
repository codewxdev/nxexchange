@extends('admin.Layouts.admin')

@section('title', 'Withdrawal Management')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Withdraw Amount Detail</h2>
        </div>

        <!-- Filters Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('withdraws.index') }}" id="filterForm">
                    <div class="row">
                        <!-- Status Filter -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="all">All Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved
                                </option>
                                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed
                                </option>
                                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected
                                </option>
                            </select>
                        </div>

                        <!-- From Date Filter -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">From Date</label>
                            <input type="date" class="form-control" name="from_date" id="from_date"
                                value="{{ request('from_date') }}">
                        </div>

                        <!-- To Date Filter -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">To Date</label>
                            <input type="date" class="form-control" name="to_date" id="to_date"
                                value="{{ request('to_date') }}">
                        </div>
                        <div class="col-md-3 mb-3 d-flex align-items-end gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-funnel me-1"></i> Filters
                            </button>
                            <a href="{{ route('withdraws.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-clockwise me-1"></i> Reset
                            </a>
                        </div>
                    </div>

                    <div class="row">

                    </div>
                </form>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Withdrawals</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalWithdrawals }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-cash-coin fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Amount</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($totalAmount, 2) }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-currency-dollar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pending Withdrawals</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingWithdrawals }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- Withdrawals Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Withdrawal Transactions</h6>
                <span class="text-muted">
                    Showing {{ $withdraws->count() }} withdrawals
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="withdrawTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Email</th>
                                <th>Amount</th>
                                <th>Fee</th>
                                <th>Net Amount</th>
                                <th>Address</th>
                                <th>Transaction ID</th>
                                <th>Status</th>
                                <th>Date & Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($withdraws as $withdraw)
                                @php
                                    $badgeColor = match ($withdraw->status) {
                                        'pending' => 'bg-warning',
                                        'approved' => 'bg-success',
                                        'rejected' => 'bg-danger',
                                        'completed' => 'bg-info',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($withdraw->user)->email ?? 'N/A' }}</td>
                                    <td class="text-end">${{ number_format($withdraw->amount, 2) }}</td>
                                    <td class="text-end">${{ number_format($withdraw->withdrawal_fee, 2) }}</td>
                                    <td class="text-end">
                                        ${{ number_format($withdraw->amount - $withdraw->withdrawal_fee, 2) }}
                                    </td>
                                    <td>{{ $withdraw->address }}</td>
                                    <td>{{ $withdraw->transaction_id ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $badgeColor }}">
                                            {{ ucfirst($withdraw->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $withdraw->created_at->format('Y-m-d H:i') }}</td>
                                    <td class="text-center">
                                        <div class="dropdown d-inline-block">
                                            <a type="button" id="actionMenu{{ $withdraw->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false" class="text-dark fs-5" style="text-decoration: none;">
                                                &#x22EE;
                                            </a>
                                            <ul class="dropdown-menu dropdown-menu-light shadow-sm text-center"
                                                aria-labelledby="actionMenu{{ $withdraw->id }}"
                                                style="min-width: 120px; background-color: #f8f9fa;">
                                                <li>
                                                    <form action="{{ route('withdraws.updateStatus', $withdraw->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit"
                                                            class="dropdown-item text-success fw-semibold">
                                                            Confirm
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('withdraws.updateStatus', $withdraw->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit"
                                                            class="dropdown-item text-danger fw-semibold">
                                                            Reject
                                                        </button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="{{ route('withdraws.updateStatus', $withdraw->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="status" value="completed">
                                                        <button type="submit"
                                                            class="dropdown-item text-info fw-semibold">
                                                            Completed
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4">
                                        <i class="bi bi-inbox fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">No withdrawals found</p>
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
            // Auto submit form when status filter changes
            $('#status').change(function() {
                $('#filterForm').submit();
            });

            // Date validation and auto-submit
            $('#from_date, #to_date').change(function() {
                var fromDate = new Date($('#from_date').val());
                var toDate = new Date($('#to_date').val());

                if ($('#from_date').val() && $('#to_date').val() && fromDate > toDate) {
                    alert('To date cannot be earlier than from date!');
                    $(this).val('');
                } else if ($('#from_date').val() || $('#to_date').val()) {
                    // Auto-submit if either date is selected
                    $('#filterForm').submit();
                }
            });

            // Set max date to today for date inputs
            var today = new Date().toISOString().split('T')[0];
            $('#from_date').attr('max', today);
            $('#to_date').attr('max', today);
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

        .dropdown-menu {
            min-width: 140px;
        }
    </style>
@endsection
