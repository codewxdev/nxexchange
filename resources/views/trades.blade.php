@extends('Layouts.FrontLayout')

@section('content')
    <div class="main-container">
        <div class="row m-0">

            <!-- ===== Left Column: Market List ===== -->

            <div class="col-lg-3 col-md-4 market-sidebar">
                <!-- Selected Coin -->
                <div class="selected-coin d-flex align-items-center mb-3">
                    <img id="selected-coin-img" src="{{ $currencies[0]['image'] }}" alt="" width="40" height="40">
                    <span id="selected-coin-name" class="ms-2 fw-bold">{{ strtoupper($currencies[0]['symbol']) }}</span>
                </div>

                <h3 class="market-title">Markets</h3>

                <div class="market-list">
                    @foreach ($currencies as $index => $coin)
                        <div class="market-item {{ $index === 0 ? 'active' : '' }}" data-name="{{ ucfirst($coin['name']) }}"
                            data-symbol="{{ strtoupper($coin['symbol']) }}" data-image="{{ $coin['image'] }}"
                            data-price="{{ $coin['current_price'] }}"
                            data-change="{{ $coin['price_change_percentage_24h'] }}"
                            data-high="{{ $coin['high_24h'] }}"
                            data-low="{{ $coin['low_24h'] }}"
                            data-volume="{{ $coin['total_volume'] }}"
                            data-marketcap="{{ $coin['market_cap'] }}">
                            <img src="{{ $coin['image'] }}" alt="{{ $coin['name'] }}" />
                            <div class="info">
                                <h5>{{ ucfirst($coin['name']) }}</h5>
                                <p>
                                    ${{ number_format($coin['current_price'], 2) }}
                                    <span
                                        class="change {{ $coin['price_change_percentage_24h'] > 0 ? 'text-success' : 'text-danger' }}">
                                        {{ number_format($coin['price_change_percentage_24h'], 2) }}%
                                    </span>
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- ===== Right Column (Graph / Trading Area) ===== -->
            <div class="col-lg-9 col-md-8 trade-graph-area">
                <!-- ===== Top Stats ===== -->
                {{-- <div class="trade-stats d-flex flex-wrap justify-content-between align-items-center mb-3">
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
                </div> --}}
                <div class="trade-stats d-flex flex-wrap justify-content-between align-items-center mb-3">
                    <div class="stat-box">
                        <span>Last Price</span>
                        <h2 id="last-price">${{ number_format($currencies[0]['current_price'], 2) }}
                            <small id="price-change"
                                class="{{ $currencies[0]['price_change_percentage_24h'] > 0 ? 'text-success' : 'text-danger' }}">
                                {{ number_format($currencies[0]['price_change_percentage_24h'], 2) }}%
                            </small>
                        </h2>
                    </div>
                    <div class="stat-box">
                        <span>24h High</span>
                        <h2 id="high-price">${{ number_format($currencies[0]['high_24h'], 4) }}</h2>
                    </div>
                    <div class="stat-box">
                        <span>24h Low</span>
                        <h2 id="low-price">${{ number_format($currencies[0]['low_24h'], 4) }}</h2>
                    </div>
                    <div class="stat-box">
                        <span>Volume</span>
                        <h2 id="volume">${{ number_format($currencies[0]['total_volume'], 4) }}</h2>
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
                {{-- <div class="mini-stats d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div>Time: 2025-11-29 04:24</div>
                    <div>Open: 103,463</div>
                    <div>High: 104,335.00</div>
                    <div>Low: 108,3838</div>
                    <div>Close: 105,228</div>
                    <div>Volume: 105,228</div>
                </div> --}}
                <div class="mini-stats d-flex flex-wrap justify-content-between align-items-center mb-4">
                    <div>Market Cap: <span id="marketcap">${{ number_format($currencies[0]['market_cap'], 2) }}</span>
                    </div>
                    <div>Open: <span id="open">${{ number_format($currencies[0]['current_price'], 2) }}</span></div>
                    <div>High: <span id="mini-high">${{ number_format($currencies[0]['high_24h'], 2) }}</span></div>
                    <div>Low: <span id="mini-low">${{ number_format($currencies[0]['low_24h'], 2) }}</span></div>
                    <div>Volume: <span id="mini-volume">{{ number_format($currencies[0]['total_volume'], 2) }}</span></div>
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
                            <form id="buy-trade-form" data-direction="Call" data-crypto="BTC"
                                data-balance="{{ $wallet->exchange_account_balance ?? 0 }}">
                                @csrf

                                <div class="signals mb-3">
                                    <select class="form-select" name="signal_id">
                                        <option value="">No Signal (Self)</option>
                                        @foreach ($signalBuys as $signal)
                                            <option value="{{ $signal->id }}" class="text-dark">
                                                {{ $signal->crypto_symbol }} → {{ $signal->direction }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="percentage" id="buy-percentage-input" value="1">

                                <div class="input-group mb-3">
                                    <input type="number" step="0.00000001" class="form-control" id="stake-input"
                                        placeholder="Enter amount (or use percentage buttons)">
                                </div>

                                <div class="percentages d-flex justify-content-between mb-3">
                                    <button type="button" class="percent-btn active" data-percent="1">1%</button>
                                    <button type="button" class="percent-btn" data-percent="3">3%</button>
                                    <button type="button" class="percent-btn" data-percent="7">7%</button>
                                    <button type="button" class="percent-btn" data-percent="25">25%</button>
                                </div>

                                <div class="mini-info d-flex justify-content-between mb-1">
                                    <span>Minimum: <b id="buy-minimum">0.00000001 USDT</b></span>
                                    <span>Available: <b id="buy-available">
                                            {{ number_format($wallet->exchange_account_balance ?? 0, 8) }} USDT
                                        </b></span>
                                </div>
                                <div class="mini-info d-flex justify-content-between mb-3">
                                    <span>Selected Stake: <b id="buy-stake-amount">--</b></span>
                                    <span>Selected %: <b id="buy-selected-percent">1%</b></span>
                                </div>

                                <button type="submit" class="action-btn buy" id="buy-btn">Buy Now</button>
                            </form>
                        </div>

                        <!-- ===== SELL SECTION ===== -->
                        <div class="col-md-6 sell-card">
                            <h4 class="title">Sell BTC</h4>
                            <form id="sell-trade-form" data-direction="Put" data-crypto="BTC"
                                data-balance="{{ $wallet->exchange_account_balance ?? 0 }}">
                                @csrf

                                <div class="signals mb-3">
                                    <select class="form-select" name="signal_id">
                                        <option value="">No Signal (Self)</option>
                                        @foreach ($signalSells as $signal)
                                            <option value="{{ $signal->id }}" class="text-dark">
                                                {{ $signal->crypto_symbol }} → {{ $signal->direction }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <input type="hidden" name="percentage" id="sell-percentage-input" value="1">

                                <div class="input-group mb-3">
                                    <input type="number" step="0.00000001" class="form-control" id="sell-stake-input"
                                        placeholder="Enter amount (or use percentage buttons)">
                                </div>

                                <div class="percentages d-flex justify-content-between mb-3">
                                    <button type="button" class="percent-btn" data-percent="1">1%</button>
                                    <button type="button" class="percent-btn" data-percent="3">3%</button>
                                    <button type="button" class="percent-btn" data-percent="7">7%</button>
                                    <button type="button" class="percent-btn" data-percent="25">25%</button>
                                </div>

                                <div class="mini-info d-flex justify-content-between mb-3">
                                    <span>Minimum: <b id="sell-minimum">0.00000001 USDT</b></span>
                                    <span>Available: <b id="sell-available">
                                            {{ number_format($wallet->exchange_account_balance ?? 0, 8) }} USDT
                                        </b></span>
                                </div>
                                <div class="mini-info d-flex justify-content-between mb-3">
                                    <span>Selected Stake: <b id="sell-stake-amount">--</b></span>
                                    <span>Selected %: <b id="sell-selected-percent">1%</b></span>
                                </div>

                                <button type="submit" class="action-btn sell" id="sell-btn">Sell Now</button>
                            </form>
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
        document.addEventListener("DOMContentLoaded", function() {
            const marketItems = document.querySelectorAll('.market-item');
            const selectedImg = document.getElementById('selected-coin-img');
            const selectedName = document.getElementById('selected-coin-name');
            const lastPrice = document.getElementById('last-price');
            const priceChange = document.getElementById('price-change');
            const highPrice = document.getElementById('high-price');
            const lowPrice = document.getElementById('low-price');
            const volume = document.getElementById('volume');
            const marketCap = document.getElementById('marketcap');
            const miniHigh = document.getElementById('mini-high');
            const miniLow = document.getElementById('mini-low');
            const miniVolume = document.getElementById('mini-volume');
            const open = document.getElementById('open');

            // Initialize chart
            const chartOptions = {
                chart: {
                    type: 'candlestick',
                    height: 420,
                    background: '#0f172a',
                    toolbar: {
                        show: true
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
                    data: []
                }], // empty initially
                xaxis: {
                    type: 'datetime',
                    labels: {
                        style: {
                            colors: '#ccc'
                        }
                    }
                },
                yaxis: {
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
                            upward: '#22c55e',
                            downward: '#ef4444'
                        },
                        wick: {
                            useFillColor: true
                        }
                    }
                }
            };

            const chart = new ApexCharts(document.querySelector("#chart"), chartOptions);
            chart.render();

            // Update coin info and chart
            function updateCoinInfo(coinData) {
                // Update stats
                selectedImg.src = coinData.image;
                selectedName.textContent = coinData.symbol.toUpperCase();
                lastPrice.innerHTML = `$${coinData.current_price.toLocaleString()}`;
                priceChange.textContent = `${coinData.price_change_percentage_24h.toFixed(2)}%`;
                priceChange.className = coinData.price_change_percentage_24h > 0 ? 'text-success' : 'text-danger';
                highPrice.textContent = `$${coinData.high_24h.toLocaleString()}`;
                lowPrice.textContent = `$${coinData.low_24h.toLocaleString()}`;
                volume.textContent = `$${coinData.total_volume.toLocaleString()}`;
                marketCap.textContent = `$${coinData.market_cap.toLocaleString()}`;
                open.textContent = `$${coinData.current_price.toLocaleString()}`;
                miniHigh.textContent = `$${coinData.high_24h.toLocaleString()}`;
                miniLow.textContent = `$${coinData.low_24h.toLocaleString()}`;
                miniVolume.textContent = `$${coinData.total_volume.toLocaleString()}`;

                // Generate chart data (for demo using random candles around current price)
                const chartData = [];
                let base = coinData.current_price;
                for (let i = 0; i < 30; i++) { // last 30 periods
                    const openPrice = base + (Math.random() * 10 - 5);
                    const closePrice = openPrice + (Math.random() * 10 - 5);
                    const highPriceCandle = Math.max(openPrice, closePrice) + Math.random() * 5;
                    const lowPriceCandle = Math.min(openPrice, closePrice) - Math.random() * 5;
                    base = closePrice;
                    chartData.push({
                        x: new Date(Date.now() - (29 - i) * 60 * 1000), // assuming 1-min intervals
                        y: [openPrice.toFixed(2), highPriceCandle.toFixed(2), lowPriceCandle.toFixed(2),
                            closePrice.toFixed(2)
                        ]
                    });
                }

                chart.updateSeries([{
                    data: chartData
                }]);
            }

            // Restore last selected coin or select first
            let savedCoin = localStorage.getItem('selectedCoin');
            if (savedCoin) {
                updateCoinInfo(JSON.parse(savedCoin));
            } else {
                const firstCoin = marketItems[0];
                firstCoin.classList.add('active');
                updateCoinInfo({
                    id: firstCoin.dataset.id,
                    image: firstCoin.dataset.image,
                    symbol: firstCoin.dataset.symbol,
                    current_price: parseFloat(firstCoin.dataset.price),
                    price_change_percentage_24h: parseFloat(firstCoin.dataset.change),
                    high_24h: parseFloat(firstCoin.dataset.high),
                    low_24h: parseFloat(firstCoin.dataset.low),
                    total_volume: parseFloat(firstCoin.dataset.volume),
                    market_cap: parseFloat(firstCoin.dataset.marketcap)
                });
            }

            // Click event to select coin
            marketItems.forEach(item => {
                item.addEventListener('click', function() {
                    marketItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');
                    const coinData = {
                        id: this.dataset.id,
                        image: this.dataset.image,
                        symbol: this.dataset.symbol,
                        current_price: parseFloat(this.dataset.price),
                        price_change_percentage_24h: parseFloat(this.dataset.change),
                        high_24h: parseFloat(this.dataset.high),
                        low_24h: parseFloat(this.dataset.low),
                        total_volume: parseFloat(this.dataset.volume),
                        market_cap: parseFloat(this.dataset.marketcap)
                    };
                    updateCoinInfo(coinData);
                    localStorage.setItem('selectedCoin', JSON.stringify(coinData));
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tradeRoute = @json(route('trade.execute'));
            const buyForm = document.getElementById('buy-trade-form');

            if (!buyForm) {
                return;
            }

            const percentageInput = document.getElementById('buy-percentage-input');
            const stakeInput = document.getElementById('stake-input');
            const stakeAmountText = document.getElementById('buy-stake-amount');
            const selectedPercentText = document.getElementById('buy-selected-percent');
            const availableText = document.getElementById('buy-available');
            const percentButtons = buyForm.querySelectorAll('.percent-btn');
            const csrfInput = buyForm.querySelector('input[name="_token"]');

            let buyBalance = parseFloat(buyForm.dataset.balance || '0');

            const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

            const formatAmount = (value) => Number(value || 0).toFixed(8);

            const updateStakeDisplay = (percent) => {
                const stake = buyBalance * (percent / 100);
                if (stakeAmountText) {
                    stakeAmountText.textContent = `${formatAmount(stake)} USDT`;
                }
                if (selectedPercentText) {
                    selectedPercentText.textContent = `${percent}%`;
                }
                if (stakeInput) {
                    stakeInput.value = formatAmount(stake);
                }
            };

            const setActivePercentage = (percent) => {
                percentageInput.value = percent;
                percentButtons.forEach((btn) => btn.classList.remove('active'));
                const activeButton = Array.from(percentButtons).find(
                    (btn) => parseFloat(btn.dataset.percent) === percent
                );
                if (activeButton) {
                    activeButton.classList.add('active');
                }
                updateStakeDisplay(percent);
            };

            setActivePercentage(parseFloat(percentageInput.value || '1'));

            percentButtons.forEach((btn) => {
                btn.addEventListener('click', () => {
                    const percent = parseFloat(btn.dataset.percent || '1');
                    setActivePercentage(percent);
                });
            });

            if (stakeInput) {
                stakeInput.addEventListener('input', () => {
                    const rawStake = parseFloat(stakeInput.value || '0');

                    if (buyBalance <= 0) {
                        stakeAmountText.textContent = `${formatAmount(rawStake)} USDT`;
                        selectedPercentText.textContent = 'N/A';
                        percentageInput.value = 0;
                        percentButtons.forEach((btn) => btn.classList.remove('active'));
                        return;
                    }

                    let percent = (rawStake / buyBalance) * 100;
                    percent = clamp(percent, 0, 100);

                    percentageInput.value = percent.toFixed(2);
                    selectedPercentText.textContent = `${percent.toFixed(2)}%`;
                    stakeAmountText.textContent = `${formatAmount(rawStake)} USDT`;

                    let matched = false;
                    percentButtons.forEach((btn) => {
                        const btnPercent = parseFloat(btn.dataset.percent || '0');
                        if (Math.abs(btnPercent - percent) < 0.01) {
                            btn.classList.add('active');
                            matched = true;
                        } else {
                            btn.classList.remove('active');
                        }
                    });

                    if (!matched) {
                        percentButtons.forEach((btn) => btn.classList.remove('active'));
                    }
                });
            }

            buyForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                // Calculate 1% of balance (as per requirement)
                const calculatedStake = buyBalance * 0.01;
                const minimumStake = 0.01;

                // Frontend validation: Minimum trade is 0.01 USDT
                if (calculatedStake < minimumStake) {
                    alert('Insufficient amount. Minimum trade is 0.01 USDT. Your 1% balance (' + formatAmount(calculatedStake) + ' USDT) is less than 0.01 USDT.');
                    return;
                }

                const payload = {
                    direction: buyForm.dataset.direction,
                    crypto_symbol: buyForm.dataset.crypto,
                    signal_id: buyForm.querySelector('select[name="signal_id"]').value || null,
                    percentage: percentageInput.value,
                };

                const headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                };

                if (csrfInput) {
                    headers['X-CSRF-TOKEN'] = csrfInput.value;
                }

                try {
                    const response = await fetch(tradeRoute, {
                        method: 'POST',
                        headers,
                        body: JSON.stringify(payload),
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.error || 'Trade execution failed.');
                    }

                    alert('Trade executed! New balance: ' + data.new_balance + ' USDT');

                    if (typeof data.new_balance !== 'undefined') {
                        buyBalance = parseFloat(data.new_balance) || 0;
                        if (availableText) {
                            availableText.textContent = `${formatAmount(buyBalance)} USDT`;
                        }
                        setActivePercentage(parseFloat(percentageInput.value || '1'));
                    }
                } catch (error) {
                    alert('Trade failed: ' + error.message);
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tradeRoute = @json(route('trade.execute'));
            const sellForm = document.getElementById('sell-trade-form');

            if (!sellForm) {
                return;
            }

            const percentageInput = document.getElementById('sell-percentage-input');
            const stakeInput = document.getElementById('sell-stake-input');
            const stakeAmountText = document.getElementById('sell-stake-amount');
            const selectedPercentText = document.getElementById('sell-selected-percent');
            const availableText = document.getElementById('sell-available');
            const percentButtons = sellForm.querySelectorAll('.percent-btn');
            const csrfInput = sellForm.querySelector('input[name="_token"]');

            let sellBalance = parseFloat(sellForm.dataset.balance || '0');

            const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

            const formatAmount = (value) => Number(value || 0).toFixed(8);

            const updateStakeDisplay = (percent) => {
                const stake = sellBalance * (percent / 100);
                if (stakeAmountText) {
                    stakeAmountText.textContent = `${formatAmount(stake)} USDT`;
                }
                if (selectedPercentText) {
                    selectedPercentText.textContent = `${percent}%`;
                }
                if (stakeInput) {
                    stakeInput.value = formatAmount(stake);
                }
            };

            const setActivePercentage = (percent) => {
                percentageInput.value = percent;
                percentButtons.forEach((btn) => btn.classList.remove('active'));
                const activeButton = Array.from(percentButtons).find(
                    (btn) => parseFloat(btn.dataset.percent) === percent
                );
                if (activeButton) {
                    activeButton.classList.add('active');
                }
                updateStakeDisplay(percent);
            };

            setActivePercentage(parseFloat(percentageInput.value || '1'));

            percentButtons.forEach((btn) => {
                btn.addEventListener('click', () => {
                    const percent = parseFloat(btn.dataset.percent || '1');
                    setActivePercentage(percent);
                });
            });

            if (stakeInput) {
                stakeInput.addEventListener('input', () => {
                    const rawStake = parseFloat(stakeInput.value || '0');

                    if (sellBalance <= 0) {
                        stakeAmountText.textContent = `${formatAmount(rawStake)} USDT`;
                        selectedPercentText.textContent = 'N/A';
                        percentageInput.value = 0;
                        percentButtons.forEach((btn) => btn.classList.remove('active'));
                        return;
                    }

                    let percent = (rawStake / sellBalance) * 100;
                    percent = clamp(percent, 0, 100);

                    percentageInput.value = percent.toFixed(2);
                    selectedPercentText.textContent = `${percent.toFixed(2)}%`;
                    stakeAmountText.textContent = `${formatAmount(rawStake)} USDT`;

                    let matched = false;
                    percentButtons.forEach((btn) => {
                        const btnPercent = parseFloat(btn.dataset.percent || '0');
                        if (Math.abs(btnPercent - percent) < 0.01) {
                            btn.classList.add('active');
                            matched = true;
                        } else {
                            btn.classList.remove('active');
                        }
                    });

                    if (!matched) {
                        percentButtons.forEach((btn) => btn.classList.remove('active'));
                    }
                });
            }

            sellForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                // Calculate 1% of balance (as per requirement)
                const calculatedStake = sellBalance * 0.01;
                const minimumStake = 0.01;

                // Frontend validation: Minimum trade is 0.01 USDT
                if (calculatedStake < minimumStake) {
                    alert('Insufficient amount. Minimum trade is 0.01 USDT. Your 1% balance (' + formatAmount(calculatedStake) + ' USDT) is less than 0.01 USDT.');
                    return;
                }

                const payload = {
                    direction: sellForm.dataset.direction,
                    crypto_symbol: sellForm.dataset.crypto,
                    signal_id: sellForm.querySelector('select[name="signal_id"]').value || null,
                    percentage: percentageInput.value,
                };

                const headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                };

                if (csrfInput) {
                    headers['X-CSRF-TOKEN'] = csrfInput.value;
                }

                try {
                    const response = await fetch(tradeRoute, {
                        method: 'POST',
                        headers,
                        body: JSON.stringify(payload),
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.error || 'Trade execution failed.');
                    }

                    alert('Trade executed! New balance: ' + data.new_balance + ' USDT');

                    if (typeof data.new_balance !== 'undefined') {
                        sellBalance = parseFloat(data.new_balance) || 0;
                        if (availableText) {
                            availableText.textContent = `${formatAmount(sellBalance)} USDT`;
                        }
                        setActivePercentage(parseFloat(percentageInput.value || '1'));
                    }
                } catch (error) {
                    alert('Trade failed: ' + error.message);
                }
            });
        });
    </script>

    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const marketItems = document.querySelectorAll('.market-item');
            const selectedImg = document.getElementById('selected-coin-img');
            const selectedName = document.getElementById('selected-coin-name');
            const lastPrice = document.getElementById('last-price');
            const priceChange = document.getElementById('price-change');
            const highPrice = document.getElementById('high-price');
            const lowPrice = document.getElementById('low-price');
            const volume = document.getElementById('volume');
            const marketCap = document.getElementById('marketcap');
            const miniHigh = document.getElementById('mini-high');
            const miniLow = document.getElementById('mini-low');
            const miniVolume = document.getElementById('mini-volume');
            const open = document.getElementById('open');

            // Function to update all stats
            function updateCoinInfo(coinData) {
                selectedImg.src = coinData.image;
                selectedName.textContent = coinData.symbol.toUpperCase();

                lastPrice.innerHTML = `$${coinData.current_price.toLocaleString()}`;
                priceChange.textContent = `${coinData.price_change_percentage_24h.toFixed(2)}%`;
                priceChange.className = coinData.price_change_percentage_24h > 0 ? 'text-success' : 'text-danger';

                highPrice.textContent = `$${coinData.high_24h.toLocaleString()}`;
                lowPrice.textContent = `$${coinData.low_24h.toLocaleString()}`;
                volume.textContent = `$${coinData.total_volume.toLocaleString()}`;

                marketCap.textContent = `$${coinData.market_cap.toLocaleString()}`;
                open.textContent = `$${coinData.current_price.toLocaleString()}`;
                miniHigh.textContent = `$${coinData.high_24h.toLocaleString()}`;
                miniLow.textContent = `$${coinData.low_24h.toLocaleString()}`;
                miniVolume.textContent = `$${coinData.total_volume.toLocaleString()}`;
            }

            // Restore last selected coin from localStorage
            let savedCoin = localStorage.getItem('selectedCoin');
            if (savedCoin) {
                const coinData = JSON.parse(savedCoin);
                updateCoinInfo(coinData);

                // Set active class
                marketItems.forEach(item => {
                    if (item.dataset.id === coinData.id) {
                        item.classList.add('active');
                    } else {
                        item.classList.remove('active');
                    }
                });
            } else {
                // If no saved coin, select first one by default
                const firstCoin = marketItems[0];
                firstCoin.classList.add('active');
                updateCoinInfo({
                    id: firstCoin.dataset.id,
                    image: firstCoin.dataset.image,
                    symbol: firstCoin.dataset.symbol,
                    current_price: parseFloat(firstCoin.dataset.price),
                    price_change_percentage_24h: parseFloat(firstCoin.dataset.change),
                    high_24h: parseFloat(firstCoin.dataset.high),
                    low_24h: parseFloat(firstCoin.dataset.low),
                    total_volume: parseFloat(firstCoin.dataset.volume),
                    market_cap: parseFloat(firstCoin.dataset.marketcap)
                });
            }

            // Click event for selecting a coin
            marketItems.forEach(item => {
                item.addEventListener('click', function() {
                    marketItems.forEach(i => i.classList.remove('active'));
                    this.classList.add('active');

                    const coinData = {
                        id: this.dataset.id,
                        image: this.dataset.image,
                        symbol: this.dataset.symbol,
                        current_price: parseFloat(this.dataset.price),
                        price_change_percentage_24h: parseFloat(this.dataset.change),
                        high_24h: parseFloat(this.dataset.high),
                        low_24h: parseFloat(this.dataset.low),
                        total_volume: parseFloat(this.dataset.volume),
                        market_cap: parseFloat(this.dataset.marketcap)
                    };

                    updateCoinInfo(coinData);

                    // Save selected coin in localStorage
                    localStorage.setItem('selectedCoin', JSON.stringify(coinData));
                });
            });

            // Optional: Auto-update data every 6 seconds without reload
            setInterval(async () => {
                // Fetch latest data from server endpoint
                const response = await fetch(
                    '/api/coin-data'); // Laravel route returning JSON for all coins
                const data = await response.json();

                const currentCoin = JSON.parse(localStorage.getItem('selectedCoin'));
                if (currentCoin) {
                    const updatedCoin = data.find(c => c.id === currentCoin.id);
                    if (updatedCoin) {
                        updateCoinInfo(updatedCoin);
                    }
                }
            }, 6000);
        });
    </script> --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const intervalButtons = document.querySelectorAll('.interval-btn');
            const outOrder = document.querySelector('.info-row div:nth-child(1) h6');
            const countdown = document.querySelector('.info-row div:nth-child(2) h6');
            const timePeriod = document.querySelector('.info-row div:nth-child(3) h6');

            // Default interval: 60S
            let selectedInterval = '60S';
            let countdownValue = 5; // seconds
            let countdownTimer;

            function updateInfoRow(interval) {
                // Example logic for out order time
                const now = new Date();
                outOrder.textContent = now.toLocaleString();

                // Set countdown based on interval
                switch (interval) {
                    case '60S':
                        countdownValue = 60;
                        break;
                    case '120S':
                        countdownValue = 120;
                        break;
                    case '5M':
                        countdownValue = 300;
                        break;
                    case '10M':
                        countdownValue = 600;
                        break;
                    case '1H':
                        countdownValue = 3600;
                        break;
                    case '24H':
                        countdownValue = 86400;
                        break;
                }
                countdown.textContent = countdownValue + 's';

                // Set time period
                const end = new Date(now.getTime() + countdownValue * 1000);
                const formatTime = date =>
                    `${date.getHours().toString().padStart(2,'0')}:${date.getMinutes().toString().padStart(2,'0')}`;
                timePeriod.textContent = `${formatTime(now)} ~ ${formatTime(end)}`;

                // Clear existing countdown if any
                if (countdownTimer) clearInterval(countdownTimer);

                // Start countdown
                countdownTimer = setInterval(() => {
                    countdownValue--;
                    countdown.textContent = countdownValue + 's';
                    if (countdownValue <= 0) {
                        clearInterval(countdownTimer);
                    }
                }, 1000);
            }

            // Set default on page load
            updateInfoRow(selectedInterval);

            // Click event for interval buttons
            intervalButtons.forEach(btn => {
                btn.addEventListener('click', function() {
                    intervalButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    selectedInterval = this.textContent;
                    updateInfoRow(selectedInterval);
                });
            });
        });
    </script>



    {{-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
    </script> --}}
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
            margin-right: 10px;
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
            font-size: 1.2rem;
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
