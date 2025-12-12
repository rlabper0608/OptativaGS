@extends('bootstrap.template')

@section('title')
Añadir pelicula
@endsection

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/pelicula/createStyle.css') }}">
@endsection

@section('content')
<form action="{{ route('pelicula.store') }}" method="post" enctype="multipart/form-data"> 
    @csrf
    <div class="espacio">
        @error('titulo')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="titulo">Titulo:</label>
        <input class="form-control"  minlength="3" maxlength="60" required id="titulo" name="titulo" placeholder="Titulo de la pelicula" value="{{ old('titulo') }}" type="text">
    </div>
    <div class="espacio">
        @error('director')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="director">Director:</label>
        <input class="form-control" minlength="3" maxlength="60" required id="director" name="director" placeholder="Director de la pelicula" value="{{ old('director') }}" type="text">
    </div>
    <div class="espacio">
        @error('genero')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="genero">Género:</label>
        <input class="form-control" minlength="3" maxlength="60" required id="genero" name="genero" placeholder="Genero de la pelicula" value="{{ old('genero') }}" type="text">
    </div>
    <div class="espacio">
        @error('actores')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="actores">Actores:</label>
        <textarea class="form-control"  minlength="20" required id="actores" name="actores" placeholder="Actores que aparecen en la pelicula" cols="60" rows="8" >{{ old('actores') }}</textarea>
    </div>
    <div class="espacio">
        @error('fecha_estreno')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="fecha_estreno">Fecha de estreno de la pelicula:</label>
        <input class="form-control" required id="fecha_estreno" name="fecha_estreno"  value="{{ old('fecha_estreno') }}" type="date">
    </div>
    <div class="espacio">
        @error('duracion')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="duracion">Duración de la pelicula:</label>
        <input class="form-control" min="1" max="999" required id="duracion" name="duracion" placeholder="Duración de la pelicula (minutos)" value="{{ old('duracion') }}" type="number">
    </div>
    <div class="espacio">
        @error('clasificacion')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="clasificacion">Clasifiación de la pelicula:</label>
        <select class="form-control" required id="clasificacion" name="clasificacion">
            <option>Clasificación</option>
            <option value="Apta para todos los publicos" @if(old('clasificacion') == 'Apta para todos los publicos') selected @endif>Apta para todos los publicos</option>
            <option value="+7" @if(old('clasificacion') == '+7') selected @endif>+7</option>
            <option value="+12" @if(old('clasificacion') == '+12') selected @endif>+12</option>
            <option value="+16" @if(old('clasificacion') == '+16') selected @endif>+16</option>
            <option value="+18" @if(old('clasificacion') == '+18') selected @endif>+18</option>
        </select>
    </div>
    <div>
        @error('portada')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <!-- Zona de Drag & Drop -->
        <div id="dropZone" class="drop-zone">
            <div class="drop-zone-icon">📷</div>
            <div class="drop-zone-text">
                <strong>Arrastra una imagen aquí</strong> o haz clic para seleccionar
                <br>
                <small>Formatos: JPG, PNG, GIF (Máx. 2MB)</small>
            </div>
            <div id="imagePreview"></div>
        </div>
        <!-- Input oculto (se activa con el drag & drop o click) -->
        <input class="form-control" id="portada" name="portada" type="file" accept="image/*" style="display: none;">
    </div>
    <div class="espacio">
        <input class="btn btn-primary" value="Añadir Pelicula" type="submit">
    </div>
</form>
@endsection

@section('scripts')
<script src="{{  url('assets/js/arrastrar.js') }}"></script>
@endsection