<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        // Consumir la API para obtener banderas
        $response = Http::get('https://countriesnow.space/api/v0.1/countries/flag/images');
        $flag = null;
        if ($response->successful()){
            $countries = $response->json()['data'];
            shuffle($countries);
            $flag = $countries[0];
        }
        // Retornamos la vista home con la bandera aleatoria
        return view('home', compact('flag'));
    }
}
