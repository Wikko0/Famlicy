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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="{{asset('css/style.css')}}" />

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1GS1WFQ97M"></script>
    <script>
            window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-1GS1WFQ97M');
    </script>
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KHGXNV9W');</script>
</head>
<body>
<!-- ~~~~~~~~~~~~~~~~ GOOGLE ~~~~~~~~~~~~~~ -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KHGXNV9W"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- ~~~~~~~~~~~~~~~~ NAVBAR-SECTION ~~~~~~~~~~~~~~ -->

<section class="navbar-section">
    <div class="container">
        <a href="{{route('home')}}" class="logo">
            <img src="{{asset('images/fam-logo.png')}}" alt="">
            <span class="logo-text">Famlicy</span>
        </a>
        @if(Auth::user())
            <div class="user-details">
                <div class="notification-icon">

                    <svg
                        width="24"
                        height="25"
                        viewBox="0 0 24 25"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="notification-svg"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        <g clip-path="url(#clip0_2226_702)">
                            <path
                                d="M21.3946 17.4131C19.8827 16.135 19.0157 14.267 19.0157 12.288V9.5C19.0157 5.98108 16.4017 3.06805 13.0157 2.58008V1.49994C13.0157 0.94696 12.5676 0.5 12.0156 0.5C11.4637 0.5 11.0156 0.94696 11.0156 1.49994V2.58008C7.62854 3.06805 5.01562 5.98108 5.01562 9.5V12.288C5.01562 14.267 4.14862 16.135 2.62756 17.421C2.23865 17.754 2.01562 18.238 2.01562 18.7499C2.01562 19.7151 2.8006 20.5001 3.76556 20.5001H20.2656C21.2307 20.5001 22.0157 19.7151 22.0157 18.7499C22.0157 18.238 21.7927 17.754 21.3946 17.4131Z"
                                fill="#D2AE33"
                            />
                            <path
                                d="M12.0158 24.5C13.8269 24.5 15.3419 23.2089 15.6898 21.5H8.3418C8.68988 23.2089 10.2049 24.5 12.0158 24.5Z"
                                fill="#D2AE33"
                            />
                        </g>
                        <defs>
                            <clipPath id="clip0_2226_702">
                                <rect
                                    width="24"
                                    height="24"
                                    fill="white"
                                    transform="translate(0 0.5)"
                                />
                            </clipPath>
                        </defs>
                    </svg>

                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="notification-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                    @endif


                    <div class="dropdown-menu" id="notification-dropdown">
                        <div class="notification-header">
                            Notifications
                        </div>
                        <div class="notification-list">
                            @php
                                $allNotifications = auth()->user()->notifications;
                                $unreadNotifications = $allNotifications->filter(fn($n) => !$n->read());
                                $readNotifications = $allNotifications->filter(fn($n) => $n->read());

                                $unreadCount = $unreadNotifications->count();
                                $additionalReadCount = max(0, 5 - $unreadCount);
                                $readToShow = $readNotifications->take($additionalReadCount);

                                $notificationsToShow = $unreadNotifications->merge($readToShow);
                            @endphp

                            @foreach($notificationsToShow as $notification)
                                <div class="notification-item @if(!$notification->read()) unread @endif">
                                    <p>{{ $notification->data['message'] }}</p>
                                    <a href="{{ route('notifications.read', $notification->id) }}" class="btn accept-btn">Read</a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <a href="/chatify">
                    <div class="notification-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25" viewBox="0 0 50 50" fill="#D2AE33" class="notification-svg">
                            <path d="M 25 2 C 12.300781 2 2 11.601563 2 23.5 C 2 29.800781 4.898438 35.699219 10 39.800781 L 10 48.601563 L 18.601563 44.101563 C 20.699219 44.699219 22.800781 44.898438 25 44.898438 C 37.699219 44.898438 48 35.300781 48 23.398438 C 48 11.601563 37.699219 2 25 2 Z M 27.300781 30.601563 L 21.5 24.398438 L 10.699219 30.5 L 22.699219 17.800781 L 28.601563 23.699219 L 39.101563 17.800781 Z"></path>
                        </svg>

                    </div>
                </a>


                <div class="user-img" onclick="toggleMenu()">
                    <img src="{{asset('images/users/user-'. Auth::user()->id) . '.jpg'}}" alt="User Image" />
                </div>
                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="{{route('profile', Auth::user()->username)}}" class="menu-item">
                        <img src="{{asset('images/users/user-'. Auth::user()->id) . '.jpg'}}" alt="User Image" />
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    <a href="{{route('information')}}" class="menu-item">
                        <img src="{{asset('images/user-information-icon.png')}}" alt="Information Icon" />
                        <span>User Information</span>
                    </a>
                    <a href="{{route('community')}}" class="menu-item">
                        <img src="{{asset('images/community-icon.png')}}" alt="Community Icon" />
                        <span>Create Community</span>
                    </a>
                    <a href="{{route('family.register', Auth::user()->username)}}" class="menu-item">
                        <img src="{{asset('images/family-member-icon.png')}}" alt="Family Create Icon" />
                        <span>Create Family Member Account</span>
                    </a>
                    <a href="{{route('logout')}}" class="menu-item">
                        <img src="{{asset('images/exit-icon.png')}}" alt="Exit Icon" />
                        <span>Exit</span>
                    </a>
                </div>
            </div>
        @elseif(Request::is('register'))
            <div class="btn-sec">
                Already on Famlacy?
                <button class="loginBtn" onclick="window.location.href='{{route('login')}}';">login</button>
            </div>
        @else
            <div class="btn-sec">
                <button class="registerBtn" onclick="window.location.href='{{route('register')}}';">register</button>
                <button class="loginBtn" onclick="window.location.href='{{route('login')}}';">login</button>
            </div
        @endif

    </div>
</section>
<div class="border-part"></div>

@yield('content')

<!-- ~~~~~~~~~~~~~~~~ FOOTER-SECTION ~~~~~~~~~~~~~~ -->
@include('ads.ad-container-970')
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
                <a href="{{route('login')}}">Login Page</a>
                <a href="{{route('register')}}">Register</a>
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
<script src="{{asset('js/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
