<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        // Obtener concursos activos y próximos
        $contests = Contest::whereIn('status', ['Activo', 'Próximamente'])
                          ->orderBy('start_date', 'asc')
                          ->get();

        // Obtener el próximo evento (el primero de la lista)
        $nextEvent = $contests->first();

        return view('welcome', compact('contests', 'nextEvent'));
    }
}