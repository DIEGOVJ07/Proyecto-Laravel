<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Leaderboard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LeaderboardSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'CodeMaster_3000', 'email' => 'codemaster@codebattle.com', 'points' => 12847, 'won' => 24, 'solved' => 342, 'trend' => 'up', 'country' => 'MX'],
            ['name' => 'AlgoQueen', 'email' => 'algoqueen@codebattle.com', 'points' => 11932, 'won' => 19, 'solved' => 318, 'trend' => 'stable', 'country' => 'ES'],
            ['name' => 'ByteNinja', 'email' => 'byteninja@codebattle.com', 'points' => 11204, 'won' => 17, 'solved' => 295, 'trend' => 'up', 'country' => 'AR'],
            ['name' => 'StackOverflow404', 'email' => 'stack404@codebattle.com', 'points' => 10856, 'won' => 15, 'solved' => 287, 'trend' => 'down', 'country' => 'CO'],
            ['name' => 'RecursiveGenius', 'email' => 'recursive@codebattle.com', 'points' => 10234, 'won' => 14, 'solved' => 271, 'trend' => 'up', 'country' => 'CL'],
            ['name' => 'BinaryBeast', 'email' => 'binary@codebattle.com', 'points' => 9847, 'won' => 12, 'solved' => 256, 'trend' => 'stable', 'country' => 'MX'],
            ['name' => 'HashMapHero', 'email' => 'hashmap@codebattle.com', 'points' => 9432, 'won' => 11, 'solved' => 243, 'trend' => 'up', 'country' => 'PE'],
            ['name' => 'LoopLegend', 'email' => 'loop@codebattle.com', 'points' => 9124, 'won' => 10, 'solved' => 238, 'trend' => 'down', 'country' => 'MX'],
            ['name' => 'ArrayAce', 'email' => 'array@codebattle.com', 'points' => 8765, 'won' => 9, 'solved' => 225, 'trend' => 'stable', 'country' => 'BR'],
            ['name' => 'GraphGuru', 'email' => 'graph@codebattle.com', 'points' => 8423, 'won' => 8, 'solved' => 207, 'trend' => 'stable', 'country' => 'EC'],
            ['name' => 'SortSorcerer', 'email' => 'sort@codebattle.com', 'points' => 8192, 'won' => 8, 'solved' => 198, 'trend' => 'up', 'country' => 'MX'],
            ['name' => 'TreeTitan', 'email' => 'tree@codebattle.com', 'points' => 7956, 'won' => 7, 'solved' => 189, 'trend' => 'down', 'country' => 'VE'],
            ['name' => 'QueueQueen', 'email' => 'queue@codebattle.com', 'points' => 7654, 'won' => 7, 'solved' => 175, 'trend' => 'stable', 'country' => 'UY'],
            ['name' => 'StackStrategist', 'email' => 'strategist@codebattle.com', 'points' => 7321, 'won' => 6, 'solved' => 162, 'trend' => 'up', 'country' => 'PY'],
            ['name' => 'LinkedLion', 'email' => 'linked@codebattle.com', 'points' => 6987, 'won' => 6, 'solved' => 154, 'trend' => 'stable', 'country' => 'BO'],
        ];

        foreach ($users as $index => $userData) {
            // Crear usuario
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password123'),
                'role' => 'user',
            ]);

            // Crear entrada en leaderboard
            Leaderboard::create([
                'user_id' => $user->id,
                'total_points' => $userData['points'],
                'contests_won' => $userData['won'],
                'problems_solved' => $userData['solved'],
                'global_ranking' => $index + 1,
                'country_code' => $userData['country'],
                'trend' => $userData['trend'],
            ]);
        }
    }
}