<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Bootstrap Core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="/vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/stylish-portfolio.min.css" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <div id="app">

  <!-- Navigation -->
        <a class="menu-toggle rounded" href="#">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar-wrapper">
            <ul class="sidebar-nav">
            <li class="sidebar-brand">
                <a class="js-scroll-trigger" href="{{route('index')}}">Home</a>
            </li>
            <li class="sidebar-nav-item">
                <a class="js-scroll-trigger" href="{{route('breweries')}}">Breweries</a>
            </li>
            <li class="sidebar-nav-item">
                <a class="js-scroll-trigger" href="{{route('about')}}">About us</a>
            </li>
            <li class="sidebar-nav-item">
                <a class="js-scroll-trigger" href="{{route('team')}}">Team</a>
            </li>
            <!-- Authentication Links -->
            @guest
                <li class="sidebar-nav-item">
                    <a href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="sidebar-nav-item">
                        <a href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="sidebar-nav-item">
                    <a href="#">{{ Auth::user()->name }}</a>
                </li>

                <li class="sidebar-nav-item dropdown">

                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
            </ul>
        </nav>

        <main>
            @yield('content')
        </main>


        <!-- Footer -->
        <footer class="footer text-center">
            <div class="container">
            <ul class="list-inline mb-5">
                <li class="list-inline-item">
                <a class="social-link rounded-circle text-white mr-3" href="#!">
                    <i class="icon-social-facebook"></i>
                </a>
                </li>
                <li class="list-inline-item">
                <a class="social-link rounded-circle text-white mr-3" href="#!">
                    <i class="icon-social-twitter"></i>
                </a>
                </li>
                <li class="list-inline-item">
                <a class="social-link rounded-circle text-white" href="#!">
                    <i class="icon-social-github"></i>
                </a>
                </li>
            </ul>
            <p class="text-muted small mb-0">Copyright &copy; Your Website 2020</p>
            </div>
        </footer>
    </div>
    
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
    <i class="fas fa-angle-up"></i>
    </a>

    
    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="/js/stylish-portfolio.min.js"></script>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
    
    @stack('scripts')
    
</body>
</html>
