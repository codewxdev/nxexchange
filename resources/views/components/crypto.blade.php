 {{-- <div class="crypto-section py-5">
     <div class="container text-center">
         <h2 class="crypto-title mb-2">Live Cryptocurrency Prices</h2>
         <p class="crypto-subtitle mb-4">Track real-time token performance, market movement, and price insights</p>

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
                         <td class="token-cell">
                             <img src="{{ asset('assets/images/bitcoin.png') }}" width="28" alt="BTC"> BTC
                         </td>
                         <td>$103,423.88</td>
                         <td class="text-danger">-0.04%</td>
                         <td>$103,741.96</td>
                         <td>$102,488.34</td>
                         <td>87.66M</td>
                     </tr>
                     <tr>
                         <td class="token-cell">
                             <img src="{{ asset('assets/images/authen.png') }}" width="28" alt="ETH"> ETH
                         </td>
                         <td>$3,240.50</td>
                         <td class="text-success">+1.26%</td>
                         <td>$3,310.00</td>
                         <td>$3,180.24</td>
                         <td>43.21M</td>
                     </tr>
                     <tr>
                         <td class="token-cell">
                             <img src="{{ asset('assets/images/T.png') }}" width="28" alt="USDT"> USDT
                         </td>
                         <td>$1.00</td>
                         <td class="text-muted">0.00%</td>
                         <td>$1.01</td>
                         <td>$0.99</td>
                         <td>102.12M</td>
                     </tr>
                     <tr>
                         <td class="token-cell">
                             <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28" alt="USDT">
                             USDT
                         </td>
                         <td>$1.00</td>
                         <td class="text-muted">0.00%</td>
                         <td>$1.01</td>
                         <td>$0.99</td>
                         <td>102.12M</td>
                     </tr>
                     <tr>
                         <td class="token-cell">
                             <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28" alt="USDT">
                             USDT
                         </td>
                         <td>$1.00</td>
                         <td class="text-muted">0.00%</td>
                         <td>$1.01</td>
                         <td>$0.99</td>
                         <td>102.12M</td>
                     </tr>
                     <tr>
                         <td class="token-cell">
                             <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28" alt="USDT">
                             USDT
                         </td>
                         <td>$1.00</td>
                         <td class="text-muted">0.00%</td>
                         <td>$1.01</td>
                         <td>$0.99</td>
                         <td>102.12M</td>
                     </tr>
                     <tr>
                         <td class="token-cell">
                             <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28" alt="USDT">
                             USDT
                         </td>
                         <td>$1.00</td>
                         <td class="text-muted">0.00%</td>
                         <td>$1.01</td>
                         <td>$0.99</td>
                         <td>102.12M</td>
                     </tr>
                     <tr>
                         <td class="token-cell">
                             <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28" alt="USDT">
                             USDT
                         </td>
                         <td>$1.00</td>
                         <td class="text-muted">0.00%</td>
                         <td>$1.01</td>
                         <td>$0.99</td>
                         <td>102.12M</td>
                     </tr>
                     <tr>
                         <td class="token-cell">
                             <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28" alt="USDT">
                             USDT
                         </td>
                         <td>$1.00</td>
                         <td class="text-muted">0.00%</td>
                         <td>$1.01</td>
                         <td>$0.99</td>
                         <td>102.12M</td>
                     </tr>
                     <tr>
                         <td class="token-cell">
                             <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28" alt="USDT">
                             USDT
                         </td>
                         <td>$1.00</td>
                         <td class="text-muted">0.00%</td>
                         <td>$1.01</td>
                         <td>$0.99</td>
                         <td>102.12M</td>
                     </tr>
                 </tbody>
             </table>
         </div>
     </div>
 </div> --}}
 <div class="crypto-section py-3">
     <div class="container text-center">
         <h2 class="crypto-title mb-2">Live Cryptocurrency Prices</h2>
         <p class="crypto-subtitle mb-4">Track real-time token performance, market movement, and price insights</p>

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
                         <td colspan="6" class="text-center">Loading live data...</td>
                     </tr>
                 </tbody>
             </table>
         </div>
     </div>
 </div>

 @push('scripts')
     <script>
         async function fetchCryptoData() {
             try {
                 const response = await fetch('{{ url('/crypto-data') }}');
                 const data = await response.json();

                 // Get table body
                 let tableBody = document.querySelector('.crypto-table tbody');

                 // If first load → build rows
                 if (tableBody.querySelectorAll('tr').length <= 1 || tableBody.innerText.includes('Loading')) {
                     tableBody.innerHTML = '';
                     data.forEach(coin => {
                         const row = `
                        <tr data-symbol="${coin.symbol.toUpperCase()}">
                            <td class="token-cell">
                                <img src="${coin.image}" width="28" alt="${coin.symbol.toUpperCase()}"> ${coin.symbol.toUpperCase()}
                            </td>
                            <td class="price">$${coin.current_price.toLocaleString()}</td>
                            <td class="change">${coin.price_change_percentage_24h.toFixed(2)}%</td>
                            <td class="high">$${coin.high_24h.toLocaleString()}</td>
                            <td class="low">$${coin.low_24h.toLocaleString()}</td>
                            <td class="volume">${(coin.total_volume / 1000000).toFixed(2)}M</td>
                        </tr>
                    `;
                         tableBody.insertAdjacentHTML('beforeend', row);
                     });
                 } else {
                     // Update existing rows only
                     data.forEach(coin => {
                         const row = tableBody.querySelector(`tr[data-symbol="${coin.symbol.toUpperCase()}"]`);
                         if (row) {
                             row.querySelector('.price').textContent = `$${coin.current_price.toLocaleString()}`;
                             const changeCell = row.querySelector('.change');
                             changeCell.textContent = `${coin.price_change_percentage_24h.toFixed(2)}%`;
                             changeCell.className =
                                 `change ${coin.price_change_percentage_24h >= 0 ? 'text-success' : 'text-danger'}`;
                             row.querySelector('.high').textContent = `$${coin.high_24h.toLocaleString()}`;
                             row.querySelector('.low').textContent = `$${coin.low_24h.toLocaleString()}`;
                             row.querySelector('.volume').textContent =
                                 `${(coin.total_volume / 1000000).toFixed(2)}M`;
                         }
                     });
                 }

             } catch (error) {
                 console.error('Error fetching crypto data:', error);
             }
         }

         // Load immediately
         fetchCryptoData();

         // Refresh every 10 seconds
         setInterval(fetchCryptoData, 1000);
     </script>
 @endpush
