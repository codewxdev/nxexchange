@extends('Layouts.FrontLayout')

@section('content')
    <div class="main-container">
        <div class="row m-0">

            <!-- ===== Left Column: Market List ===== -->
            <div class="col-lg-3 col-md-4 market-sidebar">
                <div class="selected-coin">
                    <img src="{{ asset('assets/images/bitcoin.png') }}" alt="" width="40px" height="40px">
                    <span>BTC</span>
                </div>
                <h3 class="market-title">Markets</h3>
                <div class="market-list">

                    <div class="market-item active">
                        <img src="{{ asset('assets/images/bitcoin.png') }}" alt="BTC" />
                        <div class="info">
                            <h5>BTC / USDT</h5>
                            <p>$102,808.63 <span class="change positive">+0.63%</span></p>
                        </div>
                    </div>

                    <div class="market-item">
                        <img src="{{ asset('assets/images/usdc.png') }}" alt="USDC" />
                        <div class="info">
                            <h5>USDC / USDT</h5>
                            <p>$0.9999 <span class="change positive">+0.00%</span></p>
                        </div>
                    </div>

                    <div class="market-item">
                        <img src="{{ asset('assets/images/ethereum.png') }}" alt="ETH" />
                        <div class="info">
                            <h5>ETH / USDT</h5>
                            <p>$3,245.25 <span class="change negative">-1.12%</span></p>
                        </div>
                    </div>

                    <div class="market-item">
                        <img src="{{ asset('assets/images/xrp.png') }}" alt="XRP" />
                        <div class="info">
                            <h5>XRP / USDT</h5>
                            <p>$0.532 <span class="change positive">+0.45%</span></p>
                        </div>
                    </div>

                    <div class="market-item">
                        <img src="{{ asset('assets/images/solana.png') }}" alt="SOL" />
                        <div class="info">
                            <h5>SOL / USDT</h5>
                            <p>$179.52 <span class="change positive">+2.31%</span></p>
                        </div>
                    </div>

                    <div class="market-item">
                        <img src="{{ asset('assets/images/ada.png') }}" alt="ADA" />
                        <div class="info">
                            <h5>ADA / USDT</h5>
                            <p>$0.625 <span class="change negative">-0.55%</span></p>
                        </div>
                    </div>

                    <div class="market-item">
                        <img src="{{ asset('assets/images/doge.png') }}" alt="DOGE" />
                        <div class="info">
                            <h5>DOGE / USDT</h5>
                            <p>$0.155 <span class="change positive">+0.24%</span></p>
                        </div>
                    </div>

                    <div class="market-item">
                        <img src="{{ asset('assets/images/dot.png') }}" alt="DOT" />
                        <div class="info">
                            <h5>DOT / USDT</h5>
                            <p>$6.98 <span class="change positive">+0.17%</span></p>
                        </div>
                    </div>

                    <div class="market-item">
                        <img src="{{ asset('assets/images/ltc.png') }}" alt="LTC" />
                        <div class="info">
                            <h5>LTC / USDT</h5>
                            <p>$81.42 <span class="change negative">-0.21%</span></p>
                        </div>
                    </div>

                    <div class="market-item">
                        <img src="{{ asset('assets/images/avax.png') }}" alt="AVAX" />
                        <div class="info">
                            <h5>AVAX / USDT</h5>
                            <p>$38.56 <span class="change positive">+1.04%</span></p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ===== Right Column (Graph / Trading Area) ===== -->
            <div class="col-lg-9 col-md-8 trade-graph-area">
                <!-- ===== Top Stats ===== -->
                <div class="trade-stats d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <div class="stat-box">
                        <span>Last Price</span>
                        <h2>$103,093.78 <small class="text-success">+0.84%</small></h2>
                    </div>
                    <div class="stat-box">
                        <span>24h High</span>
                        <h2>$104,500.21</h2>
                    </div>
                    <div class="stat-box">
                        <span>24h Low</span>
                        <h2>$100,200.54</h2>
                    </div>
                    <div class="stat-box">
                        <span>Volume (BTC)</span>
                        <h2>15,239.21</h2>
                    </div>
                </div>

                <!-- ===== Time Interval Buttons ===== -->
                <div class="time-intervals d-flex flex-wrap gap-2 mb-4">
                    <button class="interval-btn active">60S</button>
                    <button class="interval-btn">120S</button>
                    <button class="interval-btn">5M</button>
                    <button class="interval-btn">10M</button>
                    <button class="interval-btn">1H</button>
                    <button class="interval-btn">24H</button>
                </div>

                <!-- ===== Live Info Row ===== -->
                <div class="info-row d-flex flex-wrap justify-content-between mb-4">
                    <div>
                        <span>Out order (GMT-6)</span>
                        <h6>2025/11/13 04:16:00</h6>
                    </div>
                    <div>
                        <span>Countdown</span>
                        <h6 class="text-warning">5s</h6>
                    </div>
                    <div>
                        <span>Time Period</span>
                        <h6>04:16 ~ 04:17</h6>
                    </div>
                </div>

                <!-- ===== Mini Stats Row ===== -->
                <div class="mini-stats d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div>Time: 2025-11-29 04:24</div>
                    <div>Open: 103,463</div>
                    <div>High: 104,335.00</div>
                    <div>Low: 108,3838</div>
                    <div>Close: 105,228</div>
                    <div>Volume: 105,228</div>
                </div>

                <!-- ===== Chart Container ===== -->
                <div class="chart-container p-3 rounded">
                    <div id="chart" style="height: 420px; width: 100%;"></div>
                </div>


                <!-- ===== Order List (Buy / Sell Panels) ===== -->
                <div class="order-section mt-5">
                    <div class="row gx-4 gy-4">
                        <!-- ===== BUY SECTION ===== -->
                        <div class="col-md-6 buy-card">
                            <h4 class="title">Buy BTC</h4>
                            <div class="signals mb-3">
                                <select class="form-select">
                                    <option>Signal One</option>
                                    <option>Signal Two</option>
                                    <option>Signal Three</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="Enter amount to buy">
                            </div>

                            <div class="percentages d-flex justify-content-between mb-3">
                                <button>1%</button>
                                <button>3%</button>
                                <button>7%</button>
                                <button>25%</button>
                            </div>

                            <div class="mini-info d-flex justify-content-between">
                                <span>Minimum: <b>0.00</b></span>
                                <span>Available: <b>0.00 USDT</b></span>
                            </div>

                            <button class="action-btn buy">Buy Now</button>
                        </div>

                        <!-- ===== SELL SECTION ===== -->
                        <div class="col-md-6 sell-card">
                            <h4 class="title">Sell BTC</h4>
                            <div class="signals mb-3">
                                <select class="form-select">
                                    <option>Signal One</option>
                                    <option>Signal Two</option>
                                    <option>Signal Three</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <input type="number" class="form-control" placeholder="Enter amount to sell">
                            </div>

                            <div class="percentages d-flex justify-content-between mb-3">
                                <button>1%</button>
                                <button>3%</button>
                                <button>7%</button>
                                <button>25%</button>
                            </div>

                            <div class="mini-info d-flex justify-content-between">
                                <span>Minimum: <b>0.00</b></span>
                                <span>Available: <b>0.00 BTC</b></span>
                            </div>

                            <button class="action-btn sell">Sell Now</button>
                        </div>
                    </div>
                </div>

                <!-- ===== Order History Tabs ===== -->
                <div class="order-history mt-5">
                    <div class="tabs d-flex justify-content-around mb-3">
                        <button class="tab active">Plan Order</button>
                        <button class="tab">Delivery Order</button>
                        <button class="tab">Historical Order</button>
                        <button class="tab">Copy Trading</button>
                    </div>
                    <div class="no-more text-center py-4">
                        <i class="fa-regular fa-box-open fa-2x mb-2 text-secondary"></i>
                        <p>No More Data</p>
                    </div>
                </div>

            </div>



        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Generate random trading data (profits & losses)
        function generateData(count) {
            const series = [];
            let base = 100;
            for (let i = 0; i < count; i++) {
                const open = base + (Math.random() * 10 - 5);
                const close = open + (Math.random() * 10 - 5);
                const high = Math.max(open, close) + Math.random() * 5;
                const low = Math.min(open, close) - Math.random() * 5;
                base = close;
                series.push({
                    x: new Date(2025, 8, i + 1),
                    y: [open.toFixed(2), high.toFixed(2), low.toFixed(2), close.toFixed(2)]
                });
            }
            return series;
        }

        const options = {
            chart: {
                type: 'candlestick',
                height: 500,
                background: '#0f172a',
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                        selection: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: true
                    }
                }
            },
            title: {
                text: 'NXExchange Market Trend',
                align: 'left',
                style: {
                    color: '#fff'
                }
            },
            series: [{
                data: generateData(60) // 60 candles (2 months of data)
            }],
            xaxis: {
                type: 'datetime',
                labels: {
                    style: {
                        colors: '#ccc'
                    }
                }
            },
            yaxis: {
                tooltip: {
                    enabled: true
                },
                labels: {
                    style: {
                        colors: '#ccc'
                    }
                }
            },
            grid: {
                borderColor: '#334155'
            },
            tooltip: {
                theme: 'dark'
            },
            plotOptions: {
                candlestick: {
                    colors: {
                        upward: '#22c55e', // profit (green)
                        downward: '#ef4444' // loss (red)
                    },
                    wick: {
                        useFillColor: true
                    }
                }
            }
        };

        const chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    </script>
