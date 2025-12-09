<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminContestController;
use App\Http\Controllers\Admin\JudgeController;

// ==========================================
// PÁGINA PÚBLICA
// ==========================================
Route::get('/', WelcomeController::class)->name('welcome');

// ==========================================
// AUTENTICACIÓN (GUEST)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

// ==========================================
// USUARIOS AUTENTICADOS (GENERAL)
// ==========================================
Route::middleware('auth')->group(function () {
    
    // Logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Dashboard (Redirección)
    Route::get('/dashboard', function () {
        return redirect()->route('profile.index');
    })->name('dashboard');
    
    // Perfil
    Route::get('/mi-perfil', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Concursos (Vista Usuario)
    Route::get('/concursos/{id}', [ContestController::class, 'show'])->name('contests.show');
    Route::post('/concursos/{id}/registrar', [ContestController::class, 'register'])->name('contests.register');
    Route::delete('/concursos/{id}/cancelar', [ContestController::class, 'cancelRegistration'])->name('contests.cancel');

    // Gestión de Equipos (Usuario)
    Route::post('/equipos/buscar', [TeamController::class, 'search'])->name('teams.search');
    Route::post('/equipos/{team}/unirse', [TeamController::class, 'join'])->name('teams.join');
    Route::delete('/equipos/{team}/salir', [TeamController::class, 'leave'])->name('teams.leave');
    Route::get('/concursos/{contest}/equipos-publicos', [TeamController::class, 'publicTeams'])->name('teams.public');

    // Clasificación (Leaderboard)
    Route::get('/clasificacion', [LeaderboardController::class, 'index'])->name('leaderboard.index');
    Route::get('/clasificacion/{id}', [LeaderboardController::class, 'show'])->name('leaderboard.show');

    // Sedes
    Route::get('/sedes', [VenueController::class, 'index'])->name('venues.index');
    Route::get('/sedes/{id}', [VenueController::class, 'show'])->name('venues.show');
    
    // Blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
});

// ==========================================
// ADMINISTRACIÓN (SOLO ADMIN)
// ==========================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Gestión de Concursos
    Route::get('/concursos', [AdminContestController::class, 'index'])->name('contests.index');
    Route::get('/concursos/crear', [AdminContestController::class, 'create'])->name('contests.create');
    Route::post('/concursos', [AdminContestController::class, 'store'])->name('contests.store');
    Route::delete('/concursos/{id}', [AdminContestController::class, 'destroy'])->name('contests.destroy');
    Route::post('/concursos/{id}/cerrar', [AdminContestController::class, 'close'])->name('contests.close');
    
    // Gestión de Equipos en Concursos
    Route::get('/concursos/{id}/equipos', [AdminContestController::class, 'teams'])->name('contests.teams');
    Route::delete('/concursos/{contestId}/equipos/{registrationId}', [AdminContestController::class, 'deleteTeam'])->name('contests.teams.delete');
    
    // Calificación y Clasificación
    Route::post('/concursos/{contestId}/equipos/{registrationId}/clasificar', [AdminContestController::class, 'qualify'])->name('contests.teams.qualify');
    Route::post('/concursos/{contestId}/equipos/{registrationId}/desclasificar', [AdminContestController::class, 'disqualify'])->name('contests.teams.disqualify');
    Route::post('contests/{contest}/teams/{registration}/grade', [AdminContestController::class, 'gradeTeam'])->name('contests.teams.grade');
    
    // Gestión de Jueces
    Route::get('/jueces', [JudgeController::class, 'index'])->name('judges.index');
    Route::get('/jueces/crear', [JudgeController::class, 'create'])->name('judges.create');
    Route::post('/jueces', [JudgeController::class, 'store'])->name('judges.store');
    Route::get('/jueces/{judge}/editar', [JudgeController::class, 'edit'])->name('judges.edit');
    Route::put('/jueces/{judge}', [JudgeController::class, 'update'])->name('judges.update');
    Route::delete('/jueces/{judge}', [JudgeController::class, 'destroy'])->name('judges.destroy');
    Route::post('/jueces/{judge}/toggle-status', [JudgeController::class, 'toggleStatus'])->name('judges.toggle-status');
    
    // Asignaciones de Jueces
    Route::get('/jueces/{judge}/asignaciones', [JudgeController::class, 'assignments'])->name('judges.assignments');
    Route::post('/jueces/{judge}/asignar', [JudgeController::class, 'assignToContest'])->name('judges.assign');
    Route::delete('/jueces/{judge}/concursos/{contest}', [JudgeController::class, 'removeFromContest'])->name('judges.remove-contest');
});

// Rutas de Breeze (recuperación de contraseña, etc.)
require __DIR__.'/auth.php';