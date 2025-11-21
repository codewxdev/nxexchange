@extends('Layouts.FrontLayout')

@section('title', 'Transaction History')

@section('content')
    <div class="container-fluid py-4 px-5">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm" style="background: #000000; border: 1px solid #000000;">
                    <div class="card-header bg-transparent border-bottom" style="border-color: #000000!important;">
                        <h4 class="mb-0" style="color: #ff783a">Transaction History</h4>
                    </div>
                    <div class="card-body p-0">
                        @if ($transactions->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-borderless mb-0" style="background: transparent;">
                                    <thead>
                                        <tr style="background: #000000; color: #ff783a; border-bottom: 2px solid #2a2f42;">
                                            <th class="ps-4 py-3" style="font-weight: 600; font-size: 0.875rem;">#</th>
                                            <th class="py-3" style="font-weight: 600; font-size: 0.875rem;">Type</th>
                                            <th class="py-3" style="font-weight: 600; font-size: 0.875rem;">From Wallet
                                            </th>
                                            <th class="py-3" style="font-weight: 600; font-size: 0.875rem;">To Wallet</th>
                                            <th class="text-end py-3" style="font-weight: 600; font-size: 0.875rem;">Amount
                                            </th>
                                            <th class="py-3" style="font-weight: 600; font-size: 0.875rem;">Status</th>
                                            <th class="py-3" style="font-weight: 600; font-size: 0.875rem;">Remark</th>
                                            <th class="pe-4 py-3" style="font-weight: 600; font-size: 0.875rem;">Date & Time
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr
                                                style="border-bottom: 1px solid #2a2f42; transition: background-color 0.2s ease;">
                                                <td class="ps-4 py-3 text-white">{{ $loop->iteration }}</td>
                                                <td class="py-3">
                                                    <span
                                                        class="badge
                                            @if ($transaction->type == 'deposit') bg-success
                                            @elseif($transaction->type == 'withdrawal')
                                                bg-danger
                                            @elseif($transaction->type == 'transfer')
                                                bg-info
                                            @else
                                                bg-warning @endif"
                                                        style="font-size: 0.75rem; padding: 0.4rem 0.7rem;">
                                                        {{ ucfirst($transaction->type) }}
                                                    </span>
                                                </td>
                                                <td class="py-3">
                                                    @if ($transaction->from_wallet)
                                                        <span class="badge bg-secondary"
                                                            style="font-size: 0.75rem; padding: 0.4rem 0.7rem;">
                                                            {{ ucfirst($transaction->from_wallet) }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted" style="font-size: 0.875rem;">-</span>
                                                    @endif
                                                </td>
                                                <td class="py-3">
                                                    @if ($transaction->to_wallet)
                                                        <span class="badge bg-secondary"
                                                            style="font-size: 0.75rem; padding: 0.4rem 0.7rem;">
                                                            {{ ucfirst($transaction->to_wallet) }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted" style="font-size: 0.875rem;">-</span>
                                                    @endif
                                                </td>
                                                <td class="text-end py-3">
                                                    <span
                                                        class="fw-bold
                                            @if ($transaction->type == 'deposit') text-success
                                            @elseif($transaction->type == 'withdrawal')
                                                text-danger
                                            @else
                                                text-white @endif"
                                                        style="font-size: 0.875rem;">
                                                        {{ number_format($transaction->amount, 8) }}
                                                    </span>
                                                </td>
                                                <td class="py-3">
                                                    <span
                                                        class="badge
                                            @if ($transaction->status == 'completed') bg-success
                                            @elseif($transaction->status == 'pending')
                                                bg-warning
                                            @else
                                                bg-danger @endif"
                                                        style="font-size: 0.75rem; padding: 0.4rem 0.7rem;">
                                                        {{ ucfirst($transaction->status) }}
                                                    </span>
                                                </td>
                                                <td class="py-3">
                                                    @if ($transaction->remark)
                                                        <span class="text-white" style="font-size: 0.875rem;"
                                                            title="{{ $transaction->remark }}">
                                                            {{ Str::limit($transaction->remark, 25) }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted" style="font-size: 0.875rem;">-</span>
                                                    @endif
                                                </td>
                                                <td class="pe-4 py-3 text-white" style="font-size: 0.875rem;">
                                                    {{ $transaction->created_at->format('Y-m-d H:i') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div id="emptyTransactions" class="text-center py-5">
                                <i class="fa-regular fa-folder-open fa-4x mb-3" style="color:#ff783a;"></i>
                                <h4 class="text-white">No transactions found</h4>
                                <p class="text-muted">Once you make transactions, those will appear here.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card {
            background: #32343b;
            border: 1px solid #2a2f42;
            border-radius: 8px;
        }

        .table {
            margin-bottom: 0;
        }

        .table tbody tr:hover {
            background-color: #32343b !important;
        }

        .badge {
            border-radius: 4px;
            font-weight: 500;
        }

        .bg-success {
            background-color: #00b894 !important;
        }

        .bg-danger {
            background-color: #ff7675 !important;
        }

        .bg-warning {
            background-color: #fdcb6e !important;
            color: #2d3436 !important;
        }

        .bg-info {
            background-color: #74b9ff !important;
        }

        .bg-secondary {
            background-color: #636e72 !important;
        }

        .text-success {
            color: #00b894 !important;
        }

        .text-danger {
            color: #ff7675 !important;
        }

        .text-muted {
            color: #6c757d !important;
        }

        body {
            background-color: #0f1117 !important;
        }
    </style>
@endsection
