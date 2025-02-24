<!-- resources/views/game/result.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Resultados del Juego</h2>
    <p>Aciertos: {{ $result['correct'] }}</p>
    <p>Errores: {{ $result['incorrect'] }}</p>
    <a href="{{ route('game.start') }}" class="btn btn-success mt-3">Jugar de Nuevo</a>
</div>
@endsection
