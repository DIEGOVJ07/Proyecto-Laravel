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
    $request->validate([
        'team_name' => 'required|string|max:255',
        'max_members' => 'required|integer|min:1|max:10',
    ]);

    $contest = Contest::findOrFail($id);

    // Verificar si el usuario ya está registrado en este concurso
    $existingRegistration = ContestRegistration::where('contest_id', $id)
                                              ->where('user_id', Auth::id())
                                              ->first();

    if ($existingRegistration) {
        return back()->with('error', 'Ya estás registrado en este concurso');
    }

    // Crear el registro del equipo
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
    ]);

    return redirect()->route('profile.index')
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

        $registration->delete();

        // Decrementar contador de participantes
        $registration->contest->decrement('participants');

        return redirect()->route('profile.index')->with('success', 'Registro cancelado exitosamente');
    }


    
}