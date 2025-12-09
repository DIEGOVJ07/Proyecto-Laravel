<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        // 1. Obtener todos los concursos
        $contests = Contest::whereIn('status', ['Activo', 'Próximamente'])
                          ->orderBy('start_date', 'asc')
                          ->get();

        // 2. OBTENER EL PRIMER CONCURSO DE LA LISTA
        // Esto crea la variable $nextEvent que te falta
        $nextEvent = $contests->first();

        // 3. ENVIAR AMBAS VARIABLES A LA VISTA
        // Nota que ahora incluimos 'nextEvent' dentro de compact
        return view('welcome', compact('contests', 'nextEvent'));
    }
}