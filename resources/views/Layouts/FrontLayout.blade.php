<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo3.png') }}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
        integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <title>Nx Exchange</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    @stack('style')
    {{-- <style>
        .user-dropdown {
            position: relative;
        }

        .animate-dropdown {
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            display: none;
            min-width: 220px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            top: 47px;
        }

        .user-dropdown.show .animate-dropdown {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }


        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        .identity-btn {
            /* background: #f46523b2; */
            padding: 10px;
            border: 1px solid black;
            border-radius: 5px;
            color: #010101;
            text-decoration: none;
            transition: .4s all;
        }

        .identity-btn:hover {
            background: #ff783a;
            color: #010101;
        }

        .kyc-btn {
            display: block;
            background: #ff783a;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 600;
            color: #fff !important;
            text-align: center;
            text-decoration: none;
            transition: .3s ease;
            margin-top: 10px;
        }

        .kyc-btn:hover {
            background: #e8682f;
        }

        /* Pending */
        .kyc-badge.kyc-pending {
            display: block;
            background: #fff3cd;
            color: #856404;
            border: 1px solid #ffeeba;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
            text-align: center;
        }

        /* Verified */
        .kyc-badge.kyc-verified {
            display: block;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
            text-align: center;
        }

        .admin-btn {
            display: block;
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 600;
            margin-top: 10px;
            text-align: center;
        }

        .notif-badge {
            position: absolute;
            top: 0px;
            right: 11px;
            background: #ff3b30;
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Notification Panel Style */
        .notification-panel {
            position: absolute;
            top: 70px;
            right: 287px;
            width: 320px;
            background: rgba(255, 255, 255, 0.11);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
            display: none;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            z-index: 9999;
        }

        .notification-panel.show {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .notification-panel .title {
            font-size: 17px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #fff;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 8px;
        }

        /* Notification Item */
        .notif-item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.07);
            margin-bottom: 8px;
            cursor: pointer;
            transition: 0.2s;
        }

        .notif-item:hover {
            background: rgba(255, 255, 255, 0.16);
        }

        .notif-text p {
            margin: 0;
            color: #e9e9e9;
            font-size: 13px;
        }

        .notif-text strong {
            color: #fff;
            font-size: 14px;
        }

        .time {
            color: #ddd;
            font-size: 12px;
            white-space: nowrap;
        }

        .single-note {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all .3s ease;
        }

        .single-note:hover {
            transform: translateY(-2px);
        }

        .delete-note {
            cursor: pointer;
            padding: 6px;
            border-radius: 50%;
            transition: .3s;
            height: 0;
        }

        .delete-note:hover {
            /* background: #ffe2e2; */
            color: #f44336;
        }
    </style> --}}

    <style>
        /* MOBILE BOTTOM NAV */
        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: #010101;
            box-shadow: 0 -3px 15px rgba(0, 0, 0, 0.25);
            display: flex;
            justify-content: space-around;
            padding: 10px 0 8px 0;
            z-index: 9999;
            border-top: 2px solid #F46523;
        }

        .mobile-bottom-nav .nav-item {
            color: #fff;
            text-decoration: none;
            font-size: 12px;
            text-align: center;
            flex: 1;
            position: relative;
            transition: 0.3s;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            font-family: 'Poppins' !important;
        }

        .mobile-bottom-nav .nav-item i {
            font-size: 20px;
            display: block;
            margin-bottom: 3px;
        }

        /* ..mobile-bottom-nav .nav-item span{
              font-family: 'Poppins' !important;
        } */

        .mobile-bottom-nav .nav-item:hover {
            color: #F46523;
        }

        .mobile-bottom-nav .center-btn {
            background: #F46523;
            padding: 6px 10px;
            border-radius: 14px;
            color: #fff !important;
            margin-top: -20px;
            box-shadow: 0 5px 15px rgba(244, 101, 35, 0.5);
        }

        .mobile-bottom-nav .center-btn i {
            font-size: 22px;
        }

        /* Notification Badge in bottom nav */
        .bottom-badge {
            position: absolute;
            top: -4px;
            right: 32%;
            background: #ff2727;
            color: #fff;
            font-size: 10px;
            padding: 2px 6px;
            border-radius: 10px;
        }

        .nav-item a {
            font-family: 'Poppins' !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo3.png') }}"
                    alt="" width="80px"></a>
            <!-- MOBILE TOP ICON BAR -->
            <div class="d-flex gap-3 ms-auto d-lg-none d-md-none">

                <a href="javascript:void(0)" class="text-white text-center messages-btn" style="font-size:14px">
                    <i class="fa-solid fa-bell" style="font-size:17px"></i>

                </a>
                <a href="{{ route('share.index') }}" class="text-white text-center" style="font-size:14px">
                    <i class="fa-solid fa-share-nodes" style="font-size:17px"></i>

                </a>
                <a href="{{ route('help.index') }}" class="text-white text-center" style="font-size:14px">
                    <i class="fa-regular fa-circle-question" style="font-size:17px"></i>

                </a>
                {{-- <a href="{{ route('help.index') }}" class="nav-item">
                    <i class="fa-regular fa-circle-question"></i>

                </a> --}}
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('market.index') }}">Market</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('trade.index') }}">Trade</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('asset.index') }}">Assets</a>
                </li>
            </ul>
            @if (auth()->user())
                <ul class="navbar-nav  mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page"
                            href="{{ route('transaction.index') }}">Transaction Records</a>
                    </li>
                    <li class="nav-item position-relative">
                        <a class="nav-link active messages-btn" aria-current="page" href="javascript:void(0)">
                            Messages
                        </a>
                        @php
                            $unread = auth()->user()->notifications()->where('is_read', false)->count();
                        @endphp
                        <!-- Notification badge -->
                        @if (!empty($unread))
                            <span class="notif-badge">{{ $unread }}</span>
                        @endif

                    </li>

                    <!-- Notification Panel Wrapper -->
                    {{-- <div id="notificationPanel" class="notification-panel">
                        <h5 class="title">Notifications</h5>
                        @forelse (auth()->user()->notifications()->latest()->take(10)->get() as $notif)
                            <div class="notif-item">
                                <div class="notif-text">
                                    <strong>{{ $notif->title }}</strong>
                                    <p>{{ $notif->message }}</p>
                                </div>
                                <span class="time">{{ $notif->created_at->diffForHumans() }}</span>
                                <span class="delete-note" data-id="{{ $notif->id }}">
                                    <i class="fa-solid fa-xmark"></i>
                                </span>
                            </div>
                        @empty
                            <div id="emptyNoti" class="text-center py-4 text-muted">
                                <i class="fa-regular fa-bell-slash fs-1"></i>
                                <p>No notifications</p>
                            </div>
                        @endforelse
                    </div> --}}

                    {{-- <div id="notificationList">
                            @forelse (auth()->user()->notifications()->latest()->take(10)->get() as $note)
                                <div class="single-note d-flex justify-content-between align-items-start mb-2 p-2">
                                    <div>
                                        <strong>{{ $note->title }}</strong>
                                        <p class="m-0">{{ $note->message }}</p>
                                    </div>

                                    <span class="delete-note" data-id="{{ $note->id }}">
                                        <i class="fa-solid fa-xmark"></i>
                                    </span>
                                </div>
                            @empty
                                <div id="emptyNoti" class="text-center py-4 text-muted">
                                    <i class="fa-regular fa-bell-slash fs-1"></i>
                                    <p>No notifications</p>
                                </div>
                            @endforelse
                        </div> --}}


                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('share.index') }}">Share</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('help.index') }}">Help</a>
                    </li>

                    <li class="nav-item dropdown user-dropdown d-flex">
                        <span class="profile-icon">{{ strtoupper(substr(auth()->user()->email, 0, 1)) }}</span>
                        <a class="nav-link active dropdown-toggle" href="#" id="userDropdown" role="button">
                            {{ auth()->user()->email }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end animate-dropdown" aria-labelledby="userDropdown">
                            <div class="px-3 py-2">
                                <p><strong>ID:</strong> {{ auth()->user()->id }}</p>
                                <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
                                <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
                                @php
                                    $kyc = auth()->user()->kyc_status;
                                @endphp

                                @if ($kyc === 'pending' && auth()->user()->role !== 'admin')
                                    <span class="kyc-badge kyc-pending"> Pending Verification</span>
                                @elseif ($kyc === 'verified' && auth()->user()->role !== 'admin')
                                    <span class="kyc-badge kyc-verified">✔ Verified</span>
                                @elseif (auth()->user()->role !== 'admin')
                                    <a href="{{ route('kyc.index') }}" class="kyc-btn">Verify Your Identity</a>
                                @endif

                                <!-- Add more info as needed -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                                @if (auth()->user()->role == 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="admin-btn">Admin Panel</a>
                                @endif

                            </div>
                        </div>
                    </li>

                </ul>
            @else
                <div class="btns">
                    <a href="{{ route('login.index') }}"><button class="btn btn-primary btn1">Sign
                            In</button></a>
                    <a href="{{ route('register.index') }}"><button class="btn btn-primary btn2">Register
                            now</button></a>
                </div>
                {{-- <select name="" id="language">
                        <option value="en">English</option>
                        <option value="fr">French</option>
                        <option value="de">Duch</option>
                        <option value="de">Duch</option>
                    </select> --}}
                {{-- <select onchange="window.location.href=this.value" id="language">
                        <option value="{{ route('change.lang', 'en') }}"
                            {{ session('locale') == 'en' ? 'selected' : '' }}>English
                        </option>
                        <option value="{{ route('change.lang', 'ur') }}"
                            {{ session('locale') == 'ur' ? 'selected' : '' }}>Urdu
                        </option>
                        <option value="{{ route('change.lang', 'fr') }}"
                            {{ session('locale') == 'fr' ? 'selected' : '' }}>French
                        </option>
                        <option value="{{ route('change.lang', 'es') }}"
                            {{ session('locale') == 'es' ? 'selected' : '' }}>Spanish
                        </option>
                    </select> --}}
            @endif

        </div>
        <!-- Notification Panel Wrapper -->
        <div id="notificationPanel" class="notification-panel">
            <h5 class="title">Notifications</h5>
            @if (auth()->user())
                @forelse (auth()->user()->notifications()->latest()->take(10)->get() as $notif)
                    <div class="notif-item">
                        <div class="notif-text">
                            <strong>{{ $notif->title }}</strong>
                            <p>{{ $notif->message }}</p>
                        </div>
                        <span class="time">{{ $notif->created_at->diffForHumans() }}</span>
                        <span class="delete-note" data-id="{{ $notif->id }}">
                            <i class="fa-solid fa-xmark"></i>
                        </span>
                    </div>
                @empty
                    <div id="emptyNoti" class="text-center py-4 text-muted">
                        <i class="fa-regular fa-bell-slash fs-1"></i>
                        <p>No notifications</p>
                    </div>
                @endforelse
            @endif

        </div>
        </div>
    </nav>

    @yield('content')

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

    <!-- MOBILE BOTTOM NAV -->
    <div class="mobile-bottom-nav d-lg-none d-md-none">
        <a href="{{ route('market.index') }}" class="nav-item">
            <svg id="fi_4186586" fill="#F46523" width="22" height="22" viewBox="0 0 32 32"
                xmlns="http://www.w3.org/2000/svg" data-name="Layer 15">
                <path d="m24 2v2h2.586l-10.586 10.586-4-4-9.707 9.707 1.414 1.414 8.293-8.293 4 4 12-12v2.586h2v-6z">
                </path>
                <path d="m8.414 23h-4.828l-1.586 1.586v5.414h8v-5.414z"></path>
                <path d="m13.59 19-1.59 1.59v9.41h8v-9.41l-1.59-1.59z"></path>
                <path d="m23.59 13-1.59 1.59v15.41h8v-15.41l-1.59-1.59z"></path>
            </svg>
            <span>Market</span>
        </a>

        <a href="{{ route('trade.index') }}" class="nav-item">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="22" height="22">
                <g fill="#F46523">
                    <path
                        d="M15.05 27.44h-1.695v-3.364a1 1 0 0 0-2 0v3.364H9.66a2 2 0 0 0-2 2v24.19a2 2 0 0 0 2 2h1.695v3.37a1 1 0 0 0 2 0v-3.37h1.695a2 2 0 0 0 2-2v-24.19a2 2 0 0 0-2-2z" />
                    <path
                        d="M28.14 15.04h-1.688v-3.364a1 1 0 0 0-2 0v3.364h-1.692a2 2 0 0 0-2 2v24.19a2 2 0 0 0 2 2h1.692v3.37a1 1 0 0 0 2 0v-3.37h1.688a2 2 0 0 0 2-2v-24.19a2 2 0 0 0-2-2z" />
                    <path
                        d="M41.24 22.01h-1.692v-3.367a1 1 0 0 0-2 0v3.367h-1.688a2 2 0 0 0-2 2v24.19a2 2 0 0 0 2 2h1.688v3.366a1 1 0 0 0 2 0v-3.366h1.692a2 2 0 0 0 2-2v-24.19a2 2 0 0 0-2-2z" />
                    <path
                        d="M54.34 8.37h-1.695v-3.37a1 1 0 0 0-2 0v3.37H48.95a2 2 0 0 0-2 2v24.19a2 2 0 0 0 2 2h1.695v3.364a1 1 0 0 0 2 0v-3.364h1.695a2 2 0 0 0 2-2v-24.19a2 2 0 0 0-2-2z" />
                </g>
            </svg>
            <span>Trade</span>
        </a>

        <a href="{{ route('asset.index') }}" class="nav-item ">
           <svg height="22" fill="#F46523" viewBox="0 0 32 32" width="22" xmlns="http://www.w3.org/2000/svg" id="fi_6871722"><g id="crypto_wallet"><path d="m18 20c0 .5517578-.4487305 1-1 1h-2v-2h2c.5512695 0 1 .4482422 1 1zm-1-5h-2v2h2c.5512695 0 1-.4482422 1-1s-.4487305-1-1-1zm14-5v16c0 1.6503906-1.3500977 3-3 3h-24c-1.6499023 0-3-1.3496094-3-3v-18c0-2.7597656 2.2402344-5 5-5h18c1.2998047 0 2.4101563.8398438 2.8198242 2h-20.8198242v2h22c1.6499023 0 3 1.3496094 3 3zm-11.7802734 8c.4794922-.5322266.7802734-1.2285156.7802734-2 0-1.6542969-1.3457031-3-3-3v-1h-2v1h-3v2h1v6h-1v2h3v1h2v-1c1.6542969 0 3-1.3457031 3-3 0-.7714844-.3007812-1.4677734-.7802734-2zm7.7802734 0c0-1.1035156-.8969727-2-2-2s-2 .8964844-2 2 .8969727 2 2 2 2-.8964844 2-2z"></path></g></svg>
            <span>Assets</span>
        </a>


        <a href="{{ route('asset.index') }}" class="nav-item center-btn">
            <svg height="22" fill="#ffffff" viewBox="0 0 32 32" width="22"
                xmlns="http://www.w3.org/2000/svg" id="fi_6871722">
                <g id="crypto_wallet">
                    <path
                        d="m18 20c0 .5517578-.4487305 1-1 1h-2v-2h2c.5512695 0 1 .4482422 1 1zm-1-5h-2v2h2c.5512695 0 1-.4482422 1-1s-.4487305-1-1-1zm14-5v16c0 1.6503906-1.3500977 3-3 3h-24c-1.6499023 0-3-1.3496094-3-3v-18c0-2.7597656 2.2402344-5 5-5h18c1.2998047 0 2.4101563.8398438 2.8198242 2h-20.8198242v2h22c1.6499023 0 3 1.3496094 3 3zm-11.7802734 8c.4794922-.5322266.7802734-1.2285156.7802734-2 0-1.6542969-1.3457031-3-3-3v-1h-2v1h-3v2h1v6h-1v2h3v1h2v-1c1.6542969 0 3-1.3457031 3-3 0-.7714844-.3007812-1.4677734-.7802734-2zm7.7802734 0c0-1.1035156-.8969727-2-2-2s-2 .8964844-2 2 .8969727 2 2 2 2-.8964844 2-2z">
                    </path>
                </g>
            </svg>
            <span>Assets</span>
        </a>


        <a href="{{ route('transaction.index') }}" class="nav-item" id="mobileProfile">
            <svg clip-rule="evenodd" fill-rule="evenodd" fill="#F46523" height="22" stroke-linejoin="round"
                stroke-miterlimit="2" viewBox="0 0 32 32" width="22" xmlns="http://www.w3.org/2000/svg"
                id="fi_8377918">
                <g transform="translate(-148 -148)">
                    <g id="solid">
                        <path
                            d="m166 150.003h-10c-1.657 0-3 1.343-3 3v20.341c0 1.154.662 2.206 1.703 2.705s2.275.357 3.175-.366l.496-.398c.366-.293.886-.293 1.252 0l2.498 2.006c1.096.88 2.655.881 3.753.003l2.5-2c.365-.292.883-.293 1.248-.001l.518.413c.901.719 2.134.858 3.173.358 1.038-.5 1.698-1.551 1.698-2.703v-14.361h-6.014c-.796 0-1.559-.316-2.121-.879-.563-.562-.879-1.325-.879-2.121zm.741 21.67 2.966-2.966c.286-.286.372-.716.217-1.09-.155-.373-.52-.617-.924-.617h-10c-.552 0-1 .448-1 1s.448 1 1 1h7.586s-1.259 1.259-1.259 1.259c-.391.39-.391 1.024 0 1.414.39.391 1.024.391 1.414 0zm-5.482-11.346-2.966 2.966c-.286.286-.372.716-.217 1.09.155.373.52.617.924.617h10c.552 0 1-.448 1-1s-.448-1-1-1h-7.586s1.259-1.259 1.259-1.259c.391-.39.391-1.024 0-1.414-.39-.391-1.024-.391-1.414 0zm6.741-10.204v5.877c0 .265.105.52.293.707.187.188.442.293.707.293h5.897c-.14-.486-.402-.933-.767-1.295l-4.854-4.829c-.359-.357-.799-.614-1.276-.753z">
                        </path>
                    </g>
                </g>
            </svg>
            <span>Transactions</span>
        </a>
        <a href="{{ route('profile.index') }}" class="nav-item" id="mobileProfile">
            <svg id="fi_6543645" fill="#F46523" enable-background="new 0 0 195 195" height="22"
                viewBox="0 0 195 195" width="22" xmlns="http://www.w3.org/2000/svg">
                <g id="icon_11_">
                    <path
                        d="m120.48 158.35c-1.51.71-3.19 1.1-4.96 1.1h-82.24c-6.5 0-11.78-5.27-11.78-11.78 0-13.48 5.47-25.68 14.3-34.52s21.04-14.3 34.52-14.3h8.16c4.92 0 9.68.73 14.16 2.08l-.04.07c-1.4 2.43-1.77 5.26-1.05 7.97.73 2.71 2.47 4.98 4.9 6.38l1.12.65c-.13 1.3-.2 2.61-.2 3.92s.07 2.62.2 3.92l-1.12.65c-2.43 1.4-4.17 3.67-4.9 6.38-.72 2.71-.35 5.54 1.05 7.97l5.49 9.5c1.87 3.24 5.36 5.26 9.1 5.26 1.84 0 3.65-.49 5.25-1.41l1.12-.65c2.13 1.53 4.41 2.85 6.8 3.92v1.3c0 .54.04 1.07.12 1.59z">
                    </path>
                    <circle cx="74.4" cy="62" r="26.45"></circle>
                    <path
                        d="m172.25 131.42-5.99-3.46c.69-2.57 1.06-5.26 1.06-8.04s-.37-5.48-1.06-8.04l5.99-3.46c1.2-.69 1.61-2.22.92-3.42l-5.49-9.5c-.69-1.2-2.22-1.61-3.42-.92l-5.99 3.46c-3.8-3.8-8.58-6.62-13.93-8.05v-6.91c0-1.38-1.12-2.5-2.5-2.5h-10.97c-1.38 0-2.5 1.12-2.5 2.5v6.91c-5.35 1.42-10.13 4.24-13.93 8.05l-5.99-3.46c-1.2-.69-2.73-.28-3.42.92l-5.49 9.5c-.69 1.2-.28 2.73.92 3.42l5.99 3.46c-.69 2.57-1.06 5.26-1.06 8.04s.37 5.48 1.06 8.04l-5.99 3.46c-1.2.69-1.61 2.22-.92 3.42l5.49 9.5c.69 1.2 2.22 1.61 3.42.92l5.99-3.46c3.8 3.8 8.58 6.62 13.93 8.05v6.91c0 1.38 1.12 2.5 2.5 2.5h10.97c1.38 0 2.5-1.12 2.5-2.5v-6.91c5.35-1.42 10.13-4.24 13.93-8.05l5.99 3.46c1.2.69 2.73.28 3.42-.92l5.49-9.5c.69-1.2.28-2.73-.92-3.42zm-35.9 1.13c-6.98 0-12.63-5.66-12.63-12.63 0-6.98 5.66-12.63 12.63-12.63s12.63 5.66 12.63 12.63-5.65 12.63-12.63 12.63z">
                    </path>
                </g>
            </svg>
            <span>Account</span>
        </a>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdownToggle = document.getElementById('userDropdown');
            const dropdownMenu = dropdownToggle.nextElementSibling;

            dropdownToggle.addEventListener('click', function(e) {
                e.preventDefault();
                dropdownToggle.parentElement.classList.toggle('show');
            });

            // Click outside to close
            document.addEventListener('click', function(e) {
                if (!dropdownToggle.parentElement.contains(e.target)) {
                    dropdownToggle.parentElement.classList.remove('show');
                }
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>

    <script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.8.5/dist/dotlottie-wc.js" type="module"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif
    </script>
    <script>
        const messagesBtn = document.querySelector('.messages-btn');
        const panel = document.getElementById('notificationPanel');

        messagesBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            panel.classList.toggle('show');

            // Panel kholne par notifications refresh karen
            if (panel.classList.contains('show')) {
                loadNotifications();
            }
        });
        // Close only when clicking outside
        document.addEventListener('click', function(e) {
            if (!panel.contains(e.target) && !e.target.closest('.messages-btn')) {
                panel.classList.remove('show');
            }
        });

        // Real-time notifications load karne ka function
        function loadNotifications() {
            $.get('/user/notifications/latest', function(response) {
                updateNotificationPanel(response.notifications);
                updateNotificationBadge(response.unread_count);
            });
        }

        // Notification panel update kare
        function updateNotificationPanel(notifications) {
            if (notifications.length === 0) {
                panel.innerHTML = `
            <h5 class="title">Notifications</h5>
            <div id="emptyNoti" class="text-center py-4 text-muted">
                <i class="fa-regular fa-bell-slash fs-1"></i>
                <p>No notifications</p>
            </div>
        `;
                return;
            }

            let notificationsHtml = '<h5 class="title">Notifications</h5>';

            notifications.forEach(notif => {
                const typeClass = `text-${notif.type}`;
                const icon = getNotificationIcon(notif.type);

                notificationsHtml += `
            <div class="notif-item ${notif.is_read ? '' : 'unread'}">
                <div class="notif-text">
                    <strong class="${typeClass}">
                        <i class="fa-solid ${icon} me-1"></i>${notif.title}
                    </strong>
                    <p>${notif.message}</p>
                </div>
                <span class="time">${notif.time_ago}</span>
                <span class="delete-note" data-id="${notif.id}">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </div>
        `;
            });

            panel.innerHTML = notificationsHtml;
        }

        function getNotificationIcon(type) {
            const icons = {
                'success': 'fa-trophy',
                'danger': 'fa-exclamation-triangle',
                'warning': 'fa-clock',
                'info': 'fa-info-circle'
            };
            return icons[type] || 'fa-bell';
        }

        // Notification badge update kare
        function updateNotificationBadge(count) {
            let badge = $('.notif-badge');

            if (count > 0) {
                if (badge.length === 0) {
                    $('.messages-btn').append(`<span class="notif-badge">${count}</span>`);
                } else {
                    badge.text(count);
                }
            } else {
                badge.remove();
            }
        }

        // Delete notification (Aapka existing code)
        $(document).on('click', '.delete-note', function(e) {
            e.stopPropagation();

            let id = $(this).data('id');
            let noteBox = $(this).closest('.notif-item');

            $.ajax({
                url: "/notification/" + id,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.success) {
                        noteBox.fadeOut(300, function() {
                            $(this).remove();
                            loadNotifications(); // Refresh notifications
                        });
                    }
                }
            });
        });

        // Auto-refresh notifications every 30 seconds
        setInterval(function() {
            // Badge count hamesha update kare
            $.get('/user/notifications/count', function(response) {
                updateNotificationBadge(response.unread_count);
            });

            // Agar panel open hai toh notifications refresh kare
            if (panel.classList.contains('show')) {
                loadNotifications();
            }
        }, 30000);

        // Initial load
        $(document).ready(function() {
            $.get('/user/notifications/count', function(response) {
                updateNotificationBadge(response.unread_count);
            });
        });
    </script>

    {{-- <script>
        const messagesBtn = document.querySelector('.messages-btn');
        const panel = document.getElementById('notificationPanel');

        messagesBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            panel.classList.toggle('show');

            // Panel kholne par notifications refresh karen
            if (panel.classList.contains('show')) {
                loadNotifications();
            }
        });

        // Click outside → hide panel
        document.addEventListener('click', function() {
            panel.classList.remove('show');
        });

        // Real-time notifications load karne ka function
        function loadNotifications() {
            $.get('/user/notifications', function(response) {
                updateNotificationPanel(response.notifications);
                updateNotificationBadge(response.unread_count);
            });
        }

        // Notification panel update kare
        function updateNotificationPanel(notifications) {
            if (notifications.length === 0) {
                panel.innerHTML = `
            <h5 class="title">Notifications</h5>
            <div id="emptyNoti" class="text-center py-4 text-muted">
                <i class="fa-regular fa-bell-slash fs-1"></i>
                <p>No notifications</p>
            </div>
        `;
                return;
            }

            let notificationsHtml = '<h5 class="title">Notifications</h5>';

            notifications.forEach(notif => {
                const icon = notif.type === 'trade_win' ? 'fa-trophy' : 'fa-info-circle';
                const textClass = notif.type === 'trade_win' ? 'text-success' : 'text-warning';

                notificationsHtml += `
            <div class="notif-item ${notif.is_read ? '' : 'unread'}">
                <div class="notif-text">
                    <strong class="${textClass}">
                        <i class="fa-solid ${icon} me-1"></i>${notif.title}
                    </strong>
                    <p>${notif.message}</p>
                </div>
                <span class="time">${notif.created_at}</span>
                <span class="delete-note" data-id="${notif.id}">
                    <i class="fa-solid fa-xmark"></i>
                </span>
            </div>
        `;
            });

            panel.innerHTML = notificationsHtml;
        }

        // Notification badge update kare
        function updateNotificationBadge(count) {
            let badge = $('.notif-badge');

            if (count > 0) {
                if (badge.length === 0) {
                    // Agar badge nahi hai toh naya banaye
                    $('.messages-btn').append(`<span class="notif-badge">${count}</span>`);
                } else {
                    badge.text(count);
                }
            } else {
                badge.remove();
            }
        }

        // Delete notification (Aapka existing code - perfect hai)
        $(document).on('click', '.delete-note', function(e) {
            e.stopPropagation(); // Panel band hone se bachaye

            let id = $(this).data('id');
            let noteBox = $(this).closest('.notif-item');

            $.ajax({
                url: "/notification/" + id,
                type: "DELETE",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                    if (res.success) {
                        noteBox.fadeOut(300, function() {
                            $(this).remove();

                            // Badge count update
                            let badge = $('.notif-badge');
                            if (badge.length) {
                                let count = parseInt(badge.text()) - 1;
                                if (count > 0) {
                                    badge.text(count);
                                } else {
                                    badge.remove();
                                }
                            }

                            // Empty message show kare
                            if ($('#notificationPanel .notif-item').length === 0) {
                                $('#notificationPanel').html(`
                            <h5 class="title">Notifications</h5>
                            <div id="emptyNoti" class="text-center py-4 text-muted">
                                <i class="fa-regular fa-bell-slash fs-1"></i>
                                <p>No notifications</p>
                            </div>
                        `);
                            }
                        });
                    }
                }
            });
        });

        // Auto-refresh notifications every 30 seconds
        setInterval(function() {
            if (panel.classList.contains('show')) {
                loadNotifications();
            }

            // Badge count hamesha update kare
            $.get('/user/notifications/count', function(response) {
                updateNotificationBadge(response.unread_count);
            });
        }, 30000);

        // Initial load
        $(document).ready(function() {
            // Sirf badge count load kare
            $.get('/user/notifications/count', function(response) {
                updateNotificationBadge(response.unread_count);
            });
        });
    </script> --}}

    @stack('scripts')

</body>

</html>
