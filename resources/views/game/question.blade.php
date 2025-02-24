<!-- resources/views/game/question.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h2>Pregunta {{ session('question_count') + 1 }} de 10</h2>
    <p>¿A qué país pertenece esta bandera?</p>
    <img src="{{ $country['flag'] }}" alt="Bandera de {{ $country['name'] }}" style="max-width: 300px;">

    <form action="{{ route('game.answer') }}" method="POST" class="mt-4">
        @csrf
        <div class="form-group">
            <input type="text" name="answer" class="form-control" placeholder="Escribe el nombre del país" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Enviar Respuesta</button>
    </form>
</div>
@endsection
