@extends('bootstrap.template')

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/valoracion/editStyle.css') }}">
@endsection

@section('content')
<form method="post" action="{{ route('valoracion.update', $valoracion->id) }}">
    @csrf
    @method('put')
    <label for="comment">Comentario</label>
    <textarea class="form-control" minlength="20" id="comment" name="comment"
        placeholder="Comment for the hairstyle" cols="60" rows="3" >{{ old('comment', $valoracion->comment) }}</textarea>
    <input class="btn btn-primary" value="Edit comentario" type="submit">
</form>
@endsection