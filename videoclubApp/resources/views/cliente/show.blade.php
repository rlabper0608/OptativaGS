@extends('bootstrap.template')

@section('title')
{{ $cliente->nombre }}
@endsection

@section('styles')

<link rel="stylesheet" href="{{ url('assets/css/cliente/showStyle.css') }}">
@endsection

@section('content')

    <!-- Ventanas Modales principio -->

    <div class="modal fade" id="destroyModal" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteTitle">¿Seguro que quieres eliminar a este cliente?</h5>
                    <!-- Usando btn-close para Bootstrap 5 -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="destroyModalContent">
                    <!-- Este contenido será rellenado por JavaScript -->
                    <p>Estás a punto de eliminar a: <strong id="modal-cliente-nombre">{{ $cliente->nombre }}</strong>.</p>
                    <p>Esta acción es irreversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button form="form-delete" type="submit" class="btn btn-danger">Eliminar Cliente</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Ventanas modales fin -->

    <main>
    <div class="card-perfil">
    <div class="perfil-flex">
        <!-- FOTOGRAFÍA -->
        <div class="p-3 p-md-0">
            <div class="perfil-foto">
                    <img src="{{ $cliente->getPath() }}" alt="">
                </div>

            <div class="perfil-botones">
                <a href="{{ route('cliente.edit', $cliente->id) }}">
                    <button>Editar</button>
                </a>

                <a data-bs-toggle="modal"
                   data-bs-target="#destroyModal"
                   data-href="{{ route('cliente.destroy', $cliente->id)}}"
                   data-cliente-nombre="{{ $cliente->nombre }} {{ $cliente->apellidos }}">
                    <button>Eliminar</button>
                </a>
            </div>
        </div>

        <!-- DATOS -->
        <div class="perfil-datos">

            {{-- Nombre Completo --}}
            <h1>{{ $cliente->nombre }} {{ $cliente->apellidos }}</h1>
            <p class="lead movie-subtitle">
                Ficha de Registro
            </p>

            <div class="perfil-item">
                DNI:
                <span>{{ $cliente->DNI }}</span>
            </div>

            <div class="perfil-item">
                Teléfono:
                <span>{{ $cliente->telefono }}</span>
            </div>

            <div class="perfil-item">
                Email:
                <span>{{ $cliente->email }}</span>
            </div>
        </div>
    </div>
</div>

    </main>

    <form action="" method="post" id="form-delete">
    @csrf
    @method('delete')
    </form>
@endsection

@section('scripts')
<script src="{{ url('assets/js/borrar.js') }}"></script>
@endsection