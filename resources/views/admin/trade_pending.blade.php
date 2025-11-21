@extends('admin.Layouts.admin')

@section('title', 'Pending Trades Approval')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-4">Pending Trades Approval</h4>

        <div class="card shadow">
            <div class="card-header  d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Trades Waiting for Approval</h5>
                <span class="badge bg-warning">Total: {{ $pendingTrades->count() }}</span>
            </div>
            <div class="card-body">
                @if ($pendingTrades->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-responsive">
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Trade Type</th>
                                    <th>Signal</th>
                                    <th>Direction</th>
                                    <th>Stake Amount</th>
                                    <th>Time</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingTrades as $trade)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <small>{{ $trade->user->email }}</small>


                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $trade->trade_type == 'signal' ? 'info' : 'warning' }}">
                                                {{ ucfirst($trade->trade_type) }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($trade->signal)
                                                <span class="badge bg-success">{{ $trade->signal->crypto_symbol }}</span>
                                            @else
                                                <span class="badge bg-secondary">Self Trade</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $trade->direction == 'Call' ? 'success' : 'danger' }}">
                                                {{ $trade->direction }}
                                            </span>
                                        </td>
                                        <td>
                                            <strong>${{ number_format($trade->stake_amount, 2) }}</strong>
                                            <br>
                                            <small class="text-muted">USDT</small>
                                        </td>
                                        <td>
                                            <small>{{ $trade->created_at->format('M d, H:i') }}</small>
                                            <br>
                                            <small class="text-muted">{{ $trade->created_at->diffForHumans() }}</small>
                                        </td>
                                        <td>
                                            <div class="dropdown dropstart"> <!-- dropstart class add karen -->
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots-vertical"></i>
                                                </button>
                                                <ul class="dropdown-menu bg-light" style="position: fixed;">
                                                    <!-- position fixed -->
                                                    <li>
                                                        <a class="dropdown-item text-success" href="#"
                                                            onclick="showApproveModal({{ $trade->id }}, 'win')">
                                                            <i class="bi bi-check-circle me-2"></i> Confirm Win
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item text-danger" href="#"
                                                            onclick="showApproveModal({{ $trade->id }}, 'lose')">
                                                            <i class="bi bi-x-circle me-2"></i> Confirm Loss
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="bi bi-check-circle display-1 text-success"></i>
                        <h4 class="mt-3">No Pending Trades</h4>
                        <p class="text-muted">All trades have been processed.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Approval Modal -->
    <div class="modal fade" id="approvalModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Confirm Trade Result</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="approvalForm">
                        @csrf
                        <input type="hidden" name="trade_id" id="tradeId">
                        <input type="hidden" name="result" id="tradeResult">

                        <div class="mb-3">
                            <label class="form-label">Select Profit Rate (%)</label>
                            <select class="form-select" name="profit_rate" id="profitRate" required>
                                <option value="70">70%</option>
                                <option value="71">71%</option>
                                <option value="72">72%</option>
                                <option value="73">73%</option>
                                <option value="74">74%</option>
                                <option value="75">75%</option>
                                <option value="76">76%</option>
                                <option value="77">77%</option>
                                <option value="78">78%</option>
                                <option value="79">79%</option>
                                <option value="80">80%</option>
                                <option value="81">81%</option>
                                <option value="82">82%</option>
                                <option value="83">83%</option>
                                <option value="84">84%</option>
                                <option value="85">85%</option>
                            </select>
                            <small class="text-muted">Profit rate between 70% to 85%</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Stake Amount</label>
                            <input type="text" class="form-control" id="stakeAmountDisplay" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Profit Amount (Calculated)</label>
                            <input type="text" class="form-control" id="profitAmountDisplay" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total Return (If Win)</label>
                            <input type="text" class="form-control" id="totalReturnDisplay" readonly>
                        </div>

                        <div class="alert alert-info">
                            <h6><i class="bi bi-info-circle"></i> Trade Details:</h6>
                            <div id="tradeDetails"></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="submitApproval()">Confirm Result</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        // Global variables
        let currentTradeId = null;
        let currentTradeStake = 0;

        // Show approval modal
        function showApproveModal(tradeId, result) {
            currentTradeId = tradeId;

            // Get trade details via AJAX or use data attributes
            $.get('/admin/trades/' + tradeId + '/details', function(trade) {
                currentTradeStake = parseFloat(trade.stake_amount);

                // Set modal title
                $('#modalTitle').text('Confirm Trade as ' + result.toUpperCase());

                // Set form values
                $('#tradeId').val(tradeId);
                $('#tradeResult').val(result);
                $('#stakeAmountDisplay').val('$' + currentTradeStake.toFixed(2));

                // Set trade details
                $('#tradeDetails').html(`
            <strong>User:</strong> ${trade.user.email}<br>
            <strong>Type:</strong> ${trade.trade_type}<br>
            <strong>Direction:</strong> ${trade.direction}<br>
            <strong>Crypto:</strong> ${trade.crypto_symbol}<br>
            <strong>Time:</strong> ${trade.created_at}
        `);

                // Calculate initial profit
                calculateProfit(70);

                // Show modal
                $('#approvalModal').modal('show');
            }).fail(function() {
                alert('Error loading trade details');
            });
        }

        // Calculate profit based on selected rate
        function calculateProfit(rate) {
            const profitAmount = (currentTradeStake * rate) / 100;
            const totalReturn = currentTradeStake + profitAmount;

            $('#profitAmountDisplay').val('$' + profitAmount.toFixed(2));
            $('#totalReturnDisplay').val('$' + totalReturn.toFixed(2));
        }

        // Profit rate change event
        $('#profitRate').on('change', function() {
            const rate = parseFloat($(this).val());
            calculateProfit(rate);
        });

        // Submit approval
        function submitApproval() {
            const formData = {
                trade_id: $('#tradeId').val(),
                result: $('#tradeResult').val(),
                profit_rate: $('#profitRate').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '/admin/trades/approve',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Trade Approved!',
                            text: response.message,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            $('#approvalModal').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'Approval failed'
                    });
                }
            });
        }
    </script>

    {{-- <style>
        .dropdown-toggle {
            padding: 4px 12px;
            font-size: 12px;
        }

        .dropdown-menu {
            min-width: 180px;
            font-size: 13px;
            background-color: #f8f9fa;
        }

        .dropdown-item {
            padding: 6px 12px;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .dropdown-item.text-success:hover {
            background-color: #d1e7dd;
        }

        .dropdown-item.text-danger:hover {
            background-color: #f8d7da;
        }

        .dropdown-divider {
            margin: 4px 0;
        }

        .table th {
            font-weight: 600;
            font-size: 14px;
        }

        .badge {
            font-size: 0.75rem;
        }

        .btn-group .btn {
            margin: 1px;
            font-size: 12px;
        }
    </style> --}}
@endsection
