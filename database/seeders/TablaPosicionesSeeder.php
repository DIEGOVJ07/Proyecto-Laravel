<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class TablaPosicionesSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear Concursos
        // CORRECCIÓN: Usamos 'name' y 'start_date' que son los que tu base de datos pide.
        
        $contestInvierno = Contest::create([
            'name' => 'Batalla de Algoritmos de Cadenas',      // Antes decía 'title'
            'description' => 'Manipulación y búsqueda de cadenas',
            'status' => 'Finalizado',                          // Ajustado a 'Finalizado' para que coincida con tu panel
            'start_date' => Carbon::parse('2025-11-22'),       // Antes decía 'event_date' -> ESTO CAUSABA EL ERROR
            'end_date' => Carbon::parse('2025-11-23'),         // Agregamos end_date por si es requerido
            'difficulty' => 'Medio',
            'prize' => 800,
            'duration' => '24 horas',
            'languages' => ['PHP', 'Python', 'Java'],
            'min_team_members' => 1,
            'max_team_members' => 3
        ]);

        $contestGrafos = Contest::create([
            'name' => 'Reto de Teoría de Grafos',
            'description' => 'Algoritmos de grafos y caminos mínimos',
            'status' => 'Finalizado',
            'start_date' => Carbon::parse('2025-11-20'),       // Antes decía 'event_date'
            'end_date' => Carbon::parse('2025-11-21'),
            'difficulty' => 'Medio',
            'prize' => 1200,
            'duration' => '48 horas',
            'languages' => ['C++', 'Java'],
            'min_team_members' => 1,
            'max_team_members' => 3
        ]);

        // 2. Usuarios de prueba
        $usersData = [
            ['name' => 'CodeMaster_3000', 'email' => 'codemaster@codebattle.com'],
            ['name' => 'AlgoQueen', 'email' => 'algoqueen@codebattle.com'],
            ['name' => 'ByteNinja', 'email' => 'byteninja@codebattle.com'],
            ['name' => 'StackOverflow404', 'email' => 'stack404@codebattle.com'],
            ['name' => 'RecursiveGenius', 'email' => 'recursive@codebattle.com'],
        ];

        foreach ($usersData as $data) {
            $user = User::firstOrCreate(
                ['email' => $data['email']],
                ['name' => $data['name'], 'password' => Hash::make('password123')]
            );

            // Asignar puntos en el Concurso 1
            $contestInvierno->leaderboardParticipants()->attach($user->id, [
                'points' => rand(800, 1500),
                'problems_solved' => rand(5, 10),
                'contest_id' => $contestInvierno->id
            ]);

            // Asignar puntos en el Concurso 2
            $contestGrafos->leaderboardParticipants()->attach($user->id, [
                'points' => rand(400, 1000),
                'problems_solved' => rand(3, 8),
                'contest_id' => $contestGrafos->id
            ]);
        }
        
        // Calcular ranks
        $this->calcRank($contestInvierno);
        $this->calcRank($contestGrafos);
    }

    private function calcRank($contest) {
        $participants = $contest->leaderboardParticipants()->orderByPivot('points', 'desc')->get();
        $rank = 1;
        foreach($participants as $p) {
            $contest->leaderboardParticipants()->updateExistingPivot($p->id, ['rank' => $rank++]);
        }
    }
}