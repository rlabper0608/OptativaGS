@extends('bootstrap.template')

@section('title')
Listado de Peliculas Alquiladas 
@endsection

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/copia/indexStyle.css') }}">
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
        <p>Esta copia será eliminada permanentemente.</p>
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
<h2 style="color: var(--rent-accent); margin-bottom: 0;">Lista de Copias ({{ $copias->count() }})</h2>
@auth
  @if(Auth::user()->hasVerifiedEmail())
    <a href="{{ route('copia.create') }}" class="btn btn-primary"
    style="background-color: var(--rent-accent, #8b5cf6); border-color: var(--rent-accent, #8b5cf6); font-weight: 600;">
      <i class="fas fa-plus-circle"></i> Nueva Copia
    </a>
  @endif
@endauth

</div>

<hr>

<table class="table table-hover">
  <thead>
    <tr>
        <th>#</th>
        <th>Pelicula</th>
        <th>Codigo de barras</th>
        <th>Formato</th>
        @auth
            @if(Auth::user()->hasVerifiedEmail())
              <th>Estado</th>
            @endif
        @endauth
    </tr>
  </thead>
  <tbody>
    @foreach($copias as $copia)
        <tr>
            <td>{{ $copia->id }}</td>
            <td>{{ $copia->pelicula->titulo }}</td>
            <td>{{ $copia->codigo_barras}}</td>
            <td>{{ $copia->formato }}</td>
            @auth
            @if(Auth::user()->hasVerifiedEmail())
            <td>{{ $copia->estado }}</td>
                <td>
                    <a href=" {{ route('copia.edit', $copia->id) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                    <a class="link-destroy btn btn-danger btn-sm text-white" 
                      data-bs-toggle="modal"
                      data-bs-target="#destroyModal"
                      data-href="{{ route('copia.destroy', $copia)}}" 
                      data-alumno="{{ $copia->id }}">Delete</a>
                </td>
              @endif
            @endauth
        </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
        <th colspan="3">Número de copias registradas:</th>
        <th>{{ count($copias) }}</th>
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