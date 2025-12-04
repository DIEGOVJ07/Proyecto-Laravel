<?php

namespace App\Http\Controllers;

use App\Models\Leaderboard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Top 10 usuarios
        $topUsers = Leaderboard::with('user')
            ->orderBy('total_points', 'desc')
            ->take(10)
            ->get();

        // Hall of Fame (Top 3)
        $hallOfFame = $topUsers->take(3);

        // Posición del usuario actual
        $userPosition = null;
        if (Auth::check()) {
            $userPosition = Leaderboard::where('user_id', Auth::id())->first();
            
            // Si no existe, crear una entrada demo
            if (!$userPosition) {
                $userPosition = new Leaderboard([
                    'user_id' => Auth::id(),
                    'total_points' => 4523,
                    'contests_won' => 3,
                    'problems_solved' => 89,
                    'global_ranking' => 247,
                    'country_code' => 'MX',
                    'trend' => 'up',
                ]);
            }
        }

        // Estadísticas generales
        $stats = [
            'total_users' => User::count(),
            'total_contests' => \App\Models\Contest::count(),
            'active_today' => rand(150, 300),
        ];

        return view('clasificacion.index', compact('topUsers', 'hallOfFame', 'userPosition', 'stats'));
    }
}