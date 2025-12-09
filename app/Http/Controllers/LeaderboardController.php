<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestRegistration; // Necesario para la consulta
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Para obtener el nombre del líder

class LeaderboardController extends Controller
{
    public function index()
    {
        // El index se mantiene igual (muestra la lista de concursos finalizados)
        $eventosFinalizados = Contest::where('status', 'Finalizado')
            ->withCount('registrations as participants_count') // Usar registrations_count si es más preciso
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

        // --- CONSULTA CORREGIDA: Ranking basado ÚNICAMENTE en contest_registrations.score ---
        $ranking = ContestRegistration::where('contest_id', $id)
            ->where('score', '>', 0) // Excluir equipos con score 0 (no calificados o que no enviaron)
            ->orderByDesc('score')    // 1. Clasificación por score (puntos)
            ->orderByDesc('updated_at') // 2. Desempate: Más reciente (opcional, podrías usar problemas_resueltos si existiera)
            ->with('teamLeader')      // Cargamos el modelo User del líder para mostrar su nombre
            ->get();
        // ---------------------------------------------------------------------------------

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

        // Renombramos la variable para que la vista sea más fácil de leer
        return view('clasificacion.show', [
            'event' => $event, 
            'ranking' => $ranking, // Collection de ContestRegistration
            'hallOfFame' => $hallOfFame,
            'isRegistered' => $isRegistered, 
            'registration' => $registration
        ]);
    }
}