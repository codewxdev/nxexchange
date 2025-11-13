@extends('layouts.admin')

@section('title', isset($signal) ? 'Edit Signal' : 'Create New Signal')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Withdraw Amount Detail</h2>
        </div>
        <div class="card shadow mb-4">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="withdrawTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Email</th>
                                <th>Amount</th>
                                <th> Fee </th>
                                <th>Net Amount</th>
                                <th>Address </th>
                                <th>Transaction ID</th>
                                <th>Status</th>
                                <th>Date & Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($withdraws as $withdraw)
                                @php
                                    // Badge color based on withdrawal status
                                    $badgeColor = match ($withdraw->status) {
                                        'pending' => 'bg-warning',
                                        'approved' => 'bg-success',
                                        'rejected' => 'bg-danger',
                                        'completed' => 'bg-info',
                                    };

                                    // Calculate fee (5%)
                                    // $fee = $withdraw->amount * 0.05;

                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($withdraw->user)->email ?? 'N/A' }}</td>
                                    <td class="text-end">${{ number_format($withdraw->amount, 2) }}</td>
                                    <td class="text-end">${{ number_format($withdraw->withdrawal_fee, 2) }}</td>
                                    <td class="text-end">
                                        ${{ number_format($withdraw->amount - $withdraw->withdrawal_fee, 2) }}</td>
                                    <td>{{ $withdraw->address }}</td>
                                    <td>{{ $withdraw->transaction_id ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge {{ $badgeColor }}">
                                            {{ ucfirst($withdraw->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $withdraw->created_at->format('Y-m-d H:i') }}</td>

                                    <!-- Action Dropdown -->
                                    <td class="text-center">
                                        <div class="dropdown d-inline-block">
                                            <a type="button" id="actionMenu{{ $withdraw->id }}" data-bs-toggle="dropdown"
                                                aria-expanded="false" class="text-dark fs-5" style="text-decoration: none;">
                                                &#x22EE; <!-- Vertical dots icon -->
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
                                                        <button type="submit" class="dropdown-item text-info fw-semibold">
                                                            Completed
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
