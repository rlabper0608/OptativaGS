@extends('bootstrap.template')

@section('title')
VideoClub Dashboard Principal
@endsection

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/main/mainStyle.css') }}">

<link rel="stylesheet" href="https://www.google.com/search?q=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40B7iMtyqQgS/l/e1Mh/QdJ0bN4FwV2Z8aP2E1gI1r0Z9GzR5eP+K7vK3hN+FfGjE1g/l+l+p3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

<h1 class="text-center mb-5" style="color: #ffc300; text-transform: uppercase;">Bienvenido al Panel de Gestión del VideoClub</h1>

<div class="dashboard-grid">

<!-- 1. Gestión de Películas -->
<a href="{{ route('pelicula.index') }}" class="dashboard-card theme-pelicula">
    <i class="fas fa-film"></i>
    <h3>Catálogo de Películas</h3>
    <p class="mt-2">Administrar títulos, directores y portadas.</p>
</a>

@auth
    @if(Auth::user()->hasVerifiedEmail())
        <!-- 2. Gestión de Clientes -->
        <a href="{{ route('cliente.index') }}" class="dashboard-card theme-cliente">
            <i class="fas fa-users"></i>
            <h3>Base de Datos de Clientes</h3>
            <p class="mt-2">Gestionar perfiles, contactos y datos de clientes.</p>
        </a>
    @endif
@endauth

<!-- 3. Gestión de Copias -->
<a href="{{ route('copia.index') }}" class="dashboard-card theme-copia">
    <i class="fas fa-barcode"></i>
    <h3>Inventario y Copias</h3>
    <p class="mt-2">Control de stock, códigos de barras y formatos (DVD, Bluray, etc.).</p>
</a>

@auth
    @if(Auth::user()->hasVerifiedEmail())
        <!-- 4. Gestión de Alquileres -->
        <a href="{{ route('alquiler.index') }}" class="dashboard-card theme-alquiler">
            <i class="fas fa-handshake"></i>
            <h3>Registros de Alquiler</h3>
            <p class="mt-2">Rastrear transacciones, fechas de salida y devolución.</p>
        </a>
    @endif
@endauth

<!-- Enlace a la sección "Acerca de" si la tienes -->
<a href="{{ route('about') }}" class="dashboard-card theme-cliente" style="opacity: 0.7;">
    <i class="fas fa-info-circle"></i>
    <h3>Acerca de / Info</h3>
    <p class="mt-2">Información de la aplicación.</p>
</a>


</div>

@endsection