<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\ContestRegistration;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Buscar equipo por código
     */
    public function search(Request $request)
    {
        $request->validate([
            'team_code' => 'required|string|size:5',
        ]);

        $team = ContestRegistration::where('team_code', strtoupper($request->team_code))
                                   ->with(['contest', 'user', 'members.user'])
                                   ->first();

        if (!$team) {
            return back()->with('error', 'Código de equipo no encontrado');
        }

        return view('equipos.show', compact('team'));
    }

    /**
     * Unirse a un equipo
     */
    public function join(Request $request, $teamId)
    {
        $team = ContestRegistration::findOrFail($teamId);

        // Verificar que el usuario no esté ya en el equipo
        if ($team->hasUser(Auth::id())) {
            return back()->with('error', 'Ya eres miembro de este equipo');
        }

        // Verificar que el equipo no esté lleno
        if ($team->isFull()) {
            return back()->with('error', 'El equipo está completo');
        }

        // Verificar que el usuario no esté en otro equipo del mismo concurso
        $existingRegistration = ContestRegistration::where('contest_id', $team->contest_id)
                                                   ->where('user_id', Auth::id())
                                                   ->first();

        if ($existingRegistration) {
            return back()->with('error', 'Ya estás registrado en otro equipo de este concurso');
        }

        // Agregar al usuario al equipo
        TeamMember::create([
            'contest_registration_id' => $team->id,
            'user_id' => Auth::id(),
            'status' => 'accepted',
        ]);

        // Actualizar contador de miembros
        $team->increment('current_members');

        return redirect()->route('profile.index')->with('success', 'Te has unido al equipo exitosamente');
    }

    /**
     * Salir de un equipo
     */
    public function leave($teamId)
    {
        $team = ContestRegistration::findOrFail($teamId);
        $member = TeamMember::where('contest_registration_id', $teamId)
                           ->where('user_id', Auth::id())
                           ->first();

        if (!$member) {
            return back()->with('error', 'No eres miembro de este equipo');
        }

        // Eliminar miembro
        $member->delete();

        // Actualizar contador
        $team->decrement('current_members');

        return back()->with('success', 'Has salido del equipo');
    }

    /**
     * Ver equipos públicos de un concurso
     */
    public function publicTeams($contestId)
    {
        $contest = Contest::findOrFail($contestId);
        $teams = ContestRegistration::where('contest_id', $contestId)
                                    ->where('is_public', true)
                                    ->where('current_members', '<', 'max_members')
                                    ->with(['user', 'members.user'])
                                    ->get();

        return view('equipos.public', compact('contest', 'teams'));
    }
}