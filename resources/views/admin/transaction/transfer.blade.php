@extends('layouts.admin')

@section('title', isset($signal) ? 'Edit Signal' : 'Create New Signal')

@section('content')

    {{-- <form action="{{ route('transfers.store') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <div>
            <label>From:</label>
            <select name="from_account" required>
                <option value="exchange">Exchange</option>
                <option value="trade">Trade</option>
            </select>
        </div>
        <div>
            <label>To:</label>
            <select name="to_account" required>
                <option value="exchange">Exchange</option>
                <option value="trade">Trade</option>
            </select>
        </div>
        <div>
            <label>Amount:</label>
            <input type="number" step="0.01" name="amount" required>
        </div>
        <div>
            <label>Volume Incomplete?</label>
            <input type="checkbox" name="volume_incomplete" value="1">
        </div>
        <button type="submit">Submit Transfer</button>
    </form> --}}
    <div class="container-fluid">
        <h2 class="mb-4">Transfer Amount Detail</h2>

        <div class="card shadow mb-4">
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
                            @foreach ($transfers as $transfer)
                                @php
                                    // Badge color based on transfer status
                                    $badgeColor = match ($transfer->status) {
                                        'pending' => 'bg-warning',
                                        'completed' => 'bg-success',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($transfer->user)->email ?? 'N/A' }}</td>
                                    <td>{{ ucfirst($transfer->from_account) }}</td>
                                    <td>{{ ucfirst($transfer->to_account) }}</td>
                                    <td class="text-end">{{ number_format($transfer->amount, 8) }}</td>
                                    <td class="text-end">
                                        {{ $transfer->deduction ? number_format($transfer->deduction, 8) : '-' }}</td>
                                    <td><span class="badge {{ $badgeColor }}">{{ ucfirst($transfer->status) }}</span></td>
                                    <td>{{ $transfer->date_time->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
