<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestRegistration;
use App\Models\Leaderboard; // Importante si usas el modelo, aunque aquí usamos DB
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        $eventosFinalizados = Contest::where('status', 'Finalizado')
            ->withCount('leaderboardParticipants as participants_count')
            ->orderBy('start_date', 'desc')
            ->get();

        $stats = [
            'total_users' => User::count(),
            'total_events_finished' => $eventosFinalizados->count(),
        ];

        return view('clasificacion.index', compact('eventosFinalizados', 'stats'));
    }

    public function show($id)
    {
        $event = Contest::findOrFail($id);

        // 1. Obtener Ranking (Query Builder optimizado)
        // Usamos LEFT JOIN para traer datos aunque falten relaciones, pero filtramos por score > 0
        $ranking = ContestRegistration::where('contest_id', $id)
            ->where('score', '>', 0)
            ->orderByDesc('score')
            ->orderByDesc('updated_at')
            ->with('teamLeader') // Cargar relación del líder
            ->get();

        $hallOfFame = $ranking->take(3);
        
        // 2. Lógica de verificación del Usuario Actual (CORREGIDA PARA MIEMBROS)
        $isRegistered = false;
        $registration = null;

        if (Auth::check()) {
            $userId = Auth::id();
            
            // BUSCAMOS SI EL USUARIO ES LÍDER O MIEMBRO
            $registration = ContestRegistration::where('contest_id', $id)
                ->where(function($query) use ($userId) {
                    $query->where('user_id', $userId) // Es Líder
                          ->orWhereHas('members', function($q) use ($userId) {
                              $q->where('user_id', $userId); // Es Miembro
                          });
                })
                ->first();

            $isRegistered = $registration !== null;
        }

        return view('clasificacion.show', [
            'event' => $event, 
            'ranking' => $ranking, 
            'hallOfFame' => $hallOfFame,
            'isRegistered' => $isRegistered, 
            'registration' => $registration
        ]);
    }
}