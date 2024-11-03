<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Cyborg - Awesome HTML5 Template</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-cyborg-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <!--

    TemplateMo 579 Cyborg Gaming

    https://templatemo.com/tm-579-cyborg-gaming

    -->
    <style>
        /* Ваші стилі */
        .header-area .main-nav {
            min-height: 80px;
            background: transparent;
            display: flex;
            padding: 15px 0px;
            border-radius: 50px;
        }

        .header-area .main-nav .nav {
            display: inline-flex;
            flex-basis: 70%;
            justify-content: flex-end;
            vertical-align: middle;
            text-align: right;
            margin-top: 0px;
            margin-right: 0px;
            position: relative;
            z-index: 999;
        }

        .header-area .main-nav .nav .dropdown-menu {
            display: none; /* Сховати випадаюче меню за замовчуванням */
            position: absolute; /* Позиція випадаючого меню */
            top: 100%; /* Розмістити його під елементом */
            left: 0;
            background-color: #1f2122;; /* Білий фон для випадаючого списку */
            border-radius: 10px; /* Заокруглені кути */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15); /* Тінь для випадаючого списку */
            z-index: 1000; /* Забезпечити, щоб меню було зверху */
        }

        .header-area .main-nav .nav .dropdown-menu li {
            padding: 10px 15px; /* Внутрішні відступи для пунктів меню */
        }

        /*.header-area .main-nav .nav .dropdown-menu li a {*/
        /*    display: block; !* Зробити посилання на всю ширину *!*/
        /*    color: #666; !* Колір тексту *!*/
        /*    text-transform: capitalize; !* Перетворити текст на заголовки *!*/
        /*    font-size: 14px; !* Розмір шрифту *!*/
        /*    border-radius: 5px; !* Заокруглені кути *!*/
        /*    transition: background-color 0.3s ease; !* Анімація для фону *!*/
        /*}*/

        .header-area .main-nav .nav .dropdown-menu li a:hover {
            background-color: #e75e8d; /* Колір фону при наведенні */
            color: #fff; /* Колір тексту при наведенні */
        }

        .header-area .main-nav .nav li.has-sub:hover .dropdown-menu {
            display: block; /* Показати меню при наведенні на батьківський елемент */
        }

        /* Інші стилі вашого CSS */
    </style>
</head>

<body>

<!-- ***** Preloader Start ***** -->
<div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- ***** Preloader End ***** -->

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    <!-- ***** Logo Start ***** -->
                    <a href="/" class="logo">
                        <img src="assets/images/logo.png" alt="">
                    </a>
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Search Start ***** -->
                    <div class="search-input">
                        <form id="search" action="#">
                            <input type="text" placeholder="Type Something" id='searchText' name="searchKeyword" onkeypress="handle" />
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <!-- ***** Search End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="browse.html" class="active">Browse</a></li>
                        <li><a href="details.html">Details</a></li>
                        <li><a href="streams.html">Streams</a></li>
                        <li class="has-sub">
                            <a href="profile.html" class="profile-menu-trigger">Profile <img src="assets/images/profile-header.jpg" alt=""></a>
                            <ul class="dropdown-menu">
                                <center>
                                    @if (Route::has('login'))
                                            @auth
                                                <li>
                                                <a
                                                    href="{{ url('/dashboard') }}">
                                                    Dashboard
                                                </a>
                                                </li>
                                            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                                @csrf
                                                <li>
                                                    <button type="submit" class="btn btn-sm btn-outline-none">
                                                       <a> {{ __('Log Out') }}</a>
                                                    </button>
                                                </li>
                                            </form>
                                            @else
                                            <li>
                                                <a
                                                    href="{{ route('login') }}">
                                                    Log in
                                                </a>
                                            </li>
                                                @if (Route::has('register'))
                                                <li>
                                                    <a
                                                        href="{{ route('register') }}">
                                                        Register
                                                    </a>
                                                </li>
                                                @endif
                                            @endauth
                                    @endif
                                </center>
                            </ul>
                        </li>
                    </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ***** Header Area End ***** -->
<main>@yield('content')</main>


<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
{{--                <p>Copyright © 2036 <a href="#">Cyborg Gaming</a> Company. All rights reserved.--}}

{{--                    <br>Design: <a href="https://templatemo.com" target="_blank" title="free CSS templates">TemplateMo</a> Distributed By <a href="https://themewagon.com" target="_blank" >ThemeWagon</a>--}}
            </div>
        </div>
    </div>
</footer>

<script>
    // JavaScript для випадаючого меню
    document.querySelectorAll('.nav li.has-sub').forEach(function(item) {
        item.addEventListener('mouseenter', function() {
            this.querySelector('.dropdown-menu').style.display = 'block';
        });

        item.addEventListener('mouseleave', function() {
            this.querySelector('.dropdown-menu').style.display = 'none';
        });
    });
</script>
<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('assets/js/isotope.min.js') }}"></script>
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
<script src="{{ asset('assets/js/tabs.js') }}"></script>
<script src="{{ asset('assets/js/popup.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>

</body>

</html>

