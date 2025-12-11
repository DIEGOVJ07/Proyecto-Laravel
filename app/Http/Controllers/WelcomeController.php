<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        // Obtener concursos Activos, Próximos y Próximamente
        $contests = Contest::whereIn('status', ['Activo', 'Próximo', 'Próximamente'])
                            ->orderByRaw("FIELD(status, 'Activo', 'Próximo', 'Próximamente')")
                            ->orderBy('start_date', 'asc')
                            ->get();

        // Obtener el primer concurso
        $nextEvent = $contests->first();

        return view('welcome', compact('contests', 'nextEvent'));
    }
}