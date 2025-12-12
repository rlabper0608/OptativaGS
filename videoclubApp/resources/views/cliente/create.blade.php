@extends('bootstrap.template')

@section('title')
Añadir Cliente
@endsection

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/cliente/createStyle.css') }}">
@endsection

@section('content')
<form action="{{ route('cliente.store') }}" method="post" enctype="multipart/form-data"> 
    @csrf
    <div class="espacio">
        @error('DNI')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="DNI">DNI:</label>
        <input class="form-control"  minlength="9" maxlength="9" required id="DNI" name="DNI" placeholder="DNI del cliente" value="{{ old('DNI') }}" type="text">
    </div>
    <div class="espacio">
        @error('nombre')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="nombre">Nombre:</label>
        <input class="form-control" minlength="3" maxlength="60" required id="nombre" name="nombre" placeholder="Nombre del cliente" value="{{ old('nombre') }}" type="text">
    </div>
    <div class="espacio">
        @error('apellidos')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="apellidos">Apellidos:</label>
        <input class="form-control" minlength="3" maxlength="60" required id="apellidos" name="apellidos" placeholder="Apellidos del cliente" value="{{ old('apellidos') }}" type="text">
    </div>
    <div class="espacio">
        @error('telefono')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="telefono">Teléfono:</label>
        <input class="form-control" minlength="9" maxlength="9" required id="telefono" name="telefono" placeholder="Teléfono de contacto" value="{{ old('telefono') }}" type="text">
    </div>
    <div class="espacio">
        @error('email')
        <div class="alert alert-danger">
            {{ $message }}
        </div>
        @enderror
        <label for="email">Email:</label>
        <input class="form-control" minlength="3" maxlength="70" required id="email" name="email" placeholder="Correo de contacto" value="{{ old('email') }}" type="text">
    </div>
    <div>
        @error('foto')
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
        <input class="form-control" id="foto" name="foto" type="file" accept="image/*" style="display: none;">
    </div>
    <div class="espacio">
        <input class="btn btn-primary" value="Añadir Cliente" type="submit">
    </div>
</form>
@endsection

@section('scripts')
<script src="{{  url('assets/js/arrastrarPerfil.js') }}"></script>
@endsection