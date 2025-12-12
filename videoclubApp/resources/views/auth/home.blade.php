@extends('bootstrap.template')

@section('styles')
<link rel="stylesheet" href="{{ url('assets/css/auth/homeStyle.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Te has registrado!
                    <hr>
                    Nombre: {{ Auth::user()->name }} <br>
                    Correo: {{ Auth::user()->email }} <br>
                    Se ha creado: {{ Auth::user()->created_at->format('d/m/Y h:i:s') }} <br>
                    @if( Auth::user()->email_verified_at) 
                        Se ha verificado: {{ Auth::user()->email_verified_at->format('d/m/Y h:i:s') }} <br>
                    @else 
                        No se ha verificado todavía.<br>
                    @endif
                    
                    <a href="{{ route('home.edit') }}">Edit Your Profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
