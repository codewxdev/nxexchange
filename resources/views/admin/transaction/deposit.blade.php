@extends('admin.Layouts.admin')

@section('title', isset($signal) ? 'Edit Signal' : 'Create New Signal')

@section('content')





    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Deposit Amount Detail</h2>
        </div>


        <div class="card shadow mb-4">
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
                                <!-- New column -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deposits as $deposit)
                                @php
                                    // Badge color based on deposit status
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
                                    <td><span class="badge {{ $badgeColor }}">{{ ucfirst($deposit->status) }}</span></td>
                                    <td>{{ $deposit->created_at->format('Y-m-d H:i') }}</td>

                                    <!-- Action Column -->

                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

@endsection
