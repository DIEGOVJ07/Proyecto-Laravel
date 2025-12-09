<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContestController extends Controller
{
    /**
     * Mostrar detalles del concurso
     */
    public function show($id)
    {
        // 1. Cargamos el concurso y sus resultados (igual que en LeaderboardController)
        $contest = Contest::with(['leaderboardParticipants' => function($query) {
            $query->orderByPivot('points', 'desc');
        }])->findOrFail($id);
        
        // 2. Preparamos las variables del Ranking para la vista
        $topUsers = $contest->leaderboardParticipants;
        $hallOfFame = $topUsers->take(3);
        $userPosition = null;

        // 3. Lógica de registro (Tu código original)
        $isRegistered = false;
        $registration = null;
        
        if (Auth::check()) {
            // Verificar registro
            $registration = ContestRegistration::where('user_id', Auth::id())
                ->where('contest_id', $id)
                ->first();
            $isRegistered = $registration !== null;

            // Verificar posición en el ranking
            $userPosition = $topUsers->firstWhere('id', Auth::id());
        }
        
        // 4. Enviamos TODAS las variables a la vista
        return view('concursos.show', [
            'event' => $contest, // La vista espera 'event'
            'isRegistered' => $isRegistered,
            'registration' => $registration,
            'hallOfFame' => $hallOfFame,   // <--- Agregado para corregir el error
            'topUsers' => $topUsers,       // <--- Agregado para la tabla completa
            'userPosition' => $userPosition // <--- Agregado para mostrar "Tu resultado"
        ]);
    }

    /**
     * Registrar equipo en el concurso
     */
    public function register(Request $request, $id)
    {
        $request->validate([
            'team_name' => 'required|string|max:255',
            'max_members' => 'required|integer|min:1|max:10',
        ]);

        $contest = Contest::findOrFail($id);

        $existingRegistration = ContestRegistration::where('contest_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingRegistration) {
            return back()->with('error', 'Ya estás registrado en este concurso');
        }

        $registration = ContestRegistration::create([
            'user_id' => Auth::id(),
            'contest_id' => $id,
            'team_name' => $request->team_name,
            'team_code' => ContestRegistration::generateTeamCode(),
            'is_public' => $request->has('is_public'),
            'max_members' => $request->max_members,
            'current_members' => 1,
            'team_leader_id' => Auth::id(),
            'is_team_leader' => true,
            'status' => 'registered',
            'team_size' => 1,
            'team_members' => [],
        ]);

        $contest->increment('participants');

        return redirect()->route('leaderboard.index')
            ->with('success', '¡Equipo creado exitosamente! Tu código es: ' . $registration->team_code);
    }

    /**
     * Cancelar registro
     */
    public function cancelRegistration($id)
    {
        $registration = ContestRegistration::where('user_id', Auth::id())
            ->where('contest_id', $id)
            ->firstOrFail();

        $contest = $registration->contest;
        $registration->delete();

        if ($contest->participants > 0) {
            $contest->decrement('participants');
        }

        return redirect()->back()->with('success', 'Registro cancelado exitosamente');
    }
}