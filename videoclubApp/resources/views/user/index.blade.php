@extends('bootstrap.template')

@section('title')
DashBoard
@endsection

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/user/indexStyle.css') }}">

@endsection

@section('content')

<table class="table table-hover">
  <thead>
    <tr>
        <th>#</th>
        <th>Correo</th>
        <th>Nombre</th>
        <th>Verificado</th>
        <th>Creado</th>
    </tr>
  </thead>
  <tbody>
    @foreach($usuarios as $usuario)
        <tr>
            <td>{{ $usuario->id }}</td>
            <td>{{ $usuario->email }}</td>
            <td>{{ $usuario->name}}</td>
            <td>{{ $usuario->email_verified_at }}</td>
            <td>{{ $usuario->created_at }}</td>
        </tr>
    @endforeach
  </tbody>
  <tfoot>
    <tr>
        <th colspan="3">Número de usuarios registradas:</th>
        <th>{{ count($usuarios) }}</th>
    </tr>
  </tfoot>
</table>
@endsection