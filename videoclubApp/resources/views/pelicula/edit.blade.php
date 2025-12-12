@extends('bootstrap.template')

@section('title')
Editar Cliente
@endsection

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/pelicula/editStyle.css') }}">
@endsection

@section('content')
<form action="{{ route('pelicula.update', $pelicula->id) }}" method="post" enctype="multipart/form-data"> 
    @csrf
    @method('put')
    <div class="espacio">
        @error('titulo')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="titulo">Titulo:</label>
        <input class="form-control"  minlength="3" maxlength="60" required id="titulo" name="titulo" placeholder="Titulo de la pelicula" value="{{ old('titulo',  $pelicula->titulo) }}" type="text">
    </div>
    <div class="espacio">
        @error('director')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="director">Director:</label>
        <input class="form-control" minlength="3" maxlength="60" required id="director" name="director" placeholder="Director de la pelicula" value="{{ old('director',  $pelicula->director) }}" type="text">
    </div>
    <div class="espacio">
        @error('genero')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="genero">Genero:</label>
        <input class="form-control" minlength="3" maxlength="60" required id="genero" name="genero" placeholder="Genero de la pelicula" value="{{ old('genero',  $pelicula->genero) }}" type="text">
    </div>
    <div class="espacio">
        @error('actores')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="actores">Actores:</label>
        <textarea class="form-control"  minlength="20" required id="actores" name="actores" placeholder="Actores que aparecen en la pelicula" cols="60" rows="8" >{{ old('actores', $pelicula->actores) }}</textarea>
    </div>
    <div class="espacio">
        @error('fecha_estreno')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="fecha_estreno">Fecha de estreno de la pelicula:</label>
        <input class="form-control" required id="fecha_estreno" name="fecha_estreno"  value="{{ old('fecha_estreno',  $pelicula->fecha_estreno) }}" type="date">
    </div>
    <div class="espacio">
        @error('duracion')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="duracion">Duración de la pelicula:</label>
        <input class="form-control" min="1" max="999" required id="duracion" name="duracion" placeholder="Duración de la pelicula (minutos)" value="{{ old('duracion', $pelicula->duracion) }}" type="number">
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
            <option value="Apta para todos los publicos" @if(old('clasificacion', $pelicula->clasificacion) == 'Apta para todos los publicos') selected @endif>Apta para todos los publicos</option>
            <option value="+7" @if(old('clasificacion', $pelicula->clasificacion) == '+7') selected @endif>+7</option>
            <option value="+12" @if(old('clasificacion', $pelicula->clasificacion) == '+12') selected @endif>+12</option>
            <option value="+16" @if(old('clasificacion', $pelicula->clasificacion) == '+16') selected @endif>+16</option>
            <option value="+18" @if(old('clasificacion', $pelicula->clasificacion) == '+18') selected @endif>+18</option>
        </select>
    </div>
    <div class="espacio">
        @error('portada')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label>Portada de la pelicula:</label>
        
        @if($pelicula->portada != null)
        <div class="existing-image">
            <img src="{{ $pelicula->getPath() }}" width="200px" style="border-radius: 8px;">
            <div class="form-check mt-2">
                <input class="form-check-input" type="checkbox" value="true" id="deleteImage" name="deleteImage">
                <label class="form-check-label" for="deleteImage">
                    Eliminar imagen de la portada actual
                </label>
            </div>
        </div>
        @endif
        
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
        <input class="btn btn-primary" value="Editar Pelicula" type="submit">
    </div>
</form>
@endsection

@section('scripts')
<script src="{{  url('assets/js/arrastrar.js') }}"></script>
@endsection