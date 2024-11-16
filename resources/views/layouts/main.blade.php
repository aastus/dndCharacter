<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>DnD Character Constructor</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/templatemo-cyborg-gaming.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

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

        .header-area .main-nav .nav .dropdown-menu li a:hover {
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
                    <div class="search-input">
                        <form id="search" method="GET" action="/search">
                            <input type="text" placeholder="Type Something" name="query" id="searchInput" />
                            <i class="fa fa-search"></i>

                            <div id="searchResults" class="search-results"></div>
                            <input type="hidden" id="requestType" name="requestType" value="api">
                        </form>
                    </div>

                    <ul class="nav">
                        <li><a href="{{route('alignments')}}" class="{{ Route::currentRouteName() == 'alignments' ? 'active' : '' }}">{{ __('Alignments') }}</a></li>
                        <li><a href="{{route('backgrounds')}}" class="{{ Route::currentRouteName() == 'backgrounds' ? 'active' : '' }}">{{ __('Background') }}</a></li>
                        <li><a href="{{route('weapons')}}" class="{{ Route::currentRouteName() == 'weapons' ? 'active' : '' }}">{{ __('Weapons') }}</a></li>
                        <li><a href="{{route('spells')}}" class="{{ Route::currentRouteName() == 'spells' ? 'active' : '' }}">{{ __('Spells') }}</a></li>
                        <li><a href="{{route('abilities')}}" class="{{ Route::currentRouteName() == 'abilities' ? 'active' : '' }}">{{ __('Abilities') }}</a></li>
                        @if (app()->getLocale() === 'en')
                            <li><a href="{{ route('change-locale', 'uk') }}">UK</a></li>
                        @else
                            <li><a href="{{ route('change-locale', 'en') }}">EN</a></li>
                        @endif
                        <li class="has-sub mt-1">
                            <a class="profile-menu-trigger">{{ __('Profile') }}</a>
                            <ul class="dropdown-menu">
                                <center>
                                    @if (Route::has('login'))
                                            @auth
                                                <li>
                                                <a
                                                    href="{{ url('/admin/characters') }}">
                                                    {{ __('Dashboard') }}
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
                <p>Copyright © 2036 <a href="#">Cyborg Gaming</a> Company. All rights reserved.

                    <br>Design: <a href="https://templatemo.com" target="_blank" title="free CSS templates">TemplateMo</a> Distributed By <a href="https://themewagon.com" target="_blank" >ThemeWagon</a>
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
<script src="{{ asset('assets/js/owl-carousel.js') }}"></script>
<script src="{{ asset('assets/js/tabs.js') }}"></script>
<script src="{{ asset('assets/js/popup.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
        let table = new DataTable('#myTable');

        const searchInput = document.getElementById('searchInput');
        const searchResults = document.getElementById('searchResults');

        searchInput.addEventListener('input', function () {
            const query = this.value.trim();

            if (query.length > 0) {
                fetchResults(query);
            } else {
                searchResults.innerHTML = '<div class="no-results">Start typing to search...</div>';
                searchResults.style.display = 'block';
            }
        });

        document.addEventListener('click', (event) => {
            const isClickInside = searchInput.contains(event.target) || searchResults.contains(event.target);

            if (!isClickInside) {
                searchResults.style.display = 'none';
            } else {
                searchResults.style.display = 'block';
            }
        });

        searchInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                const query = searchInput.value.trim();
                if (query.length > 0) {
                    document.getElementById('search').submit();
                }
            }
        });

        searchInput.addEventListener('focus', () => {
            searchResults.style.display = 'block';
        });

        function fetchResults(query) {
            fetch(`/search?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = '';
                    const categories = {};

                    data.forEach(result => {
                        const type = result.type;
                        if (!categories[type]) {
                            categories[type] = [];
                        }
                        categories[type].push(result);
                    });

                    for (const [type, results] of Object.entries(categories)) {
                        const categoryTitle = document.createElement('div');
                        categoryTitle.classList.add('search-category-title');
                        categoryTitle.textContent = type.charAt(0).toUpperCase() + type.slice(1);
                        searchResults.appendChild(categoryTitle);

                        results.forEach(item => {
                            const resultItem = document.createElement('div');
                            resultItem.classList.add('search-result-item');
                            resultItem.innerHTML = `<a href="${item.url}">${item.title}</a>`;

                            resultItem.addEventListener('mousedown', () => {
                                window.location.href = item.url;
                            });

                            searchResults.appendChild(resultItem);
                        });
                    }

                    if (Object.keys(categories).length === 0) {
                        searchResults.innerHTML = '<div class="no-results">No results found</div>';
                    }

                    searchResults.style.display = 'block';
                })
                .catch(error => console.error('Error fetching search results:', error));
        }

</script>
</body>

</html>

