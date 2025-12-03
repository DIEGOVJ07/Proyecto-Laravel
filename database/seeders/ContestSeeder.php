<?php

namespace Database\Seeders;

use App\Models\Contest;
use Illuminate\Database\Seeder;

class ContestSeeder extends Seeder
{
    public function run(): void
    {
        $contests = [
            [
                'name' => 'Weekly Challenge #47',
                'description' => 'Algoritmos de búsqueda y ordenamiento',
                'status' => 'Activo',
                'difficulty' => 'Medio',
                'duration' => '2 horas',
                'participants' => 1247,
                'prize' => 1000,
                'languages' => ['Python', 'Java', 'C++'],
                'start_date' => '2025-12-05',
                'end_date' => '2025-12-05',
                'rules' => 'Debes resolver al menos 3 de 5 problemas. No se permite el uso de IA. El código debe ser original.',
                'requirements' => 'Conocimientos básicos de algoritmos de búsqueda y ordenamiento. IDE de tu preferencia.',
                'min_team_members' => 1,
                'max_team_members' => 3,
            ],
            [
                'name' => 'Data Structures Masterclass',
                'description' => 'Árboles, grafos y estructuras avanzadas',
                'status' => 'Próximamente',
                'difficulty' => 'Difícil',
                'duration' => '3 horas',
                'participants' => 892,
                'prize' => 2500,
                'languages' => ['C++', 'Java'],
                'start_date' => '2025-12-10',
                'end_date' => '2025-12-10',
                'rules' => 'Problemas avanzados de estructuras de datos. Se requiere implementación desde cero.',
                'requirements' => 'Conocimientos avanzados de estructuras de datos y algoritmos.',
                'min_team_members' => 1,
                'max_team_members' => 2,
            ],
            [
                'name' => 'Beginner Bootcamp',
                'description' => 'Introducción a la programación competitiva',
                'status' => 'Próximamente',
                'difficulty' => 'Fácil',
                'duration' => '1.5 horas',
                'participants' => 2241,
                'prize' => 500,
                'languages' => ['Python', 'JavaScript'],
                'start_date' => '2025-12-08',
                'end_date' => '2025-12-08',
                'rules' => 'Problemas básicos para principiantes. Enfoque en lógica de programación.',
                'requirements' => 'Conocimientos básicos de programación en Python o JavaScript.',
                'min_team_members' => 1,
                'max_team_members' => 4,
            ],
            [
                'name' => 'Dynamic Programming Sprint',
                'description' => 'Optimización y programación dinámica',
                'status' => 'Próximamente',
                'difficulty' => 'Difícil',
                'duration' => '2.5 horas',
                'participants' => 654,
                'prize' => 1500,
                'languages' => ['Python', 'C++', 'Java'],
                'start_date' => '2025-12-12',
                'end_date' => '2025-12-12',
                'rules' => 'Problemas enfocados en programación dinámica y optimización.',
                'requirements' => 'Dominio de programación dinámica y técnicas de optimización.',
                'min_team_members' => 1,
                'max_team_members' => 2,
            ],
            [
                'name' => 'Graph Theory Challenge',
                'description' => 'Algoritmos de grafos y caminos mínimos',
                'status' => 'Finalizado',
                'difficulty' => 'Medio',
                'duration' => '2 horas',
                'participants' => 1532,
                'prize' => 1200,
                'languages' => ['Java', 'C++'],
                'start_date' => '2025-11-20',
                'end_date' => '2025-11-20',
                'rules' => 'Implementación de algoritmos de grafos.',
                'requirements' => 'Conocimientos de teoría de grafos.',
                'min_team_members' => 1,
                'max_team_members' => 3,
            ],
            [
                'name' => 'String Algorithms Battle',
                'description' => 'Manipulación y búsqueda de cadenas',
                'status' => 'Finalizado',
                'difficulty' => 'Medio',
                'duration' => '2 horas',
                'participants' => 987,
                'prize' => 800,
                'languages' => ['Python', 'JavaScript', 'C++'],
                'start_date' => '2025-11-22',
                'end_date' => '2025-11-22',
                'rules' => 'Problemas de procesamiento de cadenas.',
                'requirements' => 'Conocimientos de algoritmos de cadenas.',
                'min_team_members' => 1,
                'max_team_members' => 3,
            ],
        ];

        foreach ($contests as $contest) {
            Contest::create($contest);
        }
    }
}