@extends('admin.Layouts.admin')

@section('title', 'Trade History')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">Trade History</h2>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Trades</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="activityTable">
                        <thead>
                            <tr>
                                <th>User Email</th>
                                <th>Direction</th>
                                <th>Trade Type</th>
                                <th>Crypto Symbol</th>
                                <th>Crypto Price</th>
                                <th>Stake Amount</th>
                                <th>Profit Amount</th>
                                <th>Profit Rate</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($trades as $trade)
                                <tr>
                                    <td>{{ $trade->user->email ?? 'N/A' }}</td>
                                    <td>
                                        <span class="badge bg-{{ $trade->direction == 'call' ? 'success' : 'danger' }}">
                                            {{ $trade->direction ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>{{ $trade->trade_type ?? 'N/A' }}</td>
                                    <td>{{ $trade->signal->crypto_symbol ?? 'N/A' }}</td>
                                    <td>${{ number_format($trade->crypto_price, 2) }}</td>
                                    <td>${{ number_format($trade->stake_amount, 2) }}</td>
                                    <td>
                                        <span class="{{ $trade->profit_amount >= 0 ? 'text-success' : 'text-danger' }}">
                                            ${{ number_format($trade->profit_amount, 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="{{ $trade->profit_rate >= 0 ? 'text-success' : 'text-danger' }}">
                                            {{ $trade->profit_rate }}%
                                        </span>
                                    </td>
                                    <td>{{ $trade->signal->start_time ?? 'N/A' }}</td>
                                    <td>{{ $trade->signal->end_time ?? 'N/A' }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $trade->result == 'win' ? 'success' : ($trade->result == 'loss' ? 'danger' : 'warning') }}">
                                            {{ $trade->status ?? 'pending' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center">No trades found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
