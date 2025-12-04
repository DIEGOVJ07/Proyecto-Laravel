<?php

namespace App\Console\Commands;

use App\Models\Leaderboard;
use Illuminate\Console\Command;

class UpdateLeaderboard extends Command
{
    protected $signature = 'leaderboard:update';
    protected $description = 'Update leaderboard rankings based on points';

    public function handle()
    {
        $this->info('Updating leaderboard rankings...');

        // Ordenar por puntos y asignar ranking
        $entries = Leaderboard::orderBy('total_points', 'desc')->get();
        
        foreach ($entries as $index => $entry) {
            $oldRanking = $entry->global_ranking;
            $newRanking = $index + 1;
            
            // Determinar tendencia
            if ($oldRanking && $newRanking < $oldRanking) {
                $trend = 'up';
            } elseif ($oldRanking && $newRanking > $oldRanking) {
                $trend = 'down';
            } else {
                $trend = 'stable';
            }
            
            $entry->update([
                'global_ranking' => $newRanking,
                'trend' => $trend,
            ]);
        }

        $this->info('Leaderboard updated successfully!');
    }
}