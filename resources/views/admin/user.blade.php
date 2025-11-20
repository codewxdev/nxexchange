@extends('admin.Layouts.admin')

@section('title', 'Admin Dashboard Overview')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">Users Detail</h2>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Recent Platform Activity</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover" id="activityTable">
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @php
                                    $actionType = $user->account_status;
                                    $badgeColor = match ($actionType) {
                                        'active' => 'bg-success',
                                        'deactivated' => 'bg-danger',
                                    };

                                    $kycBadgeColor = match ($user->kyc_status) {
                                        'verified' => 'bg-success',
                                        'pending' => 'bg-warning',
                                        'rejected' => 'bg-danger',
                                        'not_verified' => 'bg-secondary',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <tr>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->level }}</td>
                                    <td>
                                        <span class="badge {{ $badgeColor }}">
                                            {{ ucfirst($user->account_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $kycBadgeColor }}">
                                            {{ ucfirst(str_replace('_', ' ', $user->kyc_status)) }}
                                        </span>
                                    </td>
                                    <td>${{ number_format($user->exchange_balance, 2) }}</td>
                                    <td>${{ number_format($user->trade_balance, 2) }}</td>
                                    <td>{{ $user->registered_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ optional($user->last_login_at)?->format('Y-m-d H:i') ?? 'Never' }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-light btn-sm p-2 rounded-circle" type="button"
                                                data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>

                                            <ul class="dropdown-menu dropdown-menu-end">
                                                <li>
                                                    <a class="dropdown-item update-user" href="#"
                                                        data-user-id="{{ $user->id }}"
                                                        data-user-email="{{ $user->email }}"
                                                        data-user-level="{{ $user->level }}"
                                                        data-user-account-status="{{ $user->account_status }}"
                                                        data-user-kyc-status="{{ $user->kyc_status }}">
                                                        <i class="bi bi-pencil me-2 text-primary"></i> Update
                                                    </a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item text-danger delete-user" href="#"
                                                        data-user-id="{{ $user->id }}">
                                                        <i class="bi bi-trash me-2"></i> Delete
                                                    </a>
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

    <!-- Update User Modal -->
    <div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateUserModalLabel">Update User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateUserForm" method="POST" action="{{ route('admin.users.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="user_id" id="user_id">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" id="user_email" readonly>
                        </div>

                        <!-- Level Selection -->
                        <div class="mb-3">
                            <label class="form-label">Level</label>
                            <select class="form-select" name="level" id="user_level" required>
                                <option value="0">Level 0</option>
                                <option value="1">Level 1</option>
                                <option value="2">Level 2</option>
                                <option value="3">Level 3</option>
                                <option value="4">Level 4</option>
                                <option value="5">Level 5</option>
                                <option value="6">Level 6</option>
                            </select>
                        </div>

                        <!-- Account Status Radio Buttons -->
                        <div class="mb-3">
                            <label class="form-label">Account Status</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="account_status" id="account_active"
                                        value="active">
                                    <label class="form-check-label" for="account_active">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="account_status"
                                        id="account_deactivated" value="deactivated">
                                    <label class="form-check-label" for="account_deactivated">Deactivated</label>
                                </div>
                            </div>
                        </div>

                        <!-- KYC Status Radio Buttons -->
                        <div class="mb-3">
                            <label class="form-label">KYC Status</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kyc_status" id="kyc_verified"
                                        value="verified">
                                    <label class="form-check-label" for="kyc_verified">Verified</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kyc_status" id="kyc_not_verified"
                                        value="not_verified">
                                    <label class="form-check-label" for="kyc_not_verified">Not Verified</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kyc_status" id="kyc_pending"
                                        value="pending">
                                    <label class="form-check-label" for="kyc_pending">Pending</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="kyc_status" id="kyc_rejected"
                                        value="rejected">
                                    <label class="form-check-label" for="kyc_rejected">Rejected</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            // Update user modal
            $('.update-user').on('click', function() {
                var userId = $(this).data('user-id');
                var userEmail = $(this).data('user-email');
                var userLevel = $(this).data('user-level');
                var userAccountStatus = $(this).data('user-account-status');
                var userKycStatus = $(this).data('user-kyc-status');

                $('#user_id').val(userId);
                $('#user_email').val(userEmail);
                $('#user_level').val(userLevel);

                // Set account status radio
                $('input[name="account_status"][value="' + userAccountStatus + '"]').prop('checked', true);

                // Set KYC status radio
                $('input[name="kyc_status"][value="' + userKycStatus + '"]').prop('checked', true);

                // Show modal
                $('#updateUserModal').modal('show');
            });

            // Delete user confirmation with proper AJAX
            $('.delete-user').on('click', function(e) {
                e.preventDefault();
                var userId = $(this).data('user-id');
                var userEmail = $(this).closest('tr').find('td:first').text();

                if (confirm('Are you sure you want to delete user: ' + userEmail + '?')) {
                    var $button = $(this);
                    $button.prop('disabled', true).html('<i class="bi bi-trash me-2"></i> Deleting...');

                    $.ajax({
                        url: '/admin/users/' + userId,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                // Remove the row from table
                                $button.closest('tr').fadeOut(300, function() {
                                    $(this).remove();
                                });
                                // Simple success message in console
                                console.log('User deleted successfully:', response.message);
                            } else {
                                console.error('Delete failed:', response.message);
                                $button.prop('disabled', false).html(
                                    '<i class="bi bi-trash me-2"></i> Delete');
                            }
                        },
                        error: function(xhr) {
                            var errorMessage = 'Error deleting user';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }
                            console.error('Delete error:', errorMessage);
                            $button.prop('disabled', false).html(
                                '<i class="bi bi-trash me-2"></i> Delete');
                        }
                    });
                }
            });
        });
    </script>
@endsection
<style>
    /* -- RESPONSIVE TABLE -- */
    @media (max-width: 768px) {
        table thead {
            display: none;
        }

        table tbody tr {
            display: block;
            margin-bottom: 15px;
            background: #fff;
            border-radius: 8px;
            padding: 12px;
            box-shadow: 0px 3px 12px rgba(0, 0, 0, 0.1);
        }

        table tbody tr td {
            display: flex;
            justify-content: space-between;
            padding: 8px 5px;
            border: none;
            font-size: 14px;
        }

        table tbody tr td::before {
            content: attr(data-label);
            font-weight: 600;
            color: #555;
        }

        .dropdown-menu {
            position: absolute !important;
            inset: auto auto 0px 0px !important;
            transform: translate(0px, -10px) !important;
        }
    }

    /* 3-dots button styling */
    .btn-light.btn-sm {
        background: #f1f1f1;
        border: none;
    }
</style>
