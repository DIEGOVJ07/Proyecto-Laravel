<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contest;
use App\Models\ContestRegistration;
use Illuminate\Http\Request;

class AdminContestController extends Controller
{
    /**
     * Panel principal de administración
     */
    public function index()
    {
        $contests = Contest::withCount('registrations')
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        return view('admin.concursos.index', compact('contests'));
    }

    /**
     * Ver equipos participantes de un concurso
     */
    public function teams($id)
    {
        $contest = Contest::with(['registrations.user'])->findOrFail($id);
        
        return view('admin.concursos.teams', compact('contest'));
    }

    /**
     * Crear nuevo concurso
     */
    public function create()
    {
        return view('admin.concursos.create');
    }

    /**
     * Guardar nuevo concurso
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Activo,Próximamente,Finalizado',
            'difficulty' => 'required|in:Fácil,Medio,Difícil',
            'duration' => 'required|string',
            'prize' => 'required|numeric|min:0',
            'languages' => 'required|array|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'rules' => 'nullable|string',
            'requirements' => 'nullable|string',
            'min_team_members' => 'required|integer|min:1',
            'max_team_members' => 'required|integer|min:1',
        ]);

        Contest::create($validated);

        return redirect()->route('admin.contests.index')->with('success', 'Concurso creado exitosamente');
    }

    /**
     * Eliminar equipo de un concurso
     */
    public function deleteTeam($contestId, $registrationId)
    {
        $registration = ContestRegistration::where('contest_id', $contestId)
            ->where('id', $registrationId)
            ->firstOrFail();

        $registration->delete();

        // Decrementar contador de participantes
        Contest::find($contestId)->decrement('participants');

        return redirect()->back()->with('success', 'Equipo eliminado exitosamente');
    }

    /**
     * Cerrar concurso
     */
    public function close($id)
    {
        $contest = Contest::findOrFail($id);
        $contest->update(['status' => 'Finalizado']);

        return redirect()->back()->with('success', 'Concurso cerrado exitosamente');
    }

    /**
     * Eliminar concurso
     */
    public function destroy($id)
    {
        $contest = Contest::findOrFail($id);
        $contest->delete();

        return redirect()->route('admin.contests.index')->with('success', 'Concurso eliminado exitosamente');
    }

    /**
     * Marcar equipo como clasificado
     */
    public function qualify($contestId, $registrationId)
    {
        $registration = ContestRegistration::where('contest_id', $contestId)
            ->where('id', $registrationId)
            ->firstOrFail();

        $registration->update(['status' => 'qualified']);

        return redirect()->back()->with('success', 'Equipo clasificado exitosamente');
    }

    /**
     * Desclasificar equipo
     */
    public function disqualify($contestId, $registrationId)
    {
        $registration = ContestRegistration::where('contest_id', $contestId)
            ->where('id', $registrationId)
            ->firstOrFail();

        $registration->update(['status' => 'registered']);

        return redirect()->back()->with('success', 'Equipo desclasificado');
    }
}