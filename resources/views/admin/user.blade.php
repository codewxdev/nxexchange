@extends('layouts.admin')

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
                                <th>Action Type</th>
                                <th class="text-end">Amount</th>
                                <th>Date & Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Assuming the data passed to the view is now called $recentActivities for clarity --}}
                            @foreach ($users as $activity)
                                @php
                                    // Placeholder logic for dynamic styling based on action type
                                    $actionType = 'Deposit'; // Replace with $activity->action_type if data is dynamic
                                    $amount = '$200'; // Replace with $activity->amount
                                    $userEmail = 'john@example.com'; // Replace with $activity->user_email
                                    $date = '2025-11-10 14:30'; // Replace with $activity->created_at or similar

                                    // Determine badge color based on action
                                    $badgeColor = match ($actionType) {
                                        'Deposit', 'Win' => 'bg-success',
                                        'Withdrawal', 'Loss' => 'bg-danger',
                                        'Transfer' => 'bg-info',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $userEmail }}</td>
                                    <td>
                                        <span class="badge {{ $badgeColor }}">{{ $actionType }}</span>
                                    </td>
                                    <td class="text-end">
                                        <strong>{{ $amount }}</strong>
                                    </td>
                                    <td>{{ $date }}</td>
                                </tr>
                            @endforeach

                            {{-- Example of another row using placeholder logic --}}
                            {{-- <tr>
                                <td>alice@example.com</td>
                                <td><span class="badge bg-danger">Withdrawal</span></td>
                                <td class="text-end"><strong>$500</strong></td>
                                <td>2025-11-10 15:45</td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
