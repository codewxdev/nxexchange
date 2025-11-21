@extends('Layouts.FrontLayout')

@section('content')
    <div class="asset-container py-5 px-3">
        <div class="row g-4 justify-content-center">

            <!-- ===== Total Asset Overview ===== -->
            <div class="col-12 glass-card text-center py-4">
                <h2 class="fw-bold text-white mb-1">Total Account Assets</h2>
                <p class="text-muted mb-2">All balances converted to USD</p>
                <h1 class="main-balance mb-0">$00.00</h1>
                <span class="text-secondary">≈ 0.00 USD</span>
            </div>

            <!-- ===== Quick Actions ===== -->
            <div class="col-12 col-md-10">
                <div class="row g-3 text-center justify-content-center">
                    <div class="col-6 col-md-3 action-box" data-bs-toggle="modal" data-bs-target="#depositModal">
                        <i class="fa-solid fa-download"></i>
                        <span>Deposit</span>
                    </div>
                    <div class="col-6 col-md-3 action-box" data-bs-toggle="modal" data-bs-target="#withdrawModal">
                        <i class="fa-solid fa-upload"></i>
                        <span>Withdraw</span>
                    </div>
                    <div class="col-6 col-md-3 action-box">
                        <i class="fa-solid fa-right-left"></i>
                        <span>Transfer</span>
                    </div>
                    <div class="col-6 col-md-3 action-box" data-bs-toggle="modal" data-bs-target="#addressModal">
                        <i class="fa-solid fa-link"></i>
                        <span>Address</span>
                    </div>

                </div>
            </div>

            <!-- ===== Account Breakdown ===== -->
            <div class="col-12 col-md-10 glass-card mt-4 p-4">
                <h3 class="section-title mb-3 text-white">My Accounts</h3>
                <div class="row g-4 m-0">
                    <div class="col-6 col-md-6 col-lg-6 account-box">
                        <div class="content d-flex">
                            <i class="fa-solid fa-wallet"></i>
                            <div class="heading">
                                <h5>Total Account Asset</h5>
                                <span>USDT</span>
                            </div>
                        </div>
                        <div class="usd">
                            <h4>0</h4>
                            <small>≈ USD</small>
                        </div>
                    </div>

                    <div class="col-6 col-md-6 col-lg-6 account-box">
                        <div class="content d-flex">
                            <i class="fa-solid fa-coins"></i>
                            <div class="heading">
                                <h5>Spot Account</h5>
                                <span>USDT</span>
                            </div>
                        </div>
                        <div class="usd">
                            <h4>0</h4>
                            <small>≈ USD</small>
                        </div>
                    </div> --}}

                    <div class="col-6 col-md-6 col-lg-6 account-box">
                        <div class="content d-flex">
                            <i class="fa-solid fa-file-contract"></i>
                            <div class="heading">
                                <h5>Trade Account</h5>
                                <span>USDT</span>
                            </div>
                        </div>
                        <div class="usd">
                            <h4>{{ $wallet->trade_balance }}</h4>
                            <small>≈ USD</small>
                        </div>
                    </div>

                    <div class="col-6 col-md-6 col-lg-6 account-box">
                        <div class="content d-flex">
                            <i class="fa-solid fa-chart-line"></i>
                            <div class="heading">
                                <h5>Investment Account</h5>
                                <span>USDT</span>
                            </div>
                        </div>
                        <div class="usd">
                            <h4>0</h4>
                            <small>≈ USD</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== Wallet Address Modal ===== -->
    <div class="modal fade" id="addressModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-card p-3">

                <div class="modal-header border-0">
                    <h5 class="modal-title text-white">Add Wallet Address</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('wallet.address.store') }}" method="POST">
                        @csrf

                        <label class="text-white mb-1">Wallet Address</label>
                        <input type="text" name="address" class="form-control mb-3" placeholder="Enter wallet address"
                            required>

                        <button type="submit" class="address-btn w-100">Save Address</button>
                        @endif
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- ===== Deposit Modal ===== -->
    <div class="modal fade" id="depositModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-card p-3">

                <div class="modal-header border-0">
                    <h5 class="modal-title text-white">Make a Deposit</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form action="{{ route('deposits.store') }}" method="POST">
                        @csrf

                        <label class="text-white mb-1">Amount (USD)</label>
                        <input type="number" name="amount" class="form-control mb-3" placeholder="Enter amount" required>

                        <label class="text-white mb-1">Currency</label>
                        <select name="currency" class="form-control mb-3" disabled>
                            <option value="USDT">USDT</option>
                        </select>

                        <button type="submit" class="address-btn w-100">Proceed</button>
                    </form>
                </div>

            </div>
        </div>
    </div>


    <!-- ===== Withdraw Modal ===== -->
    <div class="modal fade" id="withdrawModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content glass-card p-3">

                <div class="modal-header border-0">
                    <h5 class="modal-title text-white">Make a Withdrawal</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="withdrawForm" action="{{ route('withdraw.store') }}" method="POST">
                        @csrf

                        <label class="text-white mb-1">Amount (USD)</label>
                        <input type="number" min="20" name="amount" id="withdrawAmount"
                            class="form-control mb-3" placeholder="Minimum $20" required>

                        {{-- <label class="text-white mb-1">Withdrawal Address</label>
                        <input type="text" name="address" class="form-control mb-3"
                            placeholder="Your USDT wallet address" required> --}}

                        <label class="text-white mb-1">Fee (3%) Auto Applied</label>
                        <input type="text" class="form-control mb-3" id="withdrawFee" disabled placeholder="0.00">

                        <label class="text-white mb-1">Net Amount You Will Receive</label>
                        <input type="text" class="form-control mb-3" id="withdrawNet" disabled placeholder="0.00">

                        <button type="submit" class="address-btn w-100">Submit Withdraw Request</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection



