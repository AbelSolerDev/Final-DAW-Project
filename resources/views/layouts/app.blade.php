<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Mobil-Homes') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li>
                            <a class="nav-link" href="{{ route('venta.index') }}">Venta</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('quienes-somos.index') }}">Quienes Somos</a>
                        </li>
                        <li>
                            <a class="nav-link" href="{{ route('contacto.index') }}">Contacto</a>
                        </li>
                        <li>
                            <a class="nav-link" href="#">Mi Cuenta</a> <!-- Se verá, en el caso que haga login un usuario -->
                        </li>
                        <li>
                            <a class="nav-link" href="#">Administración</a> <!-- Se verá, en el caso que haga login el administrador -->
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
            <div class="text-center" style="position: relative;">
                <img src="{{ asset('imagenes/portada/imagenPortada2Retocada.jpg') }}" class="img-fluid rounded mx-auto d-block" alt="imagenPortada" style="max-width: 70%;">
                <h1 style="position: absolute; top: 30%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 6rem;">Bienvenido</h1>
                <!--<h3 style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 3rem;">Encuentra el mejor hogar para vivir</h3>-->
            </div>
        </main>

        <footer class="footer ">
            <div class="container text-center">
                <span class="text-muted">Abel Soler Fernández © {{ date('Y') }} {{ config('app.name') }} ~ IlernaOnline</span>
            </div>
        </footer>
    </div>
</body>
</html>
