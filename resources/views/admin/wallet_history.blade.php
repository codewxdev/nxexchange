@extends('admin.Layouts.admin')

@section('title', 'Wallet Mangement')

@section('content')
    <div class="container-fluid">
        <h2 class="mb-4">Wallet Transaction</h2>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Wallet Transaction</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped" id="activityTable">
                        <thead>
                            <tr>
                                <th>User Id</th>
                                <th>Type</th>
                                <th>From Wallet</th>
                                <th>To Wallet</th>
                                <th>Amount</th>
                                <th>Fee</th>
                                <th>Status</th>
                                <th>Remark</th>
                                <th>Admin</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($wallets as $wallet)
                                <tr>
                                    <td>{{ $wallet->user->id ?? 'N/A' }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $wallet->type == 'deposit' ? 'success' : ($wallet->type == 'withdraw' ? 'danger' : 'info') }}">
                                            {{ $wallet->type }}
                                        </span>
                                    </td>
                                    <td>{{ $wallet->from_wallet ?? 'N/A' }}</td>
                                    <td>{{ $wallet->to_wallet ?? 'N/A' }}</td>
                                    <td>${{ number_format($wallet->amount, 2) }}</td>
                                    <td>${{ number_format($wallet->fee, 2) }}</td>
                                    <td>
                                        <span
                                            class="badge bg-{{ $wallet->status == 'completed' ? 'success' : ($wallet->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ $wallet->status }}
                                        </span>
                                    </td>
                                    <td>{{ $wallet->remark ?? 'N/A' }}</td>
                                    <td>{{ $wallet->user->name ?? 'N/A' }}</td>
                                    <td>
                                        <!-- Action Dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item text-primary" href="#"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#updateModal{{ $wallet->id }}">
                                                        <i class="bi bi-pencil-square me-2"></i> Update
                                                    </a>
                                                </li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li>
                                                    <a class="dropdown-item text-danger" href="#"
                                                        onclick="confirmDelete({{ $wallet->id }})">
                                                        <i class="bi bi-trash me-2"></i> Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Update Modal -->
                                        <div class="modal fade" id="updateModal{{ $wallet->id }}" tabindex="-1"
                                            aria-labelledby="updateModalLabel{{ $wallet->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="{{ route('wallet.transaction.update', $wallet->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="updateModalLabel{{ $wallet->id }}">
                                                                Update Transaction
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="type{{ $wallet->id }}"
                                                                    class="form-label">Transaction Type</label>
                                                                <select class="form-select" id="type{{ $wallet->id }}"
                                                                    name="type" required>
                                                                    <option value="deposit"
                                                                        {{ $wallet->type == 'deposit' ? 'selected' : '' }}>
                                                                        Deposit</option>
                                                                    <option value="withdraw"
                                                                        {{ $wallet->type == 'withdraw' ? 'selected' : '' }}>
                                                                        Withdraw</option>
                                                                    <option value="transfer"
                                                                        {{ $wallet->type == 'transfer' ? 'selected' : '' }}>
                                                                        Transfer</option>
                                                                    <option value="bonus"
                                                                        {{ $wallet->type == 'bonus' ? 'selected' : '' }}>
                                                                        Bonus</option>
                                                                    <option value="deduction"
                                                                        {{ $wallet->type == 'deduction' ? 'selected' : '' }}>
                                                                        Deduction</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="amount{{ $wallet->id }}"
                                                                    class="form-label">Amount</label>
                                                                <input type="number" step="0.01" class="form-control"
                                                                    id="amount{{ $wallet->id }}" name="amount"
                                                                    value="{{ $wallet->amount }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="status{{ $wallet->id }}"
                                                                    class="form-label">Status</label>
                                                                <select class="form-select" id="status{{ $wallet->id }}"
                                                                    name="status" required>
                                                                    <option value="pending"
                                                                        {{ $wallet->status == 'pending' ? 'selected' : '' }}>
                                                                        Pending</option>
                                                                    <option value="completed"
                                                                        {{ $wallet->status == 'completed' ? 'selected' : '' }}>
                                                                        Completed</option>
                                                                    <option value="failed"
                                                                        {{ $wallet->status == 'failed' ? 'selected' : '' }}>
                                                                        Failed</option>
                                                                    <option value="cancelled"
                                                                        {{ $wallet->status == 'cancelled' ? 'selected' : '' }}>
                                                                        Cancelled</option>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="remark{{ $wallet->id }}"
                                                                    class="form-label">Remark</label>
                                                                <textarea class="form-control" id="remark{{ $wallet->id }}" name="remark" rows="3">{{ $wallet->remark }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Update
                                                                Transaction</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="11" class="text-center">No transactions found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function confirmDelete(walletId) {
        if (confirm('Are you sure you want to delete this transaction?')) {
            window.location.href = "{{ url('wallet/transaction/delete') }}/" + walletId;
        }
    }
</script>
<style>
    .dropdown-toggle::after {
        display: none;
    }

    .action-dropdown {
        min-width: 120px;
    }

    .badge {
        font-size: 0.75em;
    }
</style>
