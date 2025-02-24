<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FlagController extends Controller
{
   // app/Http/Controllers/FlagController.php
public function index()
{
    $response = Http::get('https://countriesnow.space/api/v0.1/countries/flag/images');

    if ($response->successful()) {
        $data = $response->json()['data'];
        // Guarda la lista completa en sesión para obtener alternativas
        session(['countries' => $data]);
        // Selecciona 10 banderas de forma aleatoria para las preguntas
        shuffle($data);
        $flags = array_slice($data, 0, 10);
    } else {
        $flags = [];
    }

    return view('flags.index', compact('flags'));
}

}
