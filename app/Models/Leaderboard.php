<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    public function index()
    {
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
        $event = Contest::findOrFail($id); // Usamos $event para mantener consistencia

        // CONSULTA ESPECIAL: Obtener Equipos, Puntos y el Líder
        $ranking = DB::table('leaderboard')
            ->join('users', 'leaderboard.user_id', '=', 'users.id')
            ->join('contest_registrations', function($join) {
                $join->on('leaderboard.user_id', '=', 'contest_registrations.user_id')
                     ->on('leaderboard.contest_id', '=', 'contest_registrations.contest_id');
            })
            ->where('leaderboard.contest_id', $id)
            ->orderByDesc('leaderboard.points') // Ordenar: Más puntos primero
            ->select(
                'users.name as user_name',
                'contest_registrations.team_name',
                'leaderboard.points',
                'leaderboard.problems_solved'
            )
            ->get();

        $hallOfFame = $ranking->take(3);

        // OJO: Retornamos la vista en la carpeta 'clasificacion', no 'concursos'
        return view('clasificacion.show', compact('event', 'ranking', 'hallOfFame'));
    }
}