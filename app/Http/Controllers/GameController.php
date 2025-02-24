<?php

namespace App\Http\Controllers;
use App\Models\Podium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GameResult; // Asegúrate de tener este modelo

class GameController extends Controller
{
    public function finish(Request $request)
    {
        // Validar que se envíe un score numérico
        $request->validate([
            'score' => 'required|integer|min:0|max:10'
        ]);

        $score = $request->input('score');
        $user = Auth::user();

        Podium::create([
            'user_id' => $user->id,
            'score'   => $score,
            // 'detalle' => null, // Si decides guardar más detalles, agrégalo aquí
        ]);

        return redirect()->route('home')->with('success', "Has acertado $score de 10 banderas.");
    }
}
