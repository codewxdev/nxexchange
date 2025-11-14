@extends('Layouts.FrontLayout')

@section('content')
    <div class="market-page">
        <div class="container">

            <div class="market-header">
                <h2>Live Cryptocurrency Market</h2>
                <p>Track real-time prices, changes and volume updates</p>
            </div>

            <div class="market-table-wrapper">
                <div class="table-responsive">
                    <table class="table crypto-table mb-0">
                        <thead>
                            <tr>
                                <th>Token</th>
                                <th>Last Price</th>
                                <th>24h Change</th>
                                <th>24h High</th>
                                <th>24h Low</th>
                                <th>24h Volume</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/bitcoin.png') }}" alt=""> BTC
                                </td>
                                <td data-label="Last Price">$103,423.88</td>
                                <td data-label="Change" class="text-danger">-0.04%</td>
                                <td data-label="High">$103,741.96</td>
                                <td data-label="Low">$102,488.34</td>
                                <td data-label="Volume">87.66M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/authen.png') }}" alt=""> ETH
                                </td>
                                <td data-label="Last Price">$3,240.50</td>
                                <td data-label="Change" class="text-success">+1.26%</td>
                                <td data-label="High">$3,310.00</td>
                                <td data-label="Low">$3,180.24</td>
                                <td data-label="Volume">43.21M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" alt=""> USDT
                                </td>
                                <td data-label="Last Price">$1.00</td>
                                <td data-label="Change" class="text-muted">0.00%</td>
                                <td data-label="High">$1.01</td>
                                <td data-label="Low">$0.99</td>
                                <td data-label="Volume">102.12M</td>
                            </tr>
 <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/bitcoin.png') }}" alt=""> BTC
                                </td>
                                <td data-label="Last Price">$103,423.88</td>
                                <td data-label="Change" class="text-danger">-0.04%</td>
                                <td data-label="High">$103,741.96</td>
                                <td data-label="Low">$102,488.34</td>
                                <td data-label="Volume">87.66M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/authen.png') }}" alt=""> ETH
                                </td>
                                <td data-label="Last Price">$3,240.50</td>
                                <td data-label="Change" class="text-success">+1.26%</td>
                                <td data-label="High">$3,310.00</td>
                                <td data-label="Low">$3,180.24</td>
                                <td data-label="Volume">43.21M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" alt=""> USDT
                                </td>
                                <td data-label="Last Price">$1.00</td>
                                <td data-label="Change" class="text-muted">0.00%</td>
                                <td data-label="High">$1.01</td>
                                <td data-label="Low">$0.99</td>
                                <td data-label="Volume">102.12M</td>
                            </tr> <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/bitcoin.png') }}" alt=""> BTC
                                </td>
                                <td data-label="Last Price">$103,423.88</td>
                                <td data-label="Change" class="text-danger">-0.04%</td>
                                <td data-label="High">$103,741.96</td>
                                <td data-label="Low">$102,488.34</td>
                                <td data-label="Volume">87.66M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/authen.png') }}" alt=""> ETH
                                </td>
                                <td data-label="Last Price">$3,240.50</td>
                                <td data-label="Change" class="text-success">+1.26%</td>
                                <td data-label="High">$3,310.00</td>
                                <td data-label="Low">$3,180.24</td>
                                <td data-label="Volume">43.21M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" alt=""> USDT
                                </td>
                                <td data-label="Last Price">$1.00</td>
                                <td data-label="Change" class="text-muted">0.00%</td>
                                <td data-label="High">$1.01</td>
                                <td data-label="Low">$0.99</td>
                                <td data-label="Volume">102.12M</td>
                            </tr> <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/bitcoin.png') }}" alt=""> BTC
                                </td>
                                <td data-label="Last Price">$103,423.88</td>
                                <td data-label="Change" class="text-danger">-0.04%</td>
                                <td data-label="High">$103,741.96</td>
                                <td data-label="Low">$102,488.34</td>
                                <td data-label="Volume">87.66M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/authen.png') }}" alt=""> ETH
                                </td>
                                <td data-label="Last Price">$3,240.50</td>
                                <td data-label="Change" class="text-success">+1.26%</td>
                                <td data-label="High">$3,310.00</td>
                                <td data-label="Low">$3,180.24</td>
                                <td data-label="Volume">43.21M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" alt=""> USDT
                                </td>
                                <td data-label="Last Price">$1.00</td>
                                <td data-label="Change" class="text-muted">0.00%</td>
                                <td data-label="High">$1.01</td>
                                <td data-label="Low">$0.99</td>
                                <td data-label="Volume">102.12M</td>
                            </tr> <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/bitcoin.png') }}" alt=""> BTC
                                </td>
                                <td data-label="Last Price">$103,423.88</td>
                                <td data-label="Change" class="text-danger">-0.04%</td>
                                <td data-label="High">$103,741.96</td>
                                <td data-label="Low">$102,488.34</td>
                                <td data-label="Volume">87.66M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/authen.png') }}" alt=""> ETH
                                </td>
                                <td data-label="Last Price">$3,240.50</td>
                                <td data-label="Change" class="text-success">+1.26%</td>
                                <td data-label="High">$3,310.00</td>
                                <td data-label="Low">$3,180.24</td>
                                <td data-label="Volume">43.21M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" alt=""> USDT
                                </td>
                                <td data-label="Last Price">$1.00</td>
                                <td data-label="Change" class="text-muted">0.00%</td>
                                <td data-label="High">$1.01</td>
                                <td data-label="Low">$0.99</td>
                                <td data-label="Volume">102.12M</td>
                            </tr> <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/bitcoin.png') }}" alt=""> BTC
                                </td>
                                <td data-label="Last Price">$103,423.88</td>
                                <td data-label="Change" class="text-danger">-0.04%</td>
                                <td data-label="High">$103,741.96</td>
                                <td data-label="Low">$102,488.34</td>
                                <td data-label="Volume">87.66M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/authen.png') }}" alt=""> ETH
                                </td>
                                <td data-label="Last Price">$3,240.50</td>
                                <td data-label="Change" class="text-success">+1.26%</td>
                                <td data-label="High">$3,310.00</td>
                                <td data-label="Low">$3,180.24</td>
                                <td data-label="Volume">43.21M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" alt=""> USDT
                                </td>
                                <td data-label="Last Price">$1.00</td>
                                <td data-label="Change" class="text-muted">0.00%</td>
                                <td data-label="High">$1.01</td>
                                <td data-label="Low">$0.99</td>
                                <td data-label="Volume">102.12M</td>
                            </tr> <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/bitcoin.png') }}" alt=""> BTC
                                </td>
                                <td data-label="Last Price">$103,423.88</td>
                                <td data-label="Change" class="text-danger">-0.04%</td>
                                <td data-label="High">$103,741.96</td>
                                <td data-label="Low">$102,488.34</td>
                                <td data-label="Volume">87.66M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/authen.png') }}" alt=""> ETH
                                </td>
                                <td data-label="Last Price">$3,240.50</td>
                                <td data-label="Change" class="text-success">+1.26%</td>
                                <td data-label="High">$3,310.00</td>
                                <td data-label="Low">$3,180.24</td>
                                <td data-label="Volume">43.21M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" alt=""> USDT
                                </td>
                                <td data-label="Last Price">$1.00</td>
                                <td data-label="Change" class="text-muted">0.00%</td>
                                <td data-label="High">$1.01</td>
                                <td data-label="Low">$0.99</td>
                                <td data-label="Volume">102.12M</td>
                            </tr> <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/bitcoin.png') }}" alt=""> BTC
                                </td>
                                <td data-label="Last Price">$103,423.88</td>
                                <td data-label="Change" class="text-danger">-0.04%</td>
                                <td data-label="High">$103,741.96</td>
                                <td data-label="Low">$102,488.34</td>
                                <td data-label="Volume">87.66M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/authen.png') }}" alt=""> ETH
                                </td>
                                <td data-label="Last Price">$3,240.50</td>
                                <td data-label="Change" class="text-success">+1.26%</td>
                                <td data-label="High">$3,310.00</td>
                                <td data-label="Low">$3,180.24</td>
                                <td data-label="Volume">43.21M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" alt=""> USDT
                                </td>
                                <td data-label="Last Price">$1.00</td>
                                <td data-label="Change" class="text-muted">0.00%</td>
                                <td data-label="High">$1.01</td>
                                <td data-label="Low">$0.99</td>
                                <td data-label="Volume">102.12M</td>
                            </tr> <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/bitcoin.png') }}" alt=""> BTC
                                </td>
                                <td data-label="Last Price">$103,423.88</td>
                                <td data-label="Change" class="text-danger">-0.04%</td>
                                <td data-label="High">$103,741.96</td>
                                <td data-label="Low">$102,488.34</td>
                                <td data-label="Volume">87.66M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/authen.png') }}" alt=""> ETH
                                </td>
                                <td data-label="Last Price">$3,240.50</td>
                                <td data-label="Change" class="text-success">+1.26%</td>
                                <td data-label="High">$3,310.00</td>
                                <td data-label="Low">$3,180.24</td>
                                <td data-label="Volume">43.21M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" alt=""> USDT
                                </td>
                                <td data-label="Last Price">$1.00</td>
                                <td data-label="Change" class="text-muted">0.00%</td>
                                <td data-label="High">$1.01</td>
                                <td data-label="Low">$0.99</td>
                                <td data-label="Volume">102.12M</td>
                            </tr> <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/bitcoin.png') }}" alt=""> BTC
                                </td>
                                <td data-label="Last Price">$103,423.88</td>
                                <td data-label="Change" class="text-danger">-0.04%</td>
                                <td data-label="High">$103,741.96</td>
                                <td data-label="Low">$102,488.34</td>
                                <td data-label="Volume">87.66M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/authen.png') }}" alt=""> ETH
                                </td>
                                <td data-label="Last Price">$3,240.50</td>
                                <td data-label="Change" class="text-success">+1.26%</td>
                                <td data-label="High">$3,310.00</td>
                                <td data-label="Low">$3,180.24</td>
                                <td data-label="Volume">43.21M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" alt=""> USDT
                                </td>
                                <td data-label="Last Price">$1.00</td>
                                <td data-label="Change" class="text-muted">0.00%</td>
                                <td data-label="High">$1.01</td>
                                <td data-label="Low">$0.99</td>
                                <td data-label="Volume">102.12M</td>
                            </tr> <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/bitcoin.png') }}" alt=""> BTC
                                </td>
                                <td data-label="Last Price">$103,423.88</td>
                                <td data-label="Change" class="text-danger">-0.04%</td>
                                <td data-label="High">$103,741.96</td>
                                <td data-label="Low">$102,488.34</td>
                                <td data-label="Volume">87.66M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="{{ asset('assets/images/authen.png') }}" alt=""> ETH
                                </td>
                                <td data-label="Last Price">$3,240.50</td>
                                <td data-label="Change" class="text-success">+1.26%</td>
                                <td data-label="High">$3,310.00</td>
                                <td data-label="Low">$3,180.24</td>
                                <td data-label="Volume">43.21M</td>
                            </tr>

                            <tr>
                                <td class="token-cell" data-label="Token">
                                    <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" alt=""> USDT
                                </td>
                                <td data-label="Last Price">$1.00</td>
                                <td data-label="Change" class="text-muted">0.00%</td>
                                <td data-label="High">$1.01</td>
                                <td data-label="Low">$0.99</td>
                                <td data-label="Volume">102.12M</td>
                            </tr>
                            {{-- Add more tokens here --}}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('style')
    <style>
        .market-page {
            padding: 60px 0;
            background: linear-gradient(135deg, #020202, #0a0f1a);
            min-height: 100vh;
        }

        .market-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .market-header h2 {
            font-size: 34px;
            font-weight: 700;
            color: #fff;
        }

        .market-header p {
            color: #b4b4b4;
            font-size: 16px;
        }

        .market-table-wrapper {
            backdrop-filter: blur(14px);
            background: rgba(255, 255, 255, 0.06);
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .crypto-table thead {
            background: rgba(255, 255, 255, 0.08) !important;
            color: #fff !important;
        }

        .crypto-table thead th {
            padding: 16px;
            font-size: 14px;
            text-transform: uppercase;
            font-weight: 600;
            border: none;
        }

        .crypto-table tbody tr {
            transition: 0.25s ease;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .crypto-table tbody tr:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-2px);
        }

        .crypto-table td {
            padding: 14px;
            color: #eaeaea;
            font-size: 15px;
            vertical-align: middle;
            border: none;
        }

        .token-cell img {
            width: 30px;
            margin-right: 8px;
        }

        /* Responsive Fix */
        @media (max-width: 768px) {
            .crypto-table thead {
                display: none;
            }

            .crypto-table tbody tr {
                display: block;
                margin-bottom: 18px;
                background: rgba(255, 255, 255, 0.06);
                border-radius: 12px;
                padding: 12px;
            }

            .crypto-table tbody td {
                display: flex;
                justify-content: space-between;
                padding: 8px 5px;
                font-size: 14px;
            }

            .crypto-table tbody td:before {
                content: attr(data-label);
                font-weight: 600;
                color: #fff;
            }
        }
    </style>
@endpush
