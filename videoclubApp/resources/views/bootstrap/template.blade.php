<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ url('assets/img/favicon.ico') }}">
    
    <title>
        @yield('title','VideoClub App') 
    </title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    
    <link rel="stylesheet" href="{{ url('assets/css/styles.css') }}">
    @yield('styles')

    <style>
        /* Variables y base oscura */
        :root {
            --videoclub-dark: #1c1c1c; /* Fondo principal */
            --videoclub-red: #e50914; /* Rojo de acento (Netflix/Cine) */
            --videoclub-gold: #ffc300; /* Dorado/Amarillo de acento */
            --videoclub-light: #f7f7f7; /* Texto claro */
        }

        body {
            background-color: var(--videoclub-dark);
            color: var(--videoclub-light);
            min-height: 100vh; /* Para ocupar toda la pantalla */
        }

        /* Contenedor principal para un mejor look and feel */
        .container {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        /* Barra de Navegación */
        .bg-dark-custom {
            background-color: #0d0d0d !important; /* Negro aún más oscuro para el nav */
            border-bottom: 3px solid var(--videoclub-red); /* Borde de acento */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }

        .navbar-brand {
            color: var(--videoclub-red) !important;
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 1px;
            text-shadow: 0 0 5px rgba(229, 9, 20, 0.5);
        }
        
        /* Links de navegación */
        .navbar-nav .nav-link {
            color: var(--videoclub-light) !important;
            font-weight: 500;
            transition: color 0.3s, border-bottom 0.3s;
            margin: 0 5px;
            padding-bottom: 8px;
            border-bottom: 3px solid transparent;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-item.active .nav-link,
        .navbar-nav  {
             /* Usamos el Dorado/Amarillo para resaltar */
            color: var(--videoclub-gold) !important; 
            
        }

        .nav-link:hover {
            border-bottom: 3px solid var(--videoclub-gold);
        }

        /* Alertas de Mensaje */
        .alert-success {
            background-color: #2b4f3b; /* Verde oscuro */
            color: #d4edda;
            border-color: #496c56;
        }

        .alert-danger {
            background-color: #4a1515; /* Rojo oscuro */
            color: #f5c6cb;
            border-color: #721c24;
        }

        /* Títulos de sección (si usas h1, h2, etc. dentro del content) */
        h1, h2, h3, h4 {
            color: var(--videoclub-gold);
            text-transform: uppercase;
            border-bottom: 1px solid #333;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
    </style>
    
</head>

<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark-custom sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">VideoClub App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('main') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pelicula.index') }}">Películas</a>
                    </li>
                    @auth
                        @if(Auth::user()->hasVerifiedEmail())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cliente.index') }}">Clientes</a>
                            </li>
                        @endif
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('copia.index') }}">Copias</a>
                    </li>
                    @auth
                        @if(Auth::user()->hasVerifiedEmail())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('alquiler.index') }}">Alquiler</a>
                            </li>
                       @endif
                    @endauth
                    
                </ul>
                <ul class="navbar-nav  me-auto mb-2 mb-lg-0">
                    @guest
                    @else
                        @auth
                            @if(Auth::user()->hasVerifiedEmail())
                                <li>
                                    <a class="nav-link active" href="{{ route('dashboard') }}" id="profile">
                                            Dashboard
                                        </a>
                                </li>
                            @endif
                        @endauth
                    <li>
                        <a class="nav-link active" href="{{ route('home') }}" id="profile">
                                Profile
                            </a>
                    </li>
                    @endguest
                    <li class="nav-item">
                        @guest
                            <a class="nav-link active" href="{{ route('login') }}">Login</a>
                        @else
                            <a class="nav-link active" href="#" id="logout-link">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="post" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </li>

                    @guest 
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('register') }}">Register</a>
                        </li>
                    @endguest
                    
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">

        @if(session("mensajeTexto"))
            <div class="alert alert-success" role="alert">
                {{ session("mensajeTexto") }}
            </div>
        @endif

        @error('mensajeTexto')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @enderror

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
    <script src="{{ url('assets/js/main.js') }}"></script>
    @yield('scripts')
</body>

</html>