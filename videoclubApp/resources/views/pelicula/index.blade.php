@extends('bootstrap.template')

@section('title')
Catálogo de Películas
@endsection

@section('styles')
<link rel="stylesheet" href="https://www.google.com/search?q=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40B7iMtyqQgS/l/e1Mh/QdJ0bN4FwV2Z8aP2E1gI1r0Z9GzR5eP+K7vK3hN+FfGjE1g/l+l+p3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="stylesheet" href="{{ url('assets/css/pelicula/indexStyle.css') }}">

@endsection

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <h2 style="color: #ffc300; font-weight: 700;">Catálogo de Películas ({{ $peliculas->count() }})</h2>
    <!-- Botón para añadir nueva película -->
        @auth
            @if(Auth::user()->hasVerifiedEmail())
                <a href="{{ route('pelicula.create') }}" class="btn btn-primary" style="background-color: #e50914; border-color: #e50914; font-weight: 600;">
                    <i class="fas fa-plus-circle"></i> Añadir Película
                </a>
            @endif
        @endauth
    </div>

@if($peliculas->isEmpty())

<!-- Mensaje para cuando el catálogo está vacío -->

<div class="alert alert-warning text-center">
    <p class="mb-0">Aún no hay películas en el catálogo. ¡Sé el primero en añadir una!</p>
</div>


@else

<!-- INICIO: Estructura de la cuadrícula -->

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

    @foreach($peliculas as $pelicula)
        <div class="col">
        <!-- Tarjeta de Póster -->
            <div class="card h-100 poster-card shadow-lg">
                <div class="poster-image-container">
                    <img src="{{ $pelicula->getPath() }}" class="poster-image" alt="">
                </div>
                    
                <div class="card-body text-center d-flex flex-column">
                    <h5 class="card-title mb-1">
                        {{ $pelicula->titulo }}
                    </h5>
                    <p class="card-text mb-3">
                        Director: {{ $pelicula->director }}
                    </p>
                        <div class="mt-auto d-grid gap-2">
                            <a href="{{ route('pelicula.show', $pelicula->id) }}" class="btn btn-sm btn-outline-accent">
                                Ver Detalle
                            </a>
                            @auth
                                @if(Auth::user()->hasVerifiedEmail())
                            <a href="{{ route('pelicula.edit', $pelicula->id) }}" class="btn btn-sm btn-outline-danger-custom">
                                Editar
                            </a>
                                   @endif
                            @endauth
                        </div>
                </div>
            </div> 
        </div> 
    @endforeach
</div>


@endif
@endsection