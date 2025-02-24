<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http; // Solo si lo vas a usar en closures
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\FlagController;

// Ruta de inicio: muestra la nueva página de inicio personalizada
Route::get('/', [HomeController::class, 'index'])->name('home');

// Grupo de rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard personalizado que muestra una bandera aleatoria y un botón "Jugar"
    Route::get('/dashboard', function () {
        $response = Http::get('https://countriesnow.space/api/v0.1/countries/flag/images');
        $flag = null;
        if ($response->successful()) {
            $countries = $response->json()['data'];
            shuffle($countries);
            $flag = $countries[0];
        }
        return view('dashboard', compact('flag'));
    })->name('dashboard');

    // Ruta para el juego: la implementación actual del juego de banderas
    Route::get('/flags', [FlagController::class, 'index'])->name('flags.index');

    // Si aún necesitas las rutas intermedias del juego, puedes conservarlas:
    Route::get('/game/start', [GameController::class, 'start'])->name('game.start');
    Route::get('/game/question', [GameController::class, 'question'])->name('game.question');
    Route::post('/game/answer', [GameController::class, 'answer'])->name('game.answer');
    Route::get('/game/result', [GameController::class, 'result'])->name('game.result');

    // La ruta para finalizar el juego, en la versión actual ahora solo redirige al dashboard
    Route::post('/game/finish', [GameController::class, 'finish'])->name('game.finish');
});

// Rutas de perfil (las que Breeze ya te dejó)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
