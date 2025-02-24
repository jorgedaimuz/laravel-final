@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>Bienvenido a "Adivina la Bandera"</h1>
    @if($flag)
        <img src="{{ $flag['flag'] }}" alt="Bandera de {{ $flag['name'] }}" style="max-width: 300px;">
    @else
        <p>No se pudo cargar una bandera. Inténtalo más tarde.</p>
    @endif

    <div class="mt-3">
        @auth
            <!-- Si el usuario está autenticado, se dirige al dashboard -->
            <a href="{{ route('dashboard') }}" class="btn btn-success">Jugar</a>
        @else
            <!-- Si no, se dirige a la página de login para luego registrarse -->
            <a href="{{ route('login') }}" class="btn btn-success">Jugar</a>
        @endauth
    </div>
</div>
@endsection
