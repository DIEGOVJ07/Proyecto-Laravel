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

        // Estadísticas del usuario
        $stats = [
            'total_points' => $user->total_points ?? 4523,
            'problems_solved' => $user->problems_solved ?? 89,
            'contests_won' => $user->contests_won ?? 3,
            'global_ranking' => $user->global_ranking ?? 247,
        ];

        // Si es administrador, mostrar vista de admin
        if ($user->hasRole('admin')) {
            // Obtener todos los concursos para el admin
            $contests = Contest::withCount('registrations')
                ->orderBy('start_date', 'desc')
                ->get();

            // Obtener todas las inscripciones recientes
            $recentRegistrations = ContestRegistration::with(['user', 'contest'])
                ->orderBy('created_at', 'desc')
                ->limit(10)
                ->get();

            return view('profile.admin', compact('user', 'stats', 'contests', 'recentRegistrations'));
        }

        // Vista normal para usuarios regulares
        $myContests = ContestRegistration::where('user_id', $user->id)
            ->with('contest')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('profile.index', compact('user', 'stats', 'myContests'));
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