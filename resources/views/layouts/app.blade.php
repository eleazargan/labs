<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lab Attendance System - @yield('page_name')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    @yield('custom_css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="border-bottom: 4px solid #bd8b3b;">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img style="max-height:40px; margin-top: -7px;" src="{{ asset('image/UTP-logo.png') }}">
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse" style="border: none;">
                                   <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest

                        @else
                            <li class="@if($page == "home") active @endif">
                                <a href="/">Home</a>
                            </li>
                            @role('admin')
                            <li class="@if($page == "lab") active @endif">
                                <a href="{{ action('GraduateAssistantController@lab') }}">Lab Slot</a>
                            </li>
                            <li class="@if($page == "register") active @endif">
                                <a href="{{ action('StudentController@registerLab') }}">Register</a>
                            </li>
                            @endrole

                            @role('ga')
                            <li class="@if($page == "lab") active @endif">
                                <a href="{{ action('GraduateAssistantController@lab') }}">Lab Slot</a>
                            </li>
                            @endrole

                            @role('student')
                            <li class="@if($page == "register") active @endif">
                                <a href="{{ action('StudentController@registerLab') }}">Register</a>
                            </li>
                            @endrole
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('custom_js')
</body>
</html>
