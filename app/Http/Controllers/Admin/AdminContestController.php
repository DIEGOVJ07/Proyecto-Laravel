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
        // Obtenemos concursos y contamos las relaciones automáticamente
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
        // ADAPTACIÓN CRÍTICA:
        // Cargamos 'teamLeader' y 'members.user' para que la vista no falle al mostrar nombres.
        $contest = Contest::with([
            'registrations.teamLeader',    // Para el líder
            'registrations.members.user'   // Para los miembros del equipo
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

        return redirect()->route('admin.contests.index')->with('success', 'Concurso creado exitosamente');
    }

    /**
     * Eliminar equipo de un concurso
     */
    public function deleteTeam($contestId, $registrationId)
    {
        // Buscamos el concurso primero para asegurar consistencia
        $contest = Contest::findOrFail($contestId);

        // Buscamos el registro dentro de ese concurso
        $registration = $contest->registrations()->findOrFail($registrationId);

        $registration->delete();

        // NOTA: Eliminé la línea decrement('participants') porque al usar withCount()
        // en el index, Laravel cuenta las filas reales. Tener una columna contador manual
        // suele causar errores si se desincroniza.

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
        $contest->delete(); // Esto borrará en cascada los registros si tienes configurada la BD así

        return redirect()->route('admin.contests.index')->with('success', 'Concurso eliminado exitosamente');
    }

    /**
     * Marcar equipo como clasificado (Manual)
     */
    public function qualify($contestId, $registrationId)
    {
        $registration = ContestRegistration::where('contest_id', $contestId)
            ->where('id', $registrationId)
            ->firstOrFail();

        // Si se clasifica manualmente, le damos el mínimo de aprobación si tiene 0
        $updates = ['status' => 'qualified'];
        if ($registration->score < 50) {
            $updates['score'] = 50; // Asignar puntaje base para consistencia
        }

        $registration->update($updates);

        return redirect()->back()->with('success', 'Equipo clasificado exitosamente');
    }

    /**
     * Desclasificar equipo (Manual)
     */
    public function disqualify($contestId, $registrationId)
    {
        $registration = ContestRegistration::where('contest_id', $contestId)
            ->where('id', $registrationId)
            ->firstOrFail();

        $registration->update(['status' => 'registered']); // O 'disqualified'

        return redirect()->back()->with('success', 'Equipo desclasificado');
    }

    /**
     * ----------------------------------------------------------------
     * NUEVO MÉTODO: Calificar Equipo (Grade Team)
     * ----------------------------------------------------------------
     * Este método procesa el formulario del Modal de Alpine.js
     */
    public function gradeTeam(Request $request, $contestId, $registrationId)
    {
        // 1. Validar los puntajes
        $validated = $request->validate([
            'criteria_functionality' => 'required|integer|min:0|max:40',
            'criteria_code'          => 'required|integer|min:0|max:30',
            'criteria_design'        => 'required|integer|min:0|max:30',
            'feedback'               => 'nullable|string|max:1000',
        ]);

        // 2. Obtener el registro
        $registration = ContestRegistration::where('contest_id', $contestId)
            ->where('id', $registrationId)
            ->firstOrFail();

        // 3. Calcular total
        $totalScore = $validated['criteria_functionality'] + 
                      $validated['criteria_code'] + 
                      $validated['criteria_design'];

        // 4. Regla de Negocio: Si >= 50 Clasifica, si no, se mantiene/descalifica
        $newStatus = $totalScore >= 50 ? 'qualified' : 'disqualified';

        // 5. Guardar (Gracias a que agregamos 'score_details' al $fillable y $casts del modelo)
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

        // 6. Mensaje de retorno
        $statusMsg = $newStatus == 'qualified' ? '¡Clasificado!' : 'No alcanzó el puntaje mínimo.';
        
        return back()->with('success', "Equipo calificado con {$totalScore} puntos. {$statusMsg}");
    }
}