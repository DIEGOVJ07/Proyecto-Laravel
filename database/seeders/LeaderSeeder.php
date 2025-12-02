<?php

namespace Database\Seeders;

use App\Models\Leader;
use Illuminate\Database\Seeder;

class LeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leaders = [
            [
                'name' => 'CodeMaster_3000',
                'country' => 'MX',
                'points' => 12847,
                'wins' => 24,
                'solved' => 342,
                'trend' => 'up',
                'initial' => 'C',
                'color' => 'bg-cb-green',
            ],
            [
                'name' => 'AlgoQueen',
                'country' => 'ES',
                'points' => 11932,
                'wins' => 19,
                'solved' => 318,
                'trend' => 'flat',
                'initial' => 'A',
                'color' => 'bg-teal-500',
            ],
            [
                'name' => 'ByteNinja',
                'country' => 'AR',
                'points' => 11204,
                'wins' => 17,
                'solved' => 295,
                'trend' => 'up',
                'initial' => 'B',
                'color' => 'bg-cyan-600',
            ],
            [
                'name' => 'StackOverflow404',
                'country' => 'CO',
                'points' => 10856,
                'wins' => 15,
                'solved' => 287,
                'trend' => 'down',
                'initial' => 'S',
                'color' => 'bg-indigo-500',
            ],
            [
                'name' => 'RecursiveGenius',
                'country' => 'CL',
                'points' => 10234,
                'wins' => 14,
                'solved' => 271,
                'trend' => 'up',
                'initial' => 'R',
                'color' => 'bg-emerald-500',
            ],
            [
                'name' => 'BinaryBeast',
                'country' => 'MX',
                'points' => 9847,
                'wins' => 12,
                'solved' => 256,
                'trend' => 'flat',
                'initial' => 'B',
                'color' => 'bg-blue-500',
            ],
        ];

        foreach ($leaders as $leader) {
            Leader::create($leader);
        }
    }
}
