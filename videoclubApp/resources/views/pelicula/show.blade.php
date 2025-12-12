@extends('bootstrap.template')

@section('title')
{{ $pelicula->titulo }}
@endsection

@section('styles')

<link rel="stylesheet" href="{{ url('assets/css/pelicula/showStyle.css') }}">
@endsection

@section('content')

    <!-- Ventanas Modales principio -->

    <div class="modal fade" id="destroyModal" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteTitle">¿Seguro que quieres eliminar esta película?</h5>
                    <!-- Usando btn-close para Bootstrap 5 -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="destroyModalContent">
                    <!-- Este contenido será rellenado por JavaScript -->
                    <p>Estás a punto de eliminar la película: <strong id="modal-pelicula-titulo">{{ $pelicula->titulo }}</strong>.</p>
                    <p>Esta acción es irreversible.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button form="form-delete" type="submit" class="btn btn-danger">Eliminar Película</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Ventanas modales fin -->

    <main>
    <div class="card-perfil">
    <div class="perfil-flex">

            <!-- PORTADA -->
            <div class="p-3 p-md-0">
                <div class="perfil-foto">
                    <img src="{{ $pelicula->getPath() }}" alt="">
                </div>

                @auth
                    @if(Auth::user()->hasVerifiedEmail())
                        <div class="perfil-botones">
                            <a href="{{ route('pelicula.edit', $pelicula->id) }}">
                                <button>Editar</button>
                            </a>

                            <a data-bs-toggle="modal"
                            data-bs-target="#destroyModal"
                            data-href="{{ route('pelicula.destroy', $pelicula->id)}}"
                            data-pelicula-titulo="{{ $pelicula->titulo }}">
                                <button>Eliminar</button>
                            </a>
                        </div>
                    @endif
                @endauth
            </div>

            <!-- DATOS -->
            <div class="perfil-datos">

                <h1>{{ $pelicula->titulo }}</h1>
                <p class="lead movie-subtitle">
                    Dirigida por: {{ $pelicula->director }}
                </p>

                <div class="perfil-item">
                    Género:
                    <span>{{ $pelicula->genero }}</span>
                </div>

                <div class="perfil-item">
                    Fecha de Estreno:
                    <span>{{ \Carbon\Carbon::parse($pelicula->fecha_estreno)->format('d/m/Y') }}</span>
                </div>

                <div class="perfil-item">
                    Duración:
                    <span>{{ $pelicula->duracion }} minutos</span>
                </div>

                <div class="perfil-item">
                    Clasificación:
                    <span>{{ $pelicula->clasificacion }}</span>
                </div>

                <hr class="movie-divider">

                <div class="perfil-item mt-4">
                    Actores:
                    <span>{{ $pelicula->actores }}</span>
                </div>

            </div>
        </div>
    </div>

    <h3>Comentarios</h3>
    @foreach($pelicula->valoraciones as $valoracion)
        <hr>
        <p class="lead">
            {{ $valoracion->comment }}
            @if(session('valoraciones') != null && in_array($valoracion->id, session('valoraciones')))
                <a href="{{ route('valoracion.edit', $valoracion->id) }}">editar comentario</a>
            @endif
        </p>
        <p class="text-end">
            {{ $valoracion->created_at->format('d/m/Y') }}
        </p>
    @endforeach

    @guest
        @else
            <form method="post" action="{{ route('valoracion.store', $pelicula->id) }}">
                @csrf
                <input type="hidden" name="idpelicula" value="{{ $pelicula->id }}">
                <label for="comment">Añade tu comentario</label>
                <textarea class="form-control" minlength="5" id="comment" name="comment" placeholder="Añdade tu comentario sobre esta película" cols="60" rows="8">{{old('comment')}}</textarea>
                <input class="btn btn-primary" value="Enviar Comentario" type="submit">    
            </form>
    @endguest
    </main>

    <form action="" method="post" id="form-delete">
    @csrf
    @method('delete')
    </form>
@endsection

@section('scripts')
<script src="{{ url('assets/js/borrar.js') }}"></script>
@endsection