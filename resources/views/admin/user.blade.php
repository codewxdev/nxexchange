@extends('admin.Layouts.admin')

@section('title', 'Admin Dashboard Overview')

@section('content')
    <div class="container-fluid">
            
        <h2 class="mb-4">Users Detail</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Filters Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold">Filters</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.user') }}" id="filterForm">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">KYC Status</label>
                            <select class="form-select" name="kyc_status" id="kyc_status">
                                <option value="all">All KYC Status</option>
                                <option value="verified" {{ request('kyc_status') == 'verified' ? 'selected' : '' }}>
                                    Verified</option>
                                <option value="pending" {{ request('kyc_status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="rejected" {{ request('kyc_status') == 'rejected' ? 'selected' : '' }}>
                                    Rejected</option>
                                <option value="not_verified"
                                    {{ request('kyc_status') == 'not_verified' ? 'selected' : '' }}>Not Verified</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Account Status</label>
                            <select class="form-select" name="account_status" id="account_status">
                                <option value="all">All Account Status</option>
                                <option value="active" {{ request('account_status') == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="deactivated"
                                    {{ request('account_status') == 'deactivated' ? 'selected' : '' }}>Deactivated</option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Apply Filters</button>
                            <a href="{{ route('admin.user') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold">Recent Platform Activity</h6>
                <div class="text-muted">
                    Total Users: {{ $users->count() }}
                </div>
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
                                <th>Registered At</th>
                                {{-- <th>Last Login</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($users as $user)
                                @php
                                    $actionType = strtolower($user->account_status ?? 'unknown');
                                    $badgeColor = match ($actionType) {
                                        'active' => 'bg-success',
                                        'deactivated' => 'bg-danger',
                                        default => 'bg-secondary',
                                    };

                                    $kycStatus = strtolower($user->kyc_status ?? 'not_verified');
                                    $kycBadgeColor = match ($kycStatus) {
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
                                    <td>{{ $user->registered_at->format('Y-m-d H:i') }}</td>
                                    {{-- <td>{{ optional($user->last_login_at)?->format('Y-m-d H:i') ?? 'Never' }}</td> --}}
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

                                                <!-- Add View KYC Option -->
                                                <li>
                                                    <a class="dropdown-item view-kyc" href="#"
                                                        data-user-id="{{ $user->id }}"
                                                        data-user-email="{{ $user->email }}"
                                                        data-user-kyc-status="{{ $user->kyc_status }}"
                                                        data-user-country="{{ $user->country ?? 'Not provided' }}"
                                                        data-user-id-card-number="{{ $user->id_card_number ?? 'Not provided' }}"
                                                        data-user-kyc-front-image="{{ $user->kyc_front_image ?? '' }}"
                                                        data-user-kyc-back-image="{{ $user->kyc_back_image ?? '' }}">
                                                        <i class="bi bi-eye me-2 text-info"></i> View KYC
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="{{ route('admin.users.delete', $user->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('کیا آپ یقینی ہیں؟ {{ $user->email }} کو delete کریں؟');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item text-danger">
                                                            <i class="bi bi-trash me-2"></i> Delete
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
                                    <input class="form-check-input" type="radio" name="account_status"
                                        id="account_active" value="active">
                                    <label class="form-check-label" for="account_active">Active</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="account_status"
                                        id="account_deactivated" value="deactivated">
                                    <label class="form-check-label" for="account_deactivated">Deactivated</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View KYC Modal -->
    <div class="modal fade" id="viewKycModal" tabindex="-1" aria-labelledby="viewKycModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewKycModalLabel">KYC Details - <span id="kyc_user_email"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateKycForm" method="POST" action="{{ route('admin.users.update-kyc') }}">
                        @csrf
                        {{-- @method('PUT') --}}
                        <input type="hidden" name="user_id" id="kyc_user_id">
                        <input type="hidden" name="kyc_status" id="kyc_status_input">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">KYC Status</label>
                                    <div class="form-control" id="current_kyc_status"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Country</label>
                                    <div class="form-control" id="kyc_country"></div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">ID Card Number</label>
                            <div class="form-control" id="kyc_id_card_number"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="image-container">
                                    <span class="image-label">KYC Front Image</span>
                                    <img id="kyc_front_image"
                                        src="https://via.placeholder.com/400x250?text=No+Front+Image" class="kyc-image">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="image-container">
                                    <span class="image-label">KYC Back Image</span>
                                    <img id="kyc_back_image" src="https://via.placeholder.com/400x250?text=No+Back+Image"
                                        class="kyc-image">
                                </div>
                            </div>
                        </div>

                        <div class="status-buttons mt-4">
                            <button type="button" class="btn btn-success" id="verifyKycBtn">
                                <i class="bi bi-check-circle me-2"></i> Verify
                            </button>
                            <button type="button" class="btn btn-danger" id="rejectKycBtn">
                                <i class="bi bi-x-circle me-2"></i> Reject
                            </button>

                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
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

                $('#user_id').val(userId);
                $('#user_email').val(userEmail);
                $('#user_level').val(userLevel);
                // Set account status radio
                $('input[name="account_status"][value="' + userAccountStatus + '"]').prop('checked', true);
                // Show modal
                $('#updateUserModal').modal('show');
            });

            // View KYC modal
            $('.view-kyc').on('click', function(e) {
                e.preventDefault();

                var userId = $(this).data('user-id');
                var userEmail = $(this).data('user-email');
                var kycStatus = $(this).data('user-kyc-status');
                var country = $(this).data('user-country');
                var idCardNumber = $(this).data('user-id-card-number');
                var kycFrontImage = $(this).data('user-kyc-front-image');
                var kycBackImage = $(this).data('user-kyc-back-image');

                // Fill modal data
                $('#kyc_user_id').val(userId);
                $('#kyc_user_email').text(userEmail);
                $('#current_kyc_status').text(kycStatus.charAt(0).toUpperCase() + kycStatus.slice(1)
                    .replace('_', ' '));
                $('#kyc_country').text(country);
                $('#kyc_id_card_number').text(idCardNumber);

                // Setup images with better handling
                setupKycImages(kycFrontImage, kycBackImage);

                $('#viewKycModal').modal('show');
            });

            function setupKycImages(frontImage, backImage) {
                var basePath = '{{ asset('kyc') }}';

                // Front Image
                var frontImageSrc = frontImage && frontImage.trim() !== '' ?
                    basePath + '/' + frontImage :
                    'https://via.placeholder.com/400x250/ffffff/007bff?text=No+Front+Image';

                // Back Image
                var backImageSrc = backImage && backImage.trim() !== '' ?
                    basePath + '/' + backImage :
                    'https://via.placeholder.com/400x250/ffffff/dc3545?text=No+Back+Image';

                $('#kyc_front_image').attr('src', frontImageSrc);
                $('#kyc_back_image').attr('src', backImageSrc);
            }

            // KYC Status Buttons
            $('#verifyKycBtn').on('click', function() {
                $('#kyc_status_input').val('verified');
                submitKycForm();
            });

            $('#rejectKycBtn').on('click', function() {
                $('#kyc_status_input').val('rejected');
                submitKycForm();
            });

            function submitKycForm() {
                var formData = $('#updateKycForm').serialize();

                $.ajax({
                    url: '{{ route('admin.users.update-kyc') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            alert('KYC status updated successfully!');
                            $('#viewKycModal').modal('hide');
                            location.reload();
                        } else {
                            alert('Error updating KYC status: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = 'Error updating KYC status';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        alert(errorMessage);
                    }
                });
            }
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

    /* KYC Modal Styles */
    .kyc-image {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        border: 1px solid #dee2e6;
    }

    .image-container {
        position: relative;
        margin-bottom: 1rem;
    }

    .image-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        display: block;
    }

    .status-buttons {
        display: flex;
        gap: 10px;
        margin-top: 1rem;
    }

    .status-buttons .btn {
        flex: 1;
    }

    @media (max-width: 576px) {
        .status-buttons {
            flex-direction: column;
        }
    }
</style>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('.delete-user').on('click', function(e) {
            e.preventDefault();

            var userId = $(this).data('user-id');
            var $button = $(this);
            var userEmail = $(this).closest('tr').find('td:first').text();

            if (confirm('Are You Sure, You want to Delete' + userEmail + 'User')) {
                $button.prop('disabled', true).html('<i class="bi bi-trash me-2"></i> Deleting...');

                $.ajax({
                    url: '/users/del/' + userId,
                    type: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            // Success message
                            alert(response.message);
                            $button.closest('tr').fadeOut(300, function() {
                                $(this).remove();

                                // Optional: Check if table is empty
                                if ($('#usersTable tbody tr').length === 0) {
                                    $('#usersTable tbody').html(
                                        '<tr><td colspan="10" class="text-center">No users found</td></tr>'
                                    );
                                }
                            });
                        } else {
                            alert('Error: ' + response.message);
                            $button.prop('disabled', false).html(
                                '<i class="bi bi-trash me-2"></i> Delete');
                        }
                    },
                    error: function(xhr) {
                        var errorMessage = 'Error deleting user';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        alert(errorMessage);
                        $button.prop('disabled', false).html(
                            '<i class="bi bi-trash me-2"></i> Delete');
                    }
                });
            }
        });
    });
</script>
