<?php

namespace Database\Seeders;

use App\Models\Contest;
use Illuminate\Database\Seeder;

class ContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contests = [
            [
                'title' => 'Weekly Challenge #47',
                'description' => 'Algoritmos de búsqueda y ordenamiento',
                'status' => 'Activo',
                'difficulty' => 'Medio',
                'start_date' => now()->subDays(2),
                'duration' => '2 horas',
                'participants_count' => 1247,
                'prize' => '$1,000',
                'tech_stack' => ['Python', 'Java', 'C++'],
            ],
            [
                'title' => 'Data Structures Masterclass',
                'description' => 'Árboles, grafos y estructuras avanzadas',
                'status' => 'Próximamente',
                'difficulty' => 'Difícil',
                'start_date' => now()->addDays(5),
                'duration' => '3 horas',
                'participants_count' => 892,
                'prize' => '$2,500',
                'tech_stack' => ['C++', 'Java'],
            ],
            [
                'title' => 'Beginner Bootcamp',
                'description' => 'Introducción a la programación competitiva',
                'status' => 'Próximamente',
                'difficulty' => 'Fácil',
                'start_date' => now()->addDays(3),
                'duration' => '1.5 horas',
                'participants_count' => 2241,
                'prize' => '$500',
                'tech_stack' => ['Python', 'JavaScript'],
            ],
            [
                'title' => 'Dynamic Programming Sprint',
                'description' => 'Optimización y programación dinámica',
                'status' => 'Próximamente',
                'difficulty' => 'Difícil',
                'start_date' => now()->addDays(7),
                'duration' => '2.5 horas',
                'participants_count' => 654,
                'prize' => '$1,500',
                'tech_stack' => ['Python', 'C++', 'Java'],
            ],
            [
                'title' => 'Graph Theory Challenge',
                'description' => 'Algoritmos de grafos y caminos mínimos',
                'status' => 'Finalizado',
                'difficulty' => 'Medio',
                'start_date' => now()->subDays(10),
                'duration' => '2 horas',
                'participants_count' => 1532,
                'prize' => '$1,200',
                'tech_stack' => ['Java', 'C++'],
            ],
            [
                'title' => 'String Algorithms Battle',
                'description' => 'Manipulación y búsqueda de cadenas',
                'status' => 'Finalizado',
                'difficulty' => 'Medio',
                'start_date' => now()->subDays(15),
                'duration' => '2 horas',
                'participants_count' => 987,
                'prize' => '$800',
                'tech_stack' => ['Python', 'JavaScript', 'C++'],
            ],
        ];

        foreach ($contests as $contest) {
            Contest::create($contest);
        }
    }
}
