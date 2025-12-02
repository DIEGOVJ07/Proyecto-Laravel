<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Muestra el perfil público del usuario con estadísticas de CodeBattle.
     * Funciona para invitados y usuarios logueados.
     */
    public function index(): View
    {
        // Si hay usuario logueado, usa sus datos; si no, usa datos demo
        $user = Auth::user() ?? $this->getDemoUser();
        
        // Estadísticas del usuario
        $stats = [
            'total_points' => $user->total_points ?? 4523,
            'problems_solved' => $user->problems_solved ?? 89,
            'contests_won' => $user->contests_won ?? 3,
            'global_ranking' => $user->global_ranking ?? 247,
        ];
        
        // Progreso de puntos por mes (últimos 6 meses)
        $pointsProgress = $this->getPointsProgress($user);
        
        // Estadísticas de envíos
        $submissionStats = [
            'accepted' => $user->submissions_accepted ?? 125,
            'error' => $user->submissions_error ?? 18,
            'time_limit' => $user->submissions_time_limit ?? 12,
        ];
        
        return view('profile.index', compact(
            'user',
            'stats',
            'pointsProgress',
            'submissionStats'
        ));
    }
    
    /**
     * Obtiene el progreso de puntos por mes.
     * Puedes adaptar esto para consultar desde la base de datos.
     */
    private function getPointsProgress($user): array
    {
        // Datos de ejemplo - puedes reemplazarlos con consultas reales a tu BD
        $months = ['Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
        $points = [300, 450, 600, 750, 900, 1050];
        
        return [
            'months' => $months,
            'points' => $points
        ];
    }
    
    /**
     * Crea un usuario demo para mostrar la interfaz sin autenticación.
     */
    private function getDemoUser(): object
    {
        return (object) [
            'id' => 0,
            'name' => 'Usuario Demo',
            'email' => 'demo@codebattle.com',
            'created_at' => now()->subMonths(5),
            'total_points' => 4523,
            'problems_solved' => 89,
            'contests_won' => 3,
            'global_ranking' => 247,
            'submissions_accepted' => 125,
            'submissions_error' => 18,
            'submissions_time_limit' => 12,
        ];
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
