@extends('admin.Layouts.admin')

@section('title', 'Admin Dashboard Overview')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">Users Detail</h2>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Recent Platform Activity</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="activityTable">
                        <thead>
                            <tr>
                                <th>User Email</th>
                                <th>Level</th>
                                <th>Account Status</th>
                                <th>KYC Status</th>
                                <th class="text-end">Exchange Balance</th>
                                <th class="text-end">Trade Balance</th>
                                <th>Registered At</th>
                                <th>Last Login</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @php
                                    // Example action/amount logic if needed, can be replaced with actual activity data
                                    $actionType = $user->account_status; // just for badge example
                                    $badgeColor = match ($actionType) {
                                        'active' => 'bg-success',
                                        'locked' => 'bg-warning',
                                        'deactivated' => 'bg-danger',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->level }}</td>
                                    <td><span class="badge {{ $badgeColor }}">{{ ucfirst($user->account_status) }}</span>
                                    </td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $user->kyc_status)) }}</td>
                                    <td class="text-end">${{ number_format($user->exchange_balance, 2) }}</td>
                                    <td class="text-end">${{ number_format($user->trade_balance, 2) }}</td>
                                    <td>{{ $user->registered_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ optional($user->last_login_at)?->format('Y-m-d H:i') ?? 'Never' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
