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
        $userId = Auth::id();
        
        // Buscar registros donde el usuario es líder
        $leaderContestIds = ContestRegistration::where('user_id', $userId)
            ->pluck('contest_id')
            ->toArray();
        
        // Buscar registros donde el usuario es miembro
        $memberContestIds = ContestRegistration::whereHas('members', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->pluck('contest_id')
            ->toArray();
        
        // Combinar ambos arrays y eliminar duplicados
        $userContestIds = array_unique(array_merge($leaderContestIds, $memberContestIds));

        // Mostrar concursos finalizados donde el usuario participó
        $eventosFinalizados = Contest::where('status', 'Finalizado')
            ->whereIn('id', $userContestIds)
            ->withCount('leaderboardParticipants as participants_count')
            ->orderBy('start_date', 'desc')
            ->get();

        // Obtener concursos activos y próximos donde el usuario está participando
        $eventosActivos = Contest::whereIn('status', ['Activo', 'Próximo', 'Próximamente'])
            ->whereIn('id', $userContestIds)
            ->withCount('registrations as participants_count')
            ->orderBy('start_date', 'desc')
            ->get();

        $stats = [
            'total_users' => User::count(),
            'total_events_finished' => $eventosFinalizados->count(),
            'total_events_active' => $eventosActivos->count(),
            'my_participations' => count($userContestIds),
        ];

        return view('clasificacion.index', compact('eventosFinalizados', 'eventosActivos', 'stats'));
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