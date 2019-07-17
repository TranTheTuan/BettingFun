<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/jquery/jquery.min.js') }}" defer></script>
    {{--<script type="text/javascript" src="{{ asset('js/jquery/my.tablesorter.js') }}" defer></script>--}}
    <script type="text/javascript" src="{{ asset('js/jquery/jquery-ui.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/jquery/jquery.tablesorter.min.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('js/jquery/jquery.tablesorter.widgets.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mystyle.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
          integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    {{--Jquery Themes--}}
    <link href="{{ asset('css/jquery-theme/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-theme/theme.blue.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-theme/theme.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-theme/theme.black-ice.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-theme/theme.ice.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-theme/theme.dropbox.css') }}" rel="stylesheet">
    <link href="{{ asset('css/jquery-theme/theme.green.css') }}" rel="stylesheet">
</head>
<body class="bg text-white">
<div id="app">
    <nav class="navbar navbar-expand-md fixed-top navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="far fa-futbol"></i>
                {{ config('app.name') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto text-dark">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> {{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @if($user->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('matches.public') }}"><i
                                        class="far fa-list-alt"></i>{{__('messages.public')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('matches.index') }}"><i
                                        class="fas fa-list-alt"></i>{{__('messages.hidden')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('matches.create') }}"><i
                                        class="fas fa-plus"></i>{{__('messages.new_match')}}</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('betting.index') }}"><i
                                        class="fas fa-money-check"></i>{{__('messages.bet_now')}}</a>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="far fa-id-card"></i>{{ $user->username }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @if($user->role == 'user')
                                    <a class="dropdown-item" href="{{ route('profile.index', $user->id) }}">
                                        {{__('messages.profile')}}
                                    </a>
                                @endif
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 60px">
        @yield('content')
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/moment.min.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/tempusdominus-bootstrap-4.min.js') }}" defer></script>
<script type="text/javascript" src="{{ asset('js/myjs.js') }}" defer></script>
</body>
</html>
