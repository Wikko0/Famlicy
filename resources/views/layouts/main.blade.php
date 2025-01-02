<!DOCTYPE html>
<html lang="en">
<head>
    <title>Famlicy</title>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css"
    />

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="{{asset('css/style.css')}}" />
</head>
<body>
<!-- ~~~~~~~~~~~~~~~~ NAVBAR-SECTION ~~~~~~~~~~~~~~ -->

<section class="navbar-section">
    <div class="container">
        <a href="{{route('home')}}" class="logo">
            <img src="{{asset('images/fam-logo.png')}}" alt="">
            <span class="logo-text">Famlicy</span>
        </a>
        <div class="btn-sec">
            <button class="registerBtn" onclick="window.location.href='{{route('register')}}';">register</button>
            <button class="loginBtn" onclick="window.location.href='{{route('login')}}';">login</button>
        </div>
    </div>
</section>
<div class="border-part"></div>

@yield('content')

<!-- ~~~~~~~~~~~~~~~~ FOOTER-SECTION ~~~~~~~~~~~~~~ -->

<section class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6">
                <a href="#" class="logo">
                    <img src="{{asset('images/fam-logo.png')}}" alt="">
                    <span class="logo-text">Famlicy</span>
                </a>
                <div class="desc">
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ipsam,
                    asperiores!
                </div>
                <div class="tele">
                    <div class="icon-tele"><i class="ri-phone-line"></i></div>
                    <a href="">+1234567890</a>
                </div>
                <div class="mail">
                    <div class="icon-mail"><i class="ri-mail-line"></i></div>
                    <a href="">info@famlicy.com</a>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 info">
                <div class="title">Information</div>
                <a href="">Help Center</a>
                <a href="">Payment Methods</a>
                <a href="">Return & Refund</a>
                <a href="">Privacy Policy</a>
            </div>
            <div class="col-lg-2 col-md-3 follow">
                <div class="title">Follow Us</div>
                <div class="icon">
                    <div class="item"><i class="ri-facebook-circle-fill"></i></div>
                    <div class="item"><i class="ri-instagram-line"></i></div>
                    <div class="item"><i class="ri-twitter-fill"></i></div>
                    <div class="item"><i class="ri-linkedin-fill"></i></div>
                </div>
            </div>
        </div>
    </div>
</section>

@yield('scripts')

</body>
</html>