@push('style')
    <style>
        /* ===== ASSET PAGE DESIGN ===== */
        .asset-container {
            background: radial-gradient(circle at top left, #0b0b0b, #0f1115);
            min-height: 100vh;
            color: #fff;
        }

        /* Glass Card Background */
        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            box-shadow: 0 0 30px rgba(244, 101, 35, 0.1);
        }

        /* Main Balance */
        .main-balance {
            font-size: 3rem;
            font-weight: 700;
            color: #F46523;
            text-shadow: 0 0 15px rgba(244, 101, 35, 0.3);
        }

        /* Action Buttons */
        .action-box {
            background: rgba(255, 255, 255, 0.04);
            border-radius: 15px;
            padding: 25px 8px;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-right: 10px;
        }

        .action-box:hover {
            background: rgba(244, 101, 35, 0.15);
            transform: translateY(-5px);
        }

        .action-box i {
            font-size: 1.5rem;
            color: #F46523;
            margin-bottom: 10px;
        }

        .action-box span {
            display: block;
            color: #fff;
            font-size: 0.95rem;
        }

        /* Account Boxes */
        .account-box {
            background: rgba(255, 255, 255, 0.04);
            border-radius: 15px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: 0.3s;
            width: 100% !important
                /* margin-right: 5px; */

        }

        .account-box:hover {
            background: rgba(244, 101, 35, 0.12);
            transform: translateY(-4px);
        }

        .account-box i {
            font-size: 1.8rem;
            color: #F46523;
            margin-right: 10px;
        }

        .account-box .content h5 {
            font-size: 1rem;
            margin-bottom: 4px;
            color: #fff;
        }

        .account-box .content span {
            color: #bbb;
            font-size: 0.9rem;
        }

        .account-box .usd {
            text-align: right;
        }

        .account-box .usd h4 {
            margin: 0;
            color: #fff;
            font-size: 1.3rem;
        }

        .account-box .usd small {
            color: #999;
        }

        /* Section Title */
        .section-title {
            font-size: 1.4rem;
            border-left: 4px solid #F46523;
            padding-left: 10px;
        }

        .address-btn {
            background-color: #F46523;
            border: none;
            font-weight: 500;
            color: #ffffff;
            transition: all 0.3s ease;
            font-weight: 400;
            border-radius: 10px;
            text-align: center;
            font-size: 16px;
            padding: 10px 62px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .main-balance {
                font-size: 2rem;
            }

            .account-box {
                flex-direction: column;
                text-align: center;
            }

            .account-box i {
                margin-bottom: 10px;
            }
        }
    </style>
@endpush
