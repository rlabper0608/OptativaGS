@extends('bootstrap.template')

@section('title')
Listado de Peliculas Alquiladas
@endsection

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/alquiler/indexStyles.css') }}">
@endsection

@section('content')

<!-- Ventanas Modales principio -->

<div class="modal fade" id="destroyModal" tabindex="-1" aria-labelledby="modalDeleteTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDeleteTitle">Confirmación de Eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Este registro de alquiler será eliminado de forma permanente.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button form="form-delete" type="submit" class="btn btn-danger">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Ventanas modales fin -->

<div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
<h2 style="color: var(--rent-accent); margin-bottom: 0;">Registro de Alquileres ({{ $alquileres->count() }})</h2>
<!-- Botón de Nuevo Alquiler -->
<a href="{{ route('alquiler.create') }}" class="btn btn-primary"
style="background-color: var(--rent-accent, #8b5cf6); border-color: var(--rent-accent, #8b5cf6); font-weight: 600;">
<i class="fas fa-plus-circle"></i> Nuevo Alquiler
</a>
</div>

<hr>


<h1>Alquileres activos</h1>
<table class="table table-hover">
  <thead>
    <tr>
        <th>#</th>
        <th>Pelicula</th>
        <th>Cliente</th>
        <th>Fecha Alquiler</th>
    </tr>
  </thead>
  <tbody>
    @foreach($alquileres as $alquiler)
        @if($alquiler->fecha_dev == null)
          <tr>
              <td>{{ $alquiler->id }}</td>
              <td>{{ $alquiler->copia->pelicula->titulo }} - {{ $alquiler->copia->formato }}</td>
              <td>{{ $alquiler->cliente->nombre }}</td>
              <td>{{ $alquiler->fecha_sal }}</td>
              <td>
                  <a href=" {{ route('alquiler.edit', $alquiler->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                  <a class="link-destroy btn btn-danger btn-sm text-white" 
                    data-bs-toggle="modal"
                    data-bs-target="#destroyModal"
                    data-href="{{ route('alquiler.destroy', $alquiler)}}" 
                    data-alumno="{{ $alquiler->id }}">Delete</a>
              </td>
          </tr>
        @endif
    @endforeach
  </tbody>
</table>
<br>
<h1>Alquileres devueltos</h1>

<table class="table table-hover">
  <thead>
    <tr>
        <th>#</th>
        <th>Pelicula</th>
        <th>Cliente</th>
        <th>Fecha Alquiler</th>
        <th>Fecha Devolución</th>
    </tr>
  </thead>
  <tbody>
    @foreach($alquileres as $alquiler)
        @if($alquiler->fecha_dev != null)
          <tr>
              <td>{{ $alquiler->id }}</td>
              <td>{{ $alquiler->copia->pelicula->titulo }} - {{ $alquiler->copia->formato }}</td>
              <td>{{ $alquiler->cliente->nombre }}</td>
              <td>{{ $alquiler->fecha_sal }}</td>
              <td>{{ $alquiler->fecha_dev }}</td>
              <td>
                  <a href=" {{ route('alquiler.edit', $alquiler->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                  <a class="link-destroy btn btn-danger btn-sm text-white" 
                    data-bs-toggle="modal"
                    data-bs-target="#destroyModal"
                    data-href="{{ route('alquiler.destroy', $alquiler)}}" 
                    data-alumno="{{ $alquiler->id }}">Delete</a>
              </td>
          </tr>
        @endif
    @endforeach
  </tbody>
  <tfoot>
    <tr>
        <th colspan="3">Número de alquileres registrados:</th>
        <th>{{ count($alquileres) }}</th>
    </tr>
  </tfoot>
</table>

<form action="" method="post" id="form-delete">
    @csrf
    @method('delete')
</form>
@endsection

@section('scripts')
<script src="{{ url('assets/js/borrar.js') }}"></script>
@endsection