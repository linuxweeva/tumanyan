<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/design/muzei/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/design/muzei/images/favicon.ico" type="image/x-icon">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} {{ __( 'admin' ) }}</title>

    <!-- Scripts -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>
<body class="container-fluid">
    <input type="hidden" name="lang" value="{{ App::currentLocale() }}" />
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    <img src="/assets/img/logo_{{ App::currentLocale() }}.png">
                    {{ __( 'Admin Panel' ) }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @authadmin
                            <li class="nav-item">
                                <a href="{{ route( 'users.index' ) }}" class="nav-link {{ Request::is( '*users*' ) ? 'active' : '' }}">{{ __( 'Users' ) }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route( 'books.index' ) }}" class="nav-link {{ Request::is( '*books*' ) ? 'active' : '' }}">{{ __( 'Books' ) }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route( 'sections.index' ) }}" class="nav-link {{ Request::is( '*sections*' ) ? 'active' : '' }}">{{ __( 'Sections' ) }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route( 'authors.index' ) }}" class="nav-link {{ Request::is( '*authors*' ) ? 'active' : '' }}">{{ __( 'Authors' ) }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route( 'types.index' ) }}" class="nav-link {{ Request::is( '*types*' ) ? 'active' : '' }}">{{ __( 'Types' ) }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route( 'languages.index' ) }}" class="nav-link {{ Request::is( '*languages*' ) ? 'active' : '' }}">{{ __( 'Languages' ) }}</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route( 'subscriptions.index' ) }}" class="nav-link {{ Request::is( '*subscriptions*' ) ? 'active' : '' }}">{{ __( 'Subscriptions' ) }}</a>
                            </li>
                        @endauthadmin
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto flex-column">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                            </li>

                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif -->
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
        @include( 'admin.partials.footer' )
    </div>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css">
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" async type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    @yield( 'scripts_before' )
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="/assets/js/common.js"></script>
    <script type="text/javascript" src="/assets/js/admin.js"></script>
    @yield( 'scripts' )
</body>
</html>
