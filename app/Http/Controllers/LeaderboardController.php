<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Obtener concursos finalizados
        $eventosFinalizados = Contest::where('status', 'Finalizado')
            ->withCount('leaderboardParticipants as participants_count')
            ->orderBy('start_date', 'desc')
            ->get();

        $stats = [
            'total_users' => \App\Models\User::count(),
            'total_events_finished' => $eventosFinalizados->count(),
        ];

        return view('clasificacion.index', compact('eventosFinalizados', 'stats'));
    }

    public function show($id)
    {
        $event = Contest::findOrFail($id);

        // --- CONSULTA CORREGIDA CON LEFT JOIN ---
        $ranking = DB::table('leaderboard')
            ->join('users', 'leaderboard.user_id', '=', 'users.id') // INNER JOIN: Solo muestra usuarios que están en la tabla Leaderboard
            
            // CAMBIO CLAVE: Usamos LEFT JOIN para no perder participantes sin registro de equipo perfecto
            ->leftJoin('contest_registrations', function($join) { 
                $join->on('leaderboard.user_id', '=', 'contest_registrations.user_id')
                     ->on('leaderboard.contest_id', '=', 'contest_registrations.contest_id');
            })
            
            ->where('leaderboard.contest_id', $id)
            ->orderByDesc('leaderboard.points')
            ->orderByDesc('leaderboard.problems_solved')
            ->select(
                'users.name as user_name',
                'contest_registrations.team_name', // Será NULL si no hay registro
                'leaderboard.points',
                'leaderboard.problems_solved'
            )
            ->get();

        $hallOfFame = $ranking->take(3);

        // Variables auxiliares
        $isRegistered = false;
        $registration = null;

        if (Auth::check()) {
            $registration = ContestRegistration::where('user_id', Auth::id())
                ->where('contest_id', $id)
                ->first();
            $isRegistered = $registration !== null;
        }

        return view('clasificacion.show', compact(
            'event', 
            'ranking', 
            'hallOfFame', 
            'isRegistered', 
            'registration'
        ));
    }
}