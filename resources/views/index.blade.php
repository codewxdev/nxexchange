<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script src="{{ asset('js/crypto-websocket.js') }}"></script>
    <title>Hello, world!</title>
    <style>
        /* ===== Global Theme Colors ===== */
        :root {
            --primary-color: #F46523;
            --dark-color: #010101;
            --text-light: #ffffff;
        }

        /* ===== Navbar Styling ===== */
        .navbar {
            background-color: var(--dark-color) !important;
            padding: 1rem 2rem;
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-weight: 700;
            font-size: 1.4rem;
            letter-spacing: 1px;
        }

        .navbar-nav .nav-link {
            color: var(--text-light) !important;
            margin-right: 1rem;
            transition: color 0.3s ease;
        }

        .navbar-nav .nav-link:hover {
            color: var(--primary-color) !important;
        }

        /* ===== Button Styling ===== */
        .btns {
            display: flex;
            gap: 10px;
        }

        .btn1 {
            background-color: var(--primary-color) !important;
            border: none;
            color: var(--text-light);
            font-weight: 500;
            transition: all 0.3s ease;
            font-weight: 400;
            border-radius: 10px;
            text-align: center;
            font-size: 14px;


        }

        .btn2 {
            background-color: transparent;
            border: 1px solid white;
            color: var(--text-light);
            font-weight: 500;
            transition: all 0.3s ease;
            font-weight: 400;
            border-radius: 10px;
            text-align: center;
            font-size: 14px;

        }

        .btn1:hover {
            background-color: #ff783a !important;
            transform: scale(1.05);
        }

        .btn2:hover {
            background-color: #ff783a !important;
            transform: scale(1.05);
        }

        #language {
            background-color: transparent;
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 6px;
            padding: 6px 28px 6px 10px;
            font-size: 0.95rem;
            font-weight: 500;
            appearance: none;
            outline: none;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
            background-image: url("data:image/svg+xml;utf8,<svg fill='%23F46523' height='14' viewBox='0 0 24 24' width='14' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
            background-repeat: no-repeat;
            background-position: right 10px center;
            margin-left: 15px;
        }

        #language:hover {
            border-color: #F46523;
        }

        #language:focus {
            border-color: #F46523;
            box-shadow: 0 0 6px rgba(244, 101, 35, 0.5);
        }

        /* ===== Option Styling ===== */
        #language option {
            background-color: #010101;
            color: #ffffff;
            font-weight: 500;
            border: none;
            padding: 8px;
        }

        #language option:hover {
            background-color: #F46523;
            color: #ffffff;
        }

        .main {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 89px;
        }

        .main .content a {
            background-color: #f465235c;
            padding: 7px 14px;
            border-radius: 15px;
            font-size: 14px;
            color: #F46523;
            text-decoration: none;

        }

        .main .content h1 {
            font-size: 65px;

        }

        .hero-btns .btn1 {
            background-color: var(--primary-color) !important;
            border: none;
            color: var(--text-light);
            font-weight: 500;
            transition: all 0.3s ease;
            font-weight: 400;
            border-radius: 10px;
            text-align: center;
            font-size: 16px;
            padding: 10px 62px;
        }

        .hero-btns .btn2 {

            font-size: 16px;
            padding: 10px 62px;
        }

        .graphic {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .about {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 50px 0;
        }

        .about .row {

            width: 50%;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            text-align: center;
        }

        .about .col h2 {
            font-size: 2rem;
            margin: 0;
            color: white;
            /* Customize color */
        }

        .about .col p {
            margin: 10px 0 0;
            color: #555;
            font-size: 1rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .about .row {
                width: 80%;
                grid-template-columns: 1fr;
            }
        }


        .crypto-section {
            background-color: #111;
            color: #fff;
            text-align: center;
        }

        .crypto-title {
            font-size: 3rem;
            font-weight: 700;
            color: white;
            letter-spacing: 1px;
        }

        .crypto-subtitle {
            color: #ccc;
            font-size: 0.95rem;
        }

        .crypto-table {
            width: 100%;
            border-collapse: collapse;
            color: #fff;
            min-width: 700px;
            background-color: #1a1a1a;
            border-radius: 10px;
            overflow: hidden;
        }

        .crypto-table thead {
            background-color: #F46523;
            color: #fff;
        }

        .crypto-table th {
            padding: 14px 12px;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            border: none;
        }

        .crypto-table td {
            padding: 14px 12px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            vertical-align: middle;
            font-size: 0.95rem;
        }

        .crypto-table tbody tr:hover {
            background-color: rgba(244, 101, 35, 0.08);
            transition: 0.3s ease;
        }

        .token-cell {
            display: flex;
            align-items: center;
            gap: 8px;
            justify-content: center;
        }

        .text-success {
            color: #4CAF50 !important;
        }

        .text-danger {
            color: #E53935 !important;
        }

        .text-muted {
            color: #aaa !important;
        }

        .table-responsive {

            max-height: 700px;
            /* 👈 Set your preferred visible height */
            overflow-y: auto;
            /* Enable vertical scrolling */
            overflow-x: auto;
            /* Keep horizontal scroll for small screens */
            scrollbar-width: thin;
            scrollbar-color: #F46523 #1a1a1a;
        }

        .table-responsive::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #F46523;
            border-radius: 4px;
        }


        .hooks-section {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 70px 0;
            background: #0a0a0a;
        }

        .hooks-section .row {
            width: 40%;
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .hooks-section .col {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px 25px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #fff;
            transition: all 0.3s ease;
        }

        .hooks-section .col:hover {
            background: rgba(244, 101, 35, 0.15);
            transform: translateY(-3px);
        }

        .hooks-section .icon-wrapper {
            width: 60px;
            height: 60px;
            min-width: 60px;
            border-radius: 50%;
            background: rgba(244, 101, 35, 0.2);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hooks-section .icon-wrapper i {
            font-size: 24px;
            color: #F46523;
        }

        .hooks-section .text h2 {
            font-size: 1.2rem;
            margin: 0;
            color: #fff;
            font-weight: 600;
        }

        .hooks-section .text p {
            margin: 5px 0 0;
            color: #ccc;
            font-size: 0.95rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hooks-section .row {
                width: 70%;
            }
        }

        @media (max-width: 576px) {
            .hooks-section .row {
                width: 90%;
            }

            .hooks-section .col {
                flex-direction: row;
                align-items: flex-start;
            }

            .hooks-section .icon-wrapper {
                width: 50px;
                height: 50px;
            }

            .hooks-section .icon-wrapper i {
                font-size: 20px;
            }
        }

        .last-section {
            background: #0a0a0a;
            color: #fff;
            padding: 80px 0;
            overflow: hidden;
        }

        /* ===== First Row ===== */
        .last-section .intro {
            margin-bottom: 60px;
        }

        .last-section .heading {
            font-size: 3rem;
            font-weight: 700;
            flex: 1;
            max-width: 55%;
            color: #fff;
        }

        .last-section .lottie-animation {
            width: 400px;
            height: 400px;
            flex-shrink: 0;
        }

        /* ===== Second Row ===== */
        .feature-text {
            max-width: 70%;
            margin: 0 auto 70px auto;
            text-align: left;
        }

        .feature-text h2 {
            color: #F46523;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .feature-text h3 {
            color: #fff;
            font-size: 1.3rem;
            margin-bottom: 15px;
        }

        .feature-text p {
            color: #bbb;
            line-height: 1.7;
        }

        /* ===== Third Row (Glass Boxes) ===== */
        .glass-boxes {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            margin-bottom: 80px;
        }

        .glass-box {
            display: flex;
            align-items: center;
            gap: 15px;
            width: 60%;
            padding: 20px 25px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            transition: all 0.3s ease;
        }

        .glass-box:hover {
            background: rgba(244, 101, 35, 0.15);
            transform: translateY(-3px);
        }

        .glass-box i {
            font-size: 28px;
            color: #F46523;
            background: rgba(244, 101, 35, 0.15);
            border-radius: 50%;
            padding: 15px;
        }

        /* ===== Fourth Row (Horizontal Scroll) ===== */
        .scroll-boxes {
            overflow: hidden;
            position: relative;
            height: 220px;
        }

        .scroll-track {
            display: flex;
            gap: 25px;
            animation: moveCards 20s linear infinite;
        }

        .scroll-card {
            flex-shrink: 0;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(6px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 16px;
            padding: 25px;
            color: #fff;
        }

        .scroll-card h4 {
            color: #F46523;
            margin-bottom: 10px;
        }

        .scroll-card.large {
            width: 280px;
            height: 180px;
        }

        .scroll-card.medium {
            width: 230px;
            height: 160px;
        }

        .scroll-card.small {
            width: 240px;
            height: 140px;
        }

        /* Add this animation */
        @keyframes floatMove {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }


        .last-section .col:last-child .col:nth-child(2) {
            animation-delay: 0.5s;
        }

        .last-section .col:last-child .col:nth-child(3) {
            animation-delay: 1s;
        }

        .last-section .col:last-child .col:nth-child(4) {
            animation-delay: 1.5s;
        }

        /* ===== Responsive ===== */
        @media (max-width: 992px) {
            .last-section .intro {
                flex-direction: column;
                text-align: center;
            }

            .last-section .heading {
                max-width: 100%;
                font-size: 2rem;
                margin-bottom: 30px;
            }

            .last-section .lottie-animation {
                width: 300px;
                height: 300px;
            }

            .feature-text {
                max-width: 90%;
            }

            .glass-box {
                width: 80%;
            }
        }

        @media (max-width: 576px) {
            .glass-box {
                width: 90%;
                flex-direction: column;
                text-align: center;
            }
        }

        .brand-footer {
            background-color: #010101;
            color: #fff;
            font-family: sans-serif;
            border-top: 3px solid #F46523;
        }

        .brand-footer .footer-logo img {
            width: 120px;
        }

        .brand-footer .footer-desc {
            color: #aaa;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .brand-footer .footer-title {
            color: #F46523;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .brand-footer .footer-links {
            list-style: none;
            padding: 0;
        }

        .brand-footer .footer-links li {
            margin-bottom: 10px;
        }

        .brand-footer .footer-links li a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .brand-footer .footer-links li a:hover {
            color: #F46523;
        }

        .brand-footer .newsletter-form {
            display: flex;
            gap: 10px;
        }

        .brand-footer .newsletter-form input {
            flex: 1;
            padding: 10px 15px;
            border-radius: 8px;
            border: none;
            outline: none;
        }

        .brand-footer .newsletter-form button {
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            background-color: #F46523;
            color: #fff;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .brand-footer .newsletter-form button:hover {
            background-color: #ff783a;
        }

        .brand-footer .social-icons {
            display: flex;
            gap: 15px;
        }

        .brand-footer .social-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #111;
            color: #fff;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            transition: all 0.3s ease;
        }

        .brand-footer .social-icons a:hover {
            background-color: #F46523;
            color: #fff;
        }

        .brand-footer .footer-bottom p {
            color: #777;
            margin-top: 20px;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .brand-footer .newsletter-form {
                flex-direction: column;
            }

            .brand-footer .newsletter-form button {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .brand-footer .social-icons {
                justify-content: center;
            }
        }

        /* ===== Body Background ===== */
        body {
            background-color: #0f0f0f;
            color: var(--text-light);
        }

        * {
            font-family: sans-serif;

        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="{{ asset('assets/images/logo2.png') }}" alt=""
                    width="80px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Market</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Trade</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Assets</a>
                    </li>

                </ul>
                <div class="btns">
                    <button class="btn btn-primary btn1">Sign In</button>
                    <button class="btn btn-primary btn2">Register now</button>
                </div>
                <select name="" id="language">
                    <option value="en">English</option>
                    <option value="fr">French</option>
                    <option value="de">Duch</option>
                    <option value="de">Duch</option>
                </select>
            </div>
        </div>
    </nav>

    <!-- ===== Hero Section ===== -->
    <div class="main row m-0">
        <div class="content col">
            <a href="">Join NxExchange To Unlock Financial Freedom </a>
            <h1>One-stop cryptocurrency exchange</h1>
            <p>The World's leading digital asset exchange, safe, efficiant, high-yeild, double the value of assets</p>

            <div class="hero-btns d-flex gap-3 mt-4">
                <button class="btn btn-primary btn1">Get Started</button>
                <button class="btn btn-primary btn2">Learn More</button>
            </div>
        </div>
        <div class="graphic col">
            <dotlottie-wc src="https://lottie.host/e79b4df1-5cb7-4307-9c05-9afe716c4700/9ksUtznzIb.lottie"
                style="width: 500px;height: 500px" autoplay loop></dotlottie-wc>
        </div>
    </div>

    <!-- ===== About Section ===== -->
    <div class="about">
        <div class="row">
            <div class="col">
                <h2>340+</h2>
                <p>Quality Financial Assets</p>
            </div>
            <div class="col">
                <h2>20+</h2>
                <p>Countries Coverage</p>
            </div>
            <div class="col">
                <h2>1000k+</h2>
                <p>Global Users</p>
            </div>
            <div class="col">
                <h2>7*24H+</h2>
                <p>Service Support</p>
            </div>


        </div>
    </div>
    </div>

    <!-- ===== Live Crypto Section ===== -->
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
                                <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28"
                                    alt="USDT"> USDT
                            </td>
                            <td>$1.00</td>
                            <td class="text-muted">0.00%</td>
                            <td>$1.01</td>
                            <td>$0.99</td>
                            <td>102.12M</td>
                        </tr>
                        <tr>
                            <td class="token-cell">
                                <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28"
                                    alt="USDT"> USDT
                            </td>
                            <td>$1.00</td>
                            <td class="text-muted">0.00%</td>
                            <td>$1.01</td>
                            <td>$0.99</td>
                            <td>102.12M</td>
                        </tr>
                        <tr>
                            <td class="token-cell">
                                <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28"
                                    alt="USDT"> USDT
                            </td>
                            <td>$1.00</td>
                            <td class="text-muted">0.00%</td>
                            <td>$1.01</td>
                            <td>$0.99</td>
                            <td>102.12M</td>
                        </tr>
                        <tr>
                            <td class="token-cell">
                                <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28"
                                    alt="USDT"> USDT
                            </td>
                            <td>$1.00</td>
                            <td class="text-muted">0.00%</td>
                            <td>$1.01</td>
                            <td>$0.99</td>
                            <td>102.12M</td>
                        </tr>
                        <tr>
                            <td class="token-cell">
                                <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28"
                                    alt="USDT"> USDT
                            </td>
                            <td>$1.00</td>
                            <td class="text-muted">0.00%</td>
                            <td>$1.01</td>
                            <td>$0.99</td>
                            <td>102.12M</td>
                        </tr>
                        <tr>
                            <td class="token-cell">
                                <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28"
                                    alt="USDT"> USDT
                            </td>
                            <td>$1.00</td>
                            <td class="text-muted">0.00%</td>
                            <td>$1.01</td>
                            <td>$0.99</td>
                            <td>102.12M</td>
                        </tr>
                        <tr>
                            <td class="token-cell">
                                <img src="https://cryptologos.cc/logos/tether-usdt-logo.png" width="28"
                                    alt="USDT"> USDT
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
    <div class="crypto-section py-5">
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
                    <tbody id="crypto-table-body">
                        <!-- Data will be populated by JavaScript -->
                        <tr>
                            <td colspan="6" class="text-center">Loading live data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ===== Hooks Section ===== -->
    <div class="hooks-section">
        <div class="row">
            <div class="col d-flex align-items-center">
                <div class="icon-wrapper">
                    <i class="fa-solid fa-display"></i>
                </div>
                <div class="text">
                    <h2>One-click Copy Trading</h2>
                    <p>Your wealth, never alone</p>
                </div>
            </div>

            <div class="col d-flex align-items-center">
                <div class="icon-wrapper">
                    <i class="fa-solid fa-lock"></i>
                </div>
                <div class="text">
                    <h2>Secure Digital Assets</h2>
                    <p>Trade confidently with full protection</p>
                </div>
            </div>

            <div class="col d-flex align-items-center">
                <div class="icon-wrapper">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
                <div class="text">
                    <h2>Advanced Market Analytics</h2>
                    <p>Make smarter moves with precision data</p>
                </div>
            </div>

            <div class="col d-flex align-items-center">
                <div class="icon-wrapper">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div class="text">
                    <h2>24/7 Global Support</h2>
                    <p>Always here when you need us</p>
                </div>
            </div>
        </div>
    </div>


    <!-- ===== Last Section ===== -->
    <div class="last-section">
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
                    TTU Exchange offers tailored services to meet the specific needs of professional traders,
                    institutional investors and corporate customers. In addition to a full range of trading and charting
                    tools,
                    and access to comprehensive markets for all major pairs, we also offer unparalleled co-location
                    services,
                    enabling optimal, high-speed trading performance and connectivity.
                </p>
            </div>

            <!-- Third Row -->
            <div class="glass-boxes">
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

    <!-- ===== Footer Section ===== -->
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
                        <li><a href="#">Market</a></li>
                        <li><a href="#">Trade</a></li>
                        <li><a href="#">Assets</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Support</a></li>
                    </ul>
                </div>

                <!-- Company -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Company</h5>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Terms & Privacy</a></li>
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



    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>

    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        // resources/js/crypto-websocket.js

        class CryptoPriceTracker {
            constructor() {
                this.pusher = null;
                this.channel = null;
                this.initWebSocket();
            }

            initWebSocket() {
                // Connect to Laravel WebSocket server
                this.pusher = new Pusher('your-pusher-app-key', {
                    wsHost: window.location.hostname,
                    wsPort: 6001,
                    wssPort: 6001,
                    forceTLS: false,
                    enabledTransports: ['ws', 'wss'],
                    cluster: 'mt1'
                });

                this.channel = this.pusher.subscribe('crypto-prices');

                this.channel.bind('price.updated', (data) => {
                    this.updateTable(data);
                });
            }

            updateTable(cryptoData) {
                const tableBody = document.getElementById('crypto-table-body');

                if (!tableBody) return;

                let html = '';

                cryptoData.forEach(crypto => {
                    const changeClass = crypto.change_24h >= 0 ? 'text-success' : 'text-danger';
                    const changeSymbol = crypto.change_24h >= 0 ? '+' : '';

                    html += `
                <tr>
                    <td class="token-cell">
                        <img src="${crypto.icon_url}" width="28" height="28" alt="${crypto.symbol}">
                        <span class="ms-2">${crypto.symbol}</span>
                    </td>
                    <td class="price-cell">$${this.formatNumber(crypto.price)}</td>
                    <td class="${changeClass}">
                        ${changeSymbol}${crypto.change_24h.toFixed(2)}%
                    </td>
                    <td>$${this.formatNumber(crypto.high_24h)}</td>
                    <td>$${this.formatNumber(crypto.low_24h)}</td>
                    <td>${this.formatVolume(crypto.volume_24h)}</td>
                </tr>
            `;
                });

                tableBody.innerHTML = html;

                // Add animation for price changes
                this.animatePriceChanges();
            }

            formatNumber(num) {
                if (num >= 1000) {
                    return num.toLocaleString('en-US', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });
                }
                return num.toFixed(2);
            }

            formatVolume(volume) {
                if (volume >= 1000000) {
                    return (volume / 1000000).toFixed(2) + 'M';
                } else if (volume >= 1000) {
                    return (volume / 1000).toFixed(2) + 'K';
                }
                return volume.toFixed(2);
            }

            animatePriceChanges() {
                const priceCells = document.querySelectorAll('.price-cell');
                priceCells.forEach(cell => {
                    cell.style.transition = 'all 0.3s ease';
                    cell.style.backgroundColor = 'rgba(76, 175, 80, 0.1)';

                    setTimeout(() => {
                        cell.style.backgroundColor = 'transparent';
                    }, 300);
                });
            }
        }

        // Initialize when document is ready
        document.addEventListener('DOMContentLoaded', function() {
            new CryptoPriceTracker();
        });
    </script>

</body>

</html>
