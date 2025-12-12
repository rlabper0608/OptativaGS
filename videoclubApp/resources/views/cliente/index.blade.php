@extends('bootstrap.template')

@section('title')
Listado de Clientes
@endsection

@section('styles')
{{-- Enlaza el archivo CSS de estilos principales --}}

<link rel="stylesheet" href="{{ url('assets/css/cliente/indexStyle.css') }}">

<!-- CORREGIDO: Enlace directo al CDN de Font Awesome -->

<link rel="stylesheet" href="https://www.google.com/search?q=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40B7iMtyqQgS/l/e1Mh/QdJ0bN4FwV2Z8aP2E1gI1r0Z9GzR5eP+K7vK3hN+FfGjE1g/l+l+p3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom catalog-header">
{{-- La clase catalog-header aplica los estilos al h2 --}}
<h2>Listado de Clientes ({{ $clientes->count() }})</h2>

{{-- CORREGIDO: Usando la clase btn-primary-blue --}}
<a href="{{ route('cliente.create') }}" class="btn btn-primary btn-primary-blue">
<i class="fas fa-plus-circle"></i> Registrar Cliente
</a>

</div>

@if($clientes->isEmpty())

<!-- Mensaje para cuando el catálogo está vacío -->

<div class="alert alert-warning text-center">
<p class="mb-0">Aún no hay clientes registrados. ¡Añade uno!</p>
</div>

@else

<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
@foreach($clientes as $cliente)
<div class="col">
<div class="card h-100 poster-card shadow-lg">

            <!-- Área de Fotografía (Reemplaza Portada) -->
            <div class="poster-image-container">
                <img src="{{ $cliente->getPath() }}"  class="card-img-top poster-image"  alt="">
            </div>
            
            <!-- Cuerpo de la Tarjeta (Detalles) -->
            <div class="card-body text-center d-flex flex-column">
                <h5 class="card-title mb-1"> 
                    {{ $cliente->nombre }} {{ $cliente->apellidos }} 
                </h5>
                <p class="card-text mb-3">
                    Email: {{ $cliente->email ?? 'No disponible' }}
                </p>

                <!-- Botones de Acción -->
                <div class="mt-auto d-grid gap-2">
                    {{-- CORREGIDO: Usando la clase btn-outline-primary-blue --}}
                    <a href="{{ route('cliente.show', $cliente->id) }}" class="btn btn-sm btn-outline-primary-blue">
                        Ver Perfil
                    </a>
                    {{-- CORREGIDO: Usando la clase btn-outline-secondary-blue --}}
                    <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-sm btn-outline-secondary-blue">
                        Editar
                    </a>
                </div>
            </div>
        </div> 
    </div>
@endforeach


</div>

@endif
@endsection