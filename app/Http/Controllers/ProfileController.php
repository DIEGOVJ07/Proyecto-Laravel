<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Contest;
use App\Models\ContestRegistration;

class ProfileController extends Controller
{
    /**
     * Display the user's profile with CodeBattle stats
     */
    public function index(): View
    {
        $user = Auth::user();

        // Obtener registros del usuario con sus concursos
        $myRegistrations = ContestRegistration::where('user_id', $user->id)
            ->with('contest')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calcular estadísticas reales con verificación segura
        $leaderboard = $user->leaderboard()->first();
        $totalPoints = $leaderboard ? $leaderboard->points : 0;
        $totalContests = $myRegistrations->count();
        $contestsWon = $myRegistrations->where('score', '>=', 80)->count(); // Considerar ganado si score >= 80
        $globalRanking = $leaderboard ? $leaderboard->rank : '-';

        // Obtener concursos ganados (con mejor posición)
        $wonContests = $myRegistrations
            ->where('score', '>=', 80)
            ->sortByDesc('score')
            ->take(5);

        // Obtener concursos recientes
        $recentContests = $myRegistrations->take(5);

        $stats = [
            'total_points' => $totalPoints,
            'total_contests' => $totalContests,
            'contests_won' => $contestsWon,
            'global_ranking' => $globalRanking,
        ];

        return view('profile.dashboard', compact('user', 'stats', 'wonContests', 'recentContests'));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.settings', [
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