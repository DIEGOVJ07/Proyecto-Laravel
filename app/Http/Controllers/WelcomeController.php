<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Controlador invocable que muestra la página principal
     * con datos simulados para concursos.
     */
    public function __invoke()
    {
        // --- Próximo Evento Destacado ---
        $nextEvent = (object) [
            'name' => 'CodeBattle Championship 2025',
            'premio' => '5.000',
            'fecha' => '15 Diciembre, 2025',
            'duracion' => '3 horas',
            'registrados' => '2.847',
            'countdown_target' => strtotime('2025-12-15 10:00:00'),
        ];

        // --- Concursos (Ejemplos Simulados) ---
        $contests = [
            (object)[
                'status' => 'Activo',
                'difficulty' => 'Medio',
                'name' => 'Weekly Challenge #47',
                'description' => 'Algoritmos de búsqueda y ordenamiento',
                'date' => '28 Nov 2025',
                'duration' => '2 horas',
                'participants' => 1247,
                'prize' => 1000,
                'languages' => ['Python', 'Java', 'C++']
            ],

            (object)[
                'status' => 'Próximamente',
                'difficulty' => 'Difícil',
                'name' => 'Data Structures Masterclass',
                'description' => 'Árboles, grafos y estructuras avanzadas',
                'date' => '30 Nov 2025',
                'duration' => '3 horas',
                'participants' => 892,
                'prize' => 2500,
                'languages' => ['C++', 'Java']
            ],

            (object)[
                'status' => 'Próximamente',
                'difficulty' => 'Fácil',
                'name' => 'Beginner Bootcamp',
                'description' => 'Introducción a la programación competitiva',
                'date' => '2 Dic 2025',
                'duration' => '1.5 horas',
                'participants' => 2241,
                'prize' => 500,
                'languages' => ['Python', 'JavaScript']
            ],

            (object)[
                'status' => 'Próximamente',
                'difficulty' => 'Difícil',
                'name' => 'Dynamic Programming Sprint',
                'description' => 'Optimización y programación dinámica',
                'date' => '5 Dic 2025',
                'duration' => '2.5 horas',
                'participants' => 654,
                'prize' => 1500,
                'languages' => ['Python', 'C++', 'Java']
            ],

            (object)[
                'status' => 'Finalizado',
                'difficulty' => 'Medio',
                'name' => 'Graph Theory Challenge',
                'description' => 'Algoritmos de grafos y caminos mínimos',
                'date' => '20 Nov 2025',
                'duration' => '2 horas',
                'participants' => 1532,
                'prize' => 1200,
                'languages' => ['Java', 'C++']
            ],

            (object)[
                'status' => 'Finalizado',
                'difficulty' => 'Medio',
                'name' => 'String Algorithms Battle',
                'description' => 'Manipulación y búsqueda de cadenas',
                'date' => '22 Nov 2025',
                'duration' => '2 horas',
                'participants' => 987,
                'prize' => 800,
                'languages' => ['Python', 'JavaScript', 'C++']
            ],
        ];

        // --- Enviar datos a la vista ---
        return view('inicio.index', compact('contests', 'nextEvent'));
    }
}
