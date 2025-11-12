<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
            padding: 78px 89px;
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
            <a class="navbar-brand" href="#">NxExchange</a>
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
        <div class="graphic col d-flex justify-content-center align-items-center">
            <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_rzdxlrm6.json" background="transparent"
                speed="1" style="width: 420px; height: 420px;" loop autoplay>
            </lottie-player>    
        </div>


        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>


</body>

</html>