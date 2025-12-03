<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        // Próximo Evento Destacado
        $nextEvent = (object) [
            'name' => 'CodeBattle Championship 2025',
            'premio' => '5.000',
            'fecha' => '15 Diciembre, 2025',
            'duracion' => '3 horas',
            'registrados' => '2.847',
            'countdown_target' => strtotime('2025-12-15 10:00:00'),
        ];

        // Obtener concursos desde la base de datos
        $contests = Contest::orderBy('start_date', 'desc')->get()->map(function($contest) {
            return (object) [
                'id' => $contest->id,
                'status' => $contest->status,
                'difficulty' => $contest->difficulty,
                'name' => $contest->name,
                'description' => $contest->description,
                'date' => $contest->start_date->format('d M Y'),
                'duration' => $contest->duration,
                'participants' => $contest->participants,
                'prize' => $contest->prize,
                'languages' => $contest->languages,
            ];
        });

        return view('welcome', compact('contests', 'nextEvent'));
    }
}