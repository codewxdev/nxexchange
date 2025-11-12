@extends('layouts.admin')

@section('title', isset($signal) ? 'Edit Signal' : 'Create New Signal')

@section('content')
    <h4>Deposit Form</h4>
    <form action="{{ route('deposits.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <div>
            <label>Amount:</label>
            <input type="number" step="0.01" name="amount" required>
        </div>
        <div>
            <label>Payment Gateway:</label>
            <select name="payment_gateway">
                <option value="NowPayments">NowPayments</option>
                <option value="Gate.io">Gate.io</option>
            </select>
        </div>
        <div>
            <label>Transaction ID (optional):</label>
            <input type="text" name="transaction_id">
        </div>
        <button type="submit">Submit Deposit</button>
    </form>
    <div class="container-fluid">
        <h2 class="mb-4">Deposit Detail</h2>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Platform Activity</h6>
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
                            @foreach ($deposits as $deposit)
                                @php
                                    // Badge color based on deposit status
                                    $badgeColor = match ($deposit->status) {
                                        'pending' => 'bg-warning',
                                        'approved' => 'bg-success',
                                        'rejected' => 'bg-danger',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($deposit->user)->email ?? 'N/A' }}</td>
                                    <td class="text-end">${{ number_format($deposit->amount, 2) }}</td>
                                    <td>{{ ucfirst($deposit->payment_gateway) }}</td>
                                    <td><span class="badge {{ $badgeColor }}">{{ ucfirst($deposit->status) }}</span></td>
                                    <td>{{ $deposit->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
