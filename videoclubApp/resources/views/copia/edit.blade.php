@extends('bootstrap.template')

@section('title')
Editar una Copia
@endsection

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/copia/editStyle.css') }}">
@endsection

@section('content')
<form action="{{ route('copia.update', $copia->id) }}" method="post"> 
    @csrf
    @method('put')
    <div class="espacio">
        @error('idpelicula')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="idpelicula">Copia de la película:</label>
        <select name="idpelicula" id="idpelicula" required class="form-control">
            <option value="" @if(old('idpelicula', $copia->idpelicula) == null) selected @endif disabled>Selecciona una pelicula</option>
            @foreach($peliculas as $indice=>$idpelicula)
                <option value="{{ $indice }}" @if(old('idpelicula', $copia->idpelicula) == $indice) selected @endif>{{ $idpelicula }}</option>
            @endforeach
         </select>
    </div>
    <div class="espacio">
        @error('codigo_barras')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="codigo_barras">Código de barras:</label>
        <input class="form-control" required id="codigo_barras" name="codigo_barras" minlength="10" maxlength="10" value="{{ old('codigo_barras', $copia->codigo_barras) }}" type="text">
    </div>
    <div class="espacio">
        @error('estado')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="estado">Estado de la copia:</label>
        <select class="form-control" required id="estado" name="estado">
            <option>Elige el estado</option>
            <option value="Disponible" @if(old('estado', $copia->estado) == 'Disponible') selected @endif>Disponible</option>
            <option value="Alquilado" @if(old('estado', $copia->estado) == 'Alquilado') selected @endif>Alquilado</option>
            <option value="Estropeado" @if(old('estado', $copia->estado) == 'Estropeado') selected @endif>Estropeado</option>
        </select>
    </div>
    <div class="espacio">
        @error('formato')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="formato">Formato de la copia:</label>
        <select class="form-control" required id="formato" name="formato">
            <option>Elige el formato</option>
            <option value="DVD" @if(old('formato', $copia->formato) == 'DVD') selected @endif>DVD</option>
            <option value="Blu-Ray" @if(old('formato', $copia->formato) == 'Blu-Ray') selected @endif>Blu-Ray</option>
            <option value="CD" @if(old('formato', $copia->formato) == 'CD') selected @endif>CD</option>
        </select>
    </div>
    
    <div class="espacio">
        <input class="btn btn-primary" value="Añadir Copia" type="submit">
    </div>
</form>
@endsection