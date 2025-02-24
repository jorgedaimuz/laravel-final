@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="mb-4">Adivina el nombre del País</h1>
    @if(count($flags) > 0)
        @foreach($flags as $index => $flag)
            <div class="mb-5 border p-3" id="question-{{ $index }}">
                <img src="{{ $flag['flag'] }}" alt="Bandera de {{ $flag['name'] }}" style="max-width: 200px;">
                <div class="mt-3">
                    @php
                        // Obtener la lista completa de países desde la sesión
                        $allCountries = session('countries', []);
                        $alternativeNames = [];
                        // Filtra para obtener nombres distintos al correcto
                        foreach($allCountries as $country) {
                             if($country['name'] !== $flag['name']) {
                                 $alternativeNames[] = $country['name'];
                             }
                        }
                        // Mezcla y toma 3 alternativas
                        shuffle($alternativeNames);
                        $options = array_merge([$flag['name']], array_slice($alternativeNames, 0, 3));
                        // Mezcla las opciones para que la correcta no siempre esté en la misma posición
                        shuffle($options);
                    @endphp

                    @foreach($options as $option)
                        <button class="btn btn-primary option-btn" data-correct="{{ $flag['name'] }}" onclick="checkAnswer(event, {{ $index }})">
                            {{ $option }}
                        </button>
                    @endforeach
                </div>
                <div class="mt-2" id="result-{{ $index }}"></div>
            </div>
        @endforeach

        <!-- Sección final: botón para finalizar el juego (se mostrará solo al contestar la última bandera) -->
        <div id="final-result" class="mt-5" style="display: none;">
            <h2 id="final-message"></h2>
            <!-- En lugar de enviar el resultado a la base de datos, redirigimos al dashboard -->
            <a href="{{ route('dashboard') }}" class="btn btn-success">Volver al Dashboard</a>
        </div>

    @else
        <p>No se pudieron cargar las banderas. Intenta nuevamente más tarde.</p>
    @endif
</div>

<script>
// Variable global para contar los aciertos
let contador = 0;

function checkAnswer(event, questionId) {
    const button = event.target;
    const correctAnswer = button.getAttribute('data-correct');
    const userAnswer = button.textContent.trim();
    const resultDiv = document.getElementById('result-' + questionId);

    // Deshabilitar todos los botones de la pregunta actual
    const container = document.getElementById('question-' + questionId);
    const buttons = container.querySelectorAll('.option-btn');
    buttons.forEach(btn => btn.disabled = true);

    // Verificar respuesta
    if (userAnswer === correctAnswer) {
        resultDiv.textContent = "¡Correcto!";
        resultDiv.style.color = "green";
        contador++;
    } else {
        resultDiv.textContent = "Incorrecto. La respuesta correcta es: " + correctAnswer;
        resultDiv.style.color = "red";
    }

    // Si es la última pregunta (suponiendo 10 banderas, índices 0 a 9)
    if (questionId === 9) {
        // Mostrar sección final
        document.getElementById('final-result').style.display = 'block';
        // Mostrar mensaje final con el contador
        document.getElementById('final-message').textContent = "Has acertado " + contador + " de 10 banderas.";
    }
}
</script>
@endsection