@endpush

@push('style')
    <style>
        /* ===== Market Sidebar ===== */
        .market-sidebar {
            background: rgba(15, 15, 15, 0.9);
            backdrop-filter: blur(12px);
            padding: 20px;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            min-height: 100vh;
            color: #fff;
        }

        .market-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 15px;
            color: #F46523;
            text-align: center;
            letter-spacing: 1px;
        }

        .market-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            max-height: 85vh;
            overflow-y: auto;
            scrollbar-width: thin;
        }

        .market-list::-webkit-scrollbar {
            width: 6px;
        }

        .market-list::-webkit-scrollbar-thumb {
            background: #F46523;
            border-radius: 4px;
        }

        .market-item {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            padding: 10px 15px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .market-item:hover,
        .market-item.active {
            background: rgba(244, 101, 35, 0.15);
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(244, 101, 35, 0.25);
        }

        .market-item img {
            width: 35px;
            height: 35px;
            margin-right: 10px;
        }

        .market-item .info h5 {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
        }

        .market-item .info p {
            font-size: 0.85rem;
            margin: 0;
            color: #bbb;
        }

        .market-item .info .change {
            font-weight: 600;
            margin-left: 6px;
        }

        .change.positive {
            color: #18c964;
        }

        .change.negative {
            color: #e04f4f;
        }

        /* ===== Right Column (Placeholder) ===== */
        .trade-graph-area {
            background: #0f0f0f;
            color: #fff;
            padding: 40px;
            min-height: 100vh;
        }

        @media (max-width: 992px) {
            .market-sidebar {
                min-height: auto;
            }

            .trade-graph-area {
                min-height: auto;
                padding: 20px;
            }
        }

        .trade-graph-area {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 15px;
            padding: 30px;
            color: #fff;
            backdrop-filter: blur(15px);
            box-shadow: 0 0 25px rgba(244, 101, 35, 0.1);
        }

        /* Top Stat Boxes */
        .trade-stats .stat-box {
            flex: 1;
            min-width: 160px;
            background: rgba(255, 255, 255, 0.06);
            border-radius: 12px;
            padding: 15px 20px;
            text-align: center;
            transition: 0.3s ease;
        }

        .trade-stats .stat-box:hover {
            background: rgba(244, 101, 35, 0.15);
            transform: translateY(-3px);
        }

        .trade-stats span {
            font-size: 0.9rem;
            color: #aaa;
        }

        .trade-stats h2 {
            font-size: 1.4rem;
            margin: 6px 0 0;
        }

        /* Time Interval Buttons */
        .interval-btn {
            background: rgba(255, 255, 255, 0.07);
            color: #fff;
            border: none;
            padding: 8px 18px;
            border-radius: 8px;
            transition: 0.3s ease;
            font-weight: 500;
        }

        .interval-btn:hover,
        .interval-btn.active {
            background: #F46523;
            transform: scale(1.05);
        }

        /* Info and Mini Stats */
        .info-row span {
            display: block;
            color: #aaa;
            font-size: 0.85rem;
        }

        .info-row h6 {
            margin: 4px 0 0;
            font-size: 0.95rem;
        }

        .mini-stats {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 0.9rem;
            color: #ccc;
        }

        /* Chart Container */
        .chart-container {
            background: rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            overflow: hidden;
        }


        /* ===== Order Section (Buy/Sell) ===== */
        .order-section {
            display: flex;
            flex-direction: column;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 15px;
            padding: 25px;
            backdrop-filter: blur(15px);
            box-shadow: 0 0 25px rgba(244, 101, 35, 0.1);
        }

        .buy-card,
        .sell-card {
            background: rgba(255, 255, 255, 0.04);
            border-radius: 15px;
            padding: 20px;
            transition: 0.3s ease;
        }

        .buy-card:hover,
        .sell-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.08);
        }

        .buy-card .title,
        .sell-card .title {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: #fff;
            border-left: 4px solid #F46523;
            padding-left: 10px;
        }

        .signals select {
            background: rgba(255, 255, 255, 0.08);
            border: none;
            color: #fff;
            border-radius: 10px;
            padding: 8px 12px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.08);
            border: none;
            color: #fff;
            padding: 10px 12px;
            border-radius: 10px;
        }

        .form-control::placeholder {
            color: #999;
        }

        .percentages button {
            background: rgba(255, 255, 255, 0.05);
            border: none;
            color: #fff;
            padding: 6px 15px;
            border-radius: 8px;
            font-size: 0.9rem;
            transition: 0.3s;
        }

        .percentages button:hover {
            background: #F46523;
            transform: scale(1.05);
        }

        .mini-info {
            color: #bbb;
            font-size: 0.9rem;
        }

        .action-btn {
            width: 100%;
            padding: 10px 0;
            font-weight: bold;
            border-radius: 10px;
            border: none;
            margin-top: 15px;
            font-size: 1rem;
            transition: 0.3s ease;
        }

        .action-btn.buy {
            background: #1b8a3a;
            color: #fff;
        }

        .action-btn.buy:hover {
            background: #27ae60;
        }

        .action-btn.sell {
            background: #c0392b;
            color: #fff;
        }

        .action-btn.sell:hover {
            background: #e74c3c;
        }

        /* ===== History Tabs ===== */
        .order-history {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 15px;
            padding: 20px;
            margin-top: 25px;
        }

        .order-history .tabs button {
            background: transparent;
            border: none;
            color: #aaa;
            padding: 10px 15px;
            font-size: 0.95rem;
            transition: 0.3s ease;
        }

        .order-history .tabs button.active,
        .order-history .tabs button:hover {
            color: #F46523;
            border-bottom: 2px solid #F46523;
        }

        .no-more {
            color: #777;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .market-sidebar {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            }
        }
    </style>
@endpush
