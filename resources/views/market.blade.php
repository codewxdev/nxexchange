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
                    {{-- <input type="text" id="searchCrypto" placeholder="Search Token..."
                        style="margin-bottom:10px; padding:5px;"> --}}
                    <table class="table text-white" id="cryptoTable">
                        <thead>
                            <tr>
                                <th onclick="sortTable(0)">Token</th>
                                <th onclick="sortTable(1)">Last Price</th>
                                <th onclick="sortTable(2)">24h Change</th>
                                <th>24h High</th>
                                <th>24h Low</th>
                                <th onclick="sortTable(5)">24h Volume</th>
                            </tr>
                        </thead>
                        <tbody id="cryptoBody"></tbody>
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

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        function fetchCryptoData() {
            $.ajax({
                url: "{{ route('crypto-market') }}",
                method: 'GET',
                success: function(data) {
                    let tableBody = '';
                    data.forEach(function(coin) {
                        tableBody += `
                    <tr>
                        <td class="token-cell text-white" data-label="Token">
                            <img src="${coin.image}" width="30" /> ${coin.symbol.toUpperCase()}
                        </td>
                        <td data-label="Last Price" class="text-white">$${coin.current_price.toLocaleString()}</td>
                        <td data-label="Change" class="${coin.price_change_percentage_24h >= 0 ? 'text-success' : 'text-danger'}">
                            ${coin.price_change_percentage_24h.toFixed(2)}%
                        </td>
                        <td data-label="High" class="text-white">$${coin.high_24h.toLocaleString()}</td>
                        <td data-label="Low" class="text-white">$${coin.low_24h.toLocaleString()}</td>
                        <td data-label="Volume" class="text-white">${coin.total_volume.toLocaleString()}</td>
                    </tr>
                `;
                    });

                    // FIXED: Update the correct tbody
                    $('#cryptoBody').html(tableBody);
                },
                error: function() {
                    console.error('Failed to fetch crypto data');
                }
            });
        }

        // Initial load
        fetchCryptoData();

        // Refresh every 10 seconds
        setInterval(fetchCryptoData, 10000);
    </script>
@endpush
