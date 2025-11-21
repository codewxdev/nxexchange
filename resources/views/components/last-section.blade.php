   <div class="last-section" id="learn">
        <div class="container">
            <!-- First Row -->
            <div class="intro d-flex flex-wrap align-items-center justify-content-between">
                <h1 class="heading">World Class Trading For Everyone</h1>
                <dotlottie-wc src="https://lottie.host/8f187657-62a9-4b41-8dfd-3e68422aac48/scXn824UM3.lottie" autoplay
                    loop class="lottie-animation">
                </dotlottie-wc>
            </div>

            <!-- Second Row -->
            <div class="feature-text">
                <h2>Advanced Features</h2>
                <h3>For professional traders and institutional users.</h3>
                <p>
                   NXExchange delivers advanced trading solutions designed for professional traders, institutional investors, and corporate clients. Along with a complete suite of trading and charting tools and deep liquidity across major pairs, we provide exceptional co-location and high-speed connectivity options — ensuring ultra-fast execution and peak trading performance.
                </p>
            </div>

            <!-- Third Row -->
            <div class="glass-boxes">
                <dotlottie-wc class="last-graphic"
                    src="https://lottie.host/aab79731-15e3-4370-aab7-768a05a63e48/F1DXdz4mOw.lottie"
                    style="width: 300px;height: 300px" autoplay loop></dotlottie-wc>
                <div class="glass-box">
                    <i class="fa-solid fa-shield-halved"></i>
                    <div>
                        <h5>Professional Compliance</h5>
                        <p>US-licensed with strong global partnerships ensuring secure investments.</p>
                    </div>
                </div>
                <div class="glass-box">
                    <i class="fa-solid fa-handshake"></i>
                    <div>
                        <h5>Trusted Partnerships</h5>
                        <p>Collaborating with top-tier financial firms for global reach.</p>
                    </div>
                </div>
                <div class="glass-box">
                    <i class="fa-solid fa-user-shield"></i>
                    <div>
                        <h5>Investor Protection</h5>
                        <p>Advanced compliance standards safeguarding every user.</p>
                    </div>
                </div>
            </div>

            <!-- Fourth Row -->
            <div class="scroll-boxes">
                <div class="scroll-track">
                    <div class="scroll-card large">
                        <h4>Margin Trading</h4>
                        <p>Trade with up to 10x leverage. Experience precision and performance.</p>
                    </div>
                    <div class="scroll-card medium">
                        <h4>API Integration</h4>
                        <p>Automate trades and build your custom trading solutions.</p>
                    </div>
                    <div class="scroll-card small">
                        <h4>Smart Analytics</h4>
                        <p>Powerful tools that make market insights easier to access.</p>
                    </div>
                    <div class="scroll-card medium">
                        <h4>AI Signals</h4>
                        <p>Machine learning-driven predictions for better decision-making.</p>
                    </div>


                </div>
            </div>

        </div>
    </div>

    @section('footer')
         <footer class="brand-footer">
        <div class="container py-5">
            <div class="row">
                <!-- Logo & Description -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="#" class="footer-logo">
                        <img src="{{ asset('assets/images/logo2.png') }}" alt="Logo" />
                    </a>
                    <p class="footer-desc mt-3">
                        NxExchange is your one-stop cryptocurrency platform offering safe, high-yield investments and
                        global coverage.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('market.index') }}">Market</a></li>
                        <li><a href="{{ route('trade.index') }}">Trade</a></li>
                        <li><a href="{{ route('asset.index') }}">Assets</a></li>
                        {{-- <li><a href="#">Pricing</a></li>
                        <li><a href="#">Support</a></li> --}}
                    </ul>
                </div>

                <!-- Company -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Company</h5>
                    <ul class="footer-links">
                        <li><a href="{{ route('about.index') }}">About Us</a></li>
                        {{-- <li><a href="#">Careers</a></li> --}}
                        {{-- <li><a href="#">Blog</a></li> --}}
                        <li><a href="{{ route('contact.index') }}">Contact</a></li>
                        <li><a href="{{ route('help.terms') }}">Terms & Privacy</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5 class="footer-title">Subscribe to Our Newsletter</h5>
                    <p>Get the latest crypto updates, market news, and exclusive offers.</p>
                    <form class="newsletter-form d-flex mt-3">
                        <input type="email" placeholder="Enter your email" />
                        <button type="submit">Subscribe</button>
                    </form>
                    <div class="social-icons mt-4">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

            </div>

            <div class="footer-bottom text-center mt-4">
                <p>&copy; 2025 NxExchange. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
    @endsection