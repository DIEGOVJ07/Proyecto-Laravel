<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Judge;
use App\Models\Contest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JudgeController extends Controller
{
    /**
     * Mostrar lista de jueces
     */
    public function index()
    {
        $judges = Judge::withCount('contests')
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);

        $stats = [
            'total_judges' => Judge::count(),
            'active_judges' => Judge::where('is_active', true)->count(),
            'expert_judges' => Judge::where('certification_level', 'Expert')->count(),
            'total_assignments' => DB::table('contest_judge')->count(),
        ];

        return view('admin.jueces.index', compact('judges', 'stats'));
    }

    /**
     * Mostrar formulario de creación
     */
    public function create()
    {
        return view('admin.jueces.create');
    }

    /**
     * Guardar nuevo juez
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:judges,email',
            'phone' => 'nullable|string|max:20',
            'specialty' => 'required|string|max:255',
            'institution' => 'nullable|string|max:255',
            'experience_years' => 'required|integer|min:0',
            'bio' => 'nullable|string',
            'certification_level' => 'required|in:Junior,Senior,Expert',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        Judge::create($validated);

        return redirect()->route('admin.jueces.index')
                        ->with('success', 'Juez creado exitosamente');
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Judge $judge)
    {
        return view('admin.jueces.edit', compact('judge'));
    }

    /**
     * Actualizar juez
     */
    public function update(Request $request, Judge $judge)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:judges,email,' . $judge->id,
            'phone' => 'nullable|string|max:20',
            'specialty' => 'required|string|max:255',
            'institution' => 'nullable|string|max:255',
            'experience_years' => 'required|integer|min:0',
            'bio' => 'nullable|string',
            'certification_level' => 'required|in:Junior,Senior,Expert',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $judge->update($validated);

        return redirect()->route('admin.jueces.index')
                        ->with('success', 'Juez actualizado exitosamente');
    }

    /**
     * Eliminar juez
     */
    public function destroy(Judge $judge)
    {
        $judge->delete();

        return redirect()->route('admin.jueces.index')
                        ->with('success', 'Juez eliminado exitosamente');
    }

    /**
     * Ver asignaciones de un juez
     */
    public function assignments(Judge $judge)
    {
        $judge->load('contests');
        $availableContests = Contest::whereNotIn('id', $judge->contests->pluck('id'))
                                   ->where('status', '!=', 'Finalizado')
                                   ->get();

        return view('admin.jueces.assignments', compact('judge', 'availableContests'));
    }

    /**
     * Asignar juez a concurso
     */
    public function assignToContest(Request $request, Judge $judge)
    {
        $validated = $request->validate([
            'contest_id' => 'required|exists:contests,id',
            'role' => 'required|string|max:255',
        ]);

        if (!$judge->contests()->where('contest_id', $validated['contest_id'])->exists()) {
            $judge->contests()->attach($validated['contest_id'], [
                'role' => $validated['role'],
            ]);

            return back()->with('success', 'Juez asignado al concurso exitosamente');
        }

        return back()->with('error', 'El juez ya está asignado a este concurso');
    }

    /**
     * Remover juez de concurso
     */
    public function removeFromContest(Judge $judge, Contest $contest)
    {
        $judge->contests()->detach($contest->id);

        return back()->with('success', 'Juez removido del concurso');
    }

    /**
     * Cambiar estado activo/inactivo
     */
    public function toggleStatus(Judge $judge)
    {
        $judge->update(['is_active' => !$judge->is_active]);

        $status = $judge->is_active ? 'activado' : 'desactivado';
        return back()->with('success', "Juez {$status} exitosamente");
    }
}