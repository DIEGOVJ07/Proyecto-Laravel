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
        $contest = Contest::findOrFail($id);
        
        // Verificar si el usuario ya está registrado
        $isRegistered = false;
        $registration = null;
        
        if (Auth::check()) {
            $registration = ContestRegistration::where('user_id', Auth::id())
                ->where('contest_id', $id)
                ->first();
            $isRegistered = $registration !== null;
        }
        
        return view('contests.show', compact('contest', 'isRegistered', 'registration'));
    }

    /**
     * Registrar equipo en el concurso
     */
    public function register(Request $request, $id)
    {
        $contest = Contest::findOrFail($id);
        
        // Validar datos
        $validated = $request->validate([
            'team_name' => 'required|string|max:255',
            'team_size' => 'required|integer|min:' . $contest->min_team_members . '|max:' . $contest->max_team_members,
            'leader_phone' => 'required|string|max:20',
            'members' => 'required|array|min:' . $contest->min_team_members,
            'members.*.name' => 'required|string|max:255',
            'members.*.birthdate' => 'required|date|before:today',
        ]);

        // Verificar si ya está registrado
        $existingRegistration = ContestRegistration::where('user_id', Auth::id())
            ->where('contest_id', $id)
            ->first();

        if ($existingRegistration) {
            return redirect()->back()->with('error', 'Ya estás registrado en este concurso');
        }

        // Crear registro
        ContestRegistration::create([
            'user_id' => Auth::id(),
            'contest_id' => $id,
            'team_name' => $validated['team_name'],
            'team_size' => $validated['team_size'],
            'team_members' => $validated['members'],
            'leader_phone' => $validated['leader_phone'],
            'status' => 'registered',
        ]);

        // Incrementar contador de participantes
        $contest->increment('participants');

        return redirect()->route('profile.index')->with('success', '¡Te has registrado exitosamente al concurso!');
    }

    /**
     * Cancelar registro
     */
    public function cancelRegistration($id)
    {
        $registration = ContestRegistration::where('user_id', Auth::id())
            ->where('contest_id', $id)
            ->firstOrFail();

        $registration->delete();

        // Decrementar contador de participantes
        $registration->contest->decrement('participants');

        return redirect()->route('profile.index')->with('success', 'Registro cancelado exitosamente');
    }
}