@extends('bootstrap.template')

@section('title')
Acerca de VideoClub App
@endsection

@section('content')

<div class="row justify-content-center">
<div class="col-lg-10 col-xl-8">

    <h1 class="text-center mb-5" style="color: var(--vc-focus, #ffc300); text-transform: uppercase; border-bottom: 2px solid var(--vc-red, #e50914); padding-bottom: 10px;">
        Acerca del VideoClub App
    </h1>

    <div class="card p-4 p-md-5 shadow-lg" style="background-color: var(--vc-dark-card, #1c1c1c); border: 1px solid var(--vc-dark-gray, #444);">
        
        <h3 class="mb-4" style="color: var(--vc-red, #e50914);">Propósito de la Aplicación</h3>
        <p style="color: var(--vc-light, #f7f7f7); font-size: 1.1rem; line-height: 1.6;">
            Esta aplicación es un sistema de gestión integral diseñado para administrar todos los aspectos de un videoclub moderno. Facilita el seguimiento de inventario, la gestión de la base de datos de clientes y el registro preciso de las transacciones de alquiler.
        </p>

        <hr style="border-color: var(--vc-dark-gray, #444); margin: 30px 0;">

        <h3 class="mb-4" style="color: var(--vc-red, #e50914);">Módulos Principales</h3>
        <ul class="list-unstyled" style="color: var(--vc-light, #f7f7f7);">
            <li class="mb-2"><i class="fas fa-film" style="color: var(--vc-focus, #ffc300);"></i> &nbsp; <strong>Catálogo de Películas:</strong> CRUD completo de títulos, directores y clasificación.</li>
            <li class="mb-2"><i class="fas fa-users" style="color: var(--client-blue-primary, #3b82f6);"></i> &nbsp; <strong>Clientes:</strong> Gestión de perfiles y datos de contacto.</li>
            <li class="mb-2"><i class="fas fa-barcode" style="color: var(--copy-accent, #ffe400);"></i> &nbsp; <strong>Copias:</strong> Inventario físico y digital (códigos de barras, estado y formato).</li>
            <li class="mb-2"><i class="fas fa-handshake" style="color: var(--rent-accent, #ff8c00);"></i> &nbsp; <strong>Alquileres:</strong> Registro de transacciones, fechas de salida y devolución.</li>
        </ul>

        <hr style="border-color: var(--vc-dark-gray, #444); margin: 30px 0;">

        <h3 class="mb-4" style="color: var(--vc-red, #e50914);">Tecnología Utilizada</h3>
        <p style="color: var(--vc-light, #f7f7f7);">
            Esta aplicación está construida utilizando el siguiente *stack* tecnológico:
        </p>
        <ul class="list-unstyled" style="color: var(--vc-light, #f7f7f7);">
            <li class="mb-2"><strong>Framework:</strong> Laravel (PHP)</li>
            <li class="mb-2"><strong>Base de Datos:</strong> MySQL</li>
            <li class="mb-2"><strong>Frontend/UI:</strong> Bootstrap 5 y Blade Templates</li>
            <li class="mb-2"><strong>Assets Bundler:</strong> Vite</li>
        </ul>
    </div>
    
    <div class="text-center mt-5">
        <a href="{{ route('main') }}" class="btn btn-primary" style="background-color: var(--vc-red, #e50914); border-color: var(--vc-red, #e50914); color: white; font-weight: 600;">
            ← Volver al Dashboard Principal
        </a>
    </div>
</div>


</div>
@endsection