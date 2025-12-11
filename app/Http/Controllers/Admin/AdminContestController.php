<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contest;
use App\Models\ContestRegistration;
use App\Models\Leaderboard; // <--- IMPORTANTE: Para que el ranking funcione
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContestRecognitionMail;

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
     * Ver equipos participantes
     */
    public function teams($id)
    {
        $contest = Contest::with([
            'registrations.teamLeader',
            'registrations.members.user'
        ])->findOrFail($id);
        
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

        return redirect()->route('admin.concursos.index')->with('success', 'Concurso creado exitosamente');
    }

    /**
     * Eliminar equipo
     */
    public function deleteTeam($contestId, $registrationId)
    {
        $contest = Contest::findOrFail($contestId);
        $registration = $contest->registrations()->findOrFail($registrationId);
        
        // Limpiamos también el leaderboard si existía
        Leaderboard::where('contest_id', $contestId)
            ->where('user_id', $registration->user_id)
            ->delete();

        $registration->delete();

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

        return redirect()->route('admin.concursos.index')->with('success', 'Concurso eliminado exitosamente');
    }

    /**
     * Clasificar manualmente (Botón verde "Aprobar")
     */
    public function qualify($contestId, $registrationId)
    {
        $registration = ContestRegistration::where('contest_id', $contestId)
            ->where('id', $registrationId)
            ->firstOrFail();

        $updates = ['status' => 'qualified'];
        if ($registration->score < 50) {
            $updates['score'] = 50; 
        }

        $registration->update($updates);

        // --- ACTUALIZAR RANKING PÚBLICO ---
        Leaderboard::updateOrCreate(
            ['contest_id' => $contestId, 'user_id' => $registration->user_id],
            ['points' => $registration->score ?? 50, 'problems_solved' => 1]
        );

        return redirect()->back()->with('success', 'Equipo clasificado exitosamente');
    }

    /**
     * Desclasificar manualmente
     */
    public function disqualify($contestId, $registrationId)
    {
        $registration = ContestRegistration::where('contest_id', $contestId)
            ->where('id', $registrationId)
            ->firstOrFail();

        $registration->update(['status' => 'registered']);

        // --- ELIMINAR DEL RANKING PÚBLICO ---
        Leaderboard::where('contest_id', $contestId)
            ->where('user_id', $registration->user_id)
            ->delete();

        return redirect()->back()->with('success', 'Equipo desclasificado');
    }

    /**
     * Calificar Equipo (Modal de Juez)
     * - Guarda nota en BD
     * - Actualiza Leaderboard
     * - Envía Correo de Reconocimiento
     */
    public function gradeTeam(Request $request, $contest, $registration)
    {
        // 1. Validar
        $validated = $request->validate([
            'criteria_functionality' => 'required|integer|min:0|max:40',
            'criteria_code'          => 'required|integer|min:0|max:30',
            'criteria_design'        => 'required|integer|min:0|max:30',
            'feedback'               => 'nullable|string|max:1000',
        ]);

        $registration = ContestRegistration::where('contest_id', $contest)
            ->where('id', $registration)
            ->firstOrFail();

        // 2. Calcular Totales
        $totalScore = $validated['criteria_functionality'] + 
                    $validated['criteria_code'] + 
                    $validated['criteria_design'];

        $newStatus = $totalScore >= 50 ? 'qualified' : 'disqualified';

        // 3. Guardar en Registro (Base de datos interna)
        $registration->update([
            'score' => $totalScore,
            'score_details' => [
                'functionality' => $validated['criteria_functionality'],
                'code'          => $validated['criteria_code'],
                'design'        => $validated['criteria_design'],
            ],
            'feedback' => $validated['feedback'],
            'status' => $newStatus
        ]);

        // 4. ACTUALIZAR RANKING PÚBLICO (Leaderboard)
        // Esto soluciona que la tabla de clasificación salga en ceros
        if ($newStatus == 'qualified') {
            Leaderboard::updateOrCreate(
                ['contest_id' => $contest, 'user_id' => $registration->user_id],
                [
                    'points' => $totalScore,
                    'problems_solved' => ($totalScore > 0 ? 1 : 0) // Lógica simple para desempate
                ]
            );
        } else {
            // Si reprueba, lo sacamos del leaderboard
            Leaderboard::where('contest_id', $contest)
                ->where('user_id', $registration->user_id)
                ->delete();
        }

        // 5. ENVIAR CORREO DE RECONOCIMIENTO (desactivado temporalmente)
        // TODO: Implementar cuando el sistema de correos esté configurado

        $statusMsg = $newStatus == 'qualified' ? '¡Clasificado correctamente!' : 'No alcanzó el puntaje mínimo.';
        
        return back()->with('success', "Equipo calificado con {$totalScore} puntos. {$statusMsg}");
    }
}