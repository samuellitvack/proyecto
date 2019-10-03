<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Aulasoft') }}</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                <b>
                    {{ config('app.name', 'Aulasoft Web') }}
                </b>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->

                    @guest 
                    <ul class="navbar-nav mr-auto">
                            <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="{{ url('boletin') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-search"></i><span class="caret">{{ __('Consultar') }}</span></a>
                    </ul>
                    @endguest

                    @auth
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="{{ url('alumnos/gestion') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre><span class="caret"><i class="fa fa-user"></i></span> {{ __('Alumnos') }}</a>
                            </li>

                            <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="{{ url('cursos/gestion') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-book"></i> {{ __('Cursos') }}<span class="caret"></span></a>
                            </li>

                            <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="{{ url('materias/gestion') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-tags"></i> {{ __('Materias') }}<span class="caret"></span></a>
                            </li>

                            <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="{{ url('preceptores/gestion') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-user-circle"></i></span> {{ __('Preceptores') }}<span class="caret"></span></a>
                            </li>

                            <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="{{ url('profesores/gestion') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-user-circle-o"></i></span> {{ __('Profesores') }}<span class="caret"></span></a>
                            </li>

                            <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="{{ url('boletin') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-search"></i><span class="caret">{{ __('Consultar') }}</span></a>
                            </li>

                            <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="{{ url('configuracion') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-gear"></i></span> {{ __('Configuración') }}<span class="caret"></span></a>
                            </li>

                            <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link" href="{{ url('usuarios') }}" role="button" aria-haspopup="true" aria-expanded="false" v-pre><i class="fa fa-user-o"></i></span> {{ __('Usuarios') }}<span class="caret"></span></a>
                            </li>
                    </ul>
                    @endauth

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Ingresar') }}</a>
                            </li>
                        @endguest
                        @auth
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
<script src="{{ asset('js/app.js') }}"></script>   
<script src="https://cdn.jsdelivr.net/npm/jquery-tabledit@1.0.0/jquery.tabledit.min.js"></script>
</body>
</html>
