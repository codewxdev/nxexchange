@extends('admin.Layouts.admin')

@section('title', 'Deposit Management')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Deposits</h2>
        </div>

        <!-- Filters Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Filters</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('deposits.index') }}" id="filterForm">
                    <div class="row">
                        <!-- Status Filter -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <option value="all">All Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed
                                </option>
                                <option value="failed" {{ request('status') == 'failed' ? 'selected' : '' }}>Failed</option>
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
                            <a href="{{ route('deposits.index') }}" class="btn btn-secondary">
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
                                    Total Deposits</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDeposits }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-wallet2 fa-2x text-gray-300"></i>
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
                                    Total Deposits Amount</div>
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
                                    Pending Deposits</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingDeposits }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <!-- Deposits Table -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Deposits History</h6>
                <span class="text-muted">
                    Showing {{ $deposits->count() }} deposits
                </span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="depositTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Email</th>
                                <th>Amount</th>
                                <th>Payment Gateway</th>
                                <th>Status</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deposits as $deposit)
                                @php
                                    $badgeColor = match ($deposit->status) {
                                        'pending' => 'bg-warning',
                                        'confirmed' => 'bg-success',
                                        'failed' => 'bg-danger',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($deposit->user)->email ?? 'N/A' }}</td>
                                    <td class="text-end">${{ number_format($deposit->amount, 2) }}</td>
                                    <td>{{ ucfirst($deposit->payment_gateway) ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $badgeColor }}">
                                            {{ ucfirst($deposit->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $deposit->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <i class="bi bi-inbox fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">No deposits found</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination (if using paginate) -->
                @if (method_exists($deposits, 'links'))
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted">
                            Showing {{ $deposits->firstItem() }} to {{ $deposits->lastItem() }} of
                            {{ $deposits->total() }} entries
                        </div>
                        <nav>
                            {{ $deposits->links() }}
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Auto submit form when select filters change
            $('#status, #payment_gateway').change(function() {
                $('#filterForm').submit();
            });

            // Date validation
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
@endsection
