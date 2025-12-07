<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\Admin\AdminContestController;
use App\Http\Controllers\Admin\JudgeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;

// Landing page (pública)
Route::get('/', WelcomeController::class)->name('welcome');

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Rutas protegidas (usuarios autenticados)
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('profile.index');
    })->name('dashboard');
    
    // Perfil
    Route::get('/mi-perfil', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Concursos
    Route::get('/concursos/{id}', [ContestController::class, 'show'])->name('contests.show');
    Route::post('/concursos/{id}/registrar', [ContestController::class, 'register'])->name('contests.register');
    Route::delete('/concursos/{id}/cancelar', [ContestController::class, 'cancelRegistration'])->name('contests.cancel');

    // Sedes
    Route::get('/sedes', [VenueController::class, 'index'])->name('venues.index');
    Route::get('/sedes/{id}', [VenueController::class, 'show'])->name('venues.show');
    
    // Blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');

    // Clasificación (Leaderboard)
    Route::get('/clasificacion', [LeaderboardController::class, 'index'])->name('leaderboard.index');
});

        // Rutas protegidas (usuarios autenticados)
        Route::middleware('auth')->group(function () {
            // ... rutas existentes ...
            
            // ==========================================
            // GESTIÓN DE EQUIPOS
            // ==========================================
            // Buscar equipo por código
            Route::post('/equipos/buscar', [TeamController::class, 'search'])->name('teams.search');
            
            // Unirse a un equipo
            Route::post('/equipos/{team}/unirse', [TeamController::class, 'join'])->name('teams.join');
            
            // Salir de un equipo
            Route::delete('/equipos/{team}/salir', [TeamController::class, 'leave'])->name('teams.leave');
            
            // Ver equipos públicos de un concurso
            Route::get('/concursos/{contest}/equipos-publicos', [TeamController::class, 'publicTeams'])->name('teams.public');
        });


// Rutas de administración (solo admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // ==========================================
    // GESTIÓN DE CONCURSOS
    // ==========================================
    Route::get('/concursos', [AdminContestController::class, 'index'])->name('contests.index');
    Route::get('/concursos/crear', [AdminContestController::class, 'create'])->name('contests.create');
    Route::post('/concursos', [AdminContestController::class, 'store'])->name('contests.store');
    Route::delete('/concursos/{id}', [AdminContestController::class, 'destroy'])->name('contests.destroy');
    Route::post('/concursos/{id}/cerrar', [AdminContestController::class, 'close'])->name('contests.close');
    
    // Equipos participantes
    Route::get('/concursos/{id}/equipos', [AdminContestController::class, 'teams'])->name('contests.teams');
    Route::delete('/concursos/{contestId}/equipos/{registrationId}', [AdminContestController::class, 'deleteTeam'])->name('contests.teams.delete');
    Route::post('/concursos/{contestId}/equipos/{registrationId}/clasificar', [AdminContestController::class, 'qualify'])->name('contests.teams.qualify');
    Route::post('/concursos/{contestId}/equipos/{registrationId}/desclasificar', [AdminContestController::class, 'disqualify'])->name('contests.teams.disqualify');
    
    // ==========================================
    // GESTIÓN DE JUECES
    // ==========================================
    // CRUD de Jueces
    Route::get('/jueces', [JudgeController::class, 'index'])->name('judges.index');
    Route::get('/jueces/crear', [JudgeController::class, 'create'])->name('judges.create');
    Route::post('/jueces', [JudgeController::class, 'store'])->name('judges.store');
    Route::get('/jueces/{judge}/editar', [JudgeController::class, 'edit'])->name('judges.edit');
    Route::put('/jueces/{judge}', [JudgeController::class, 'update'])->name('judges.update');
    Route::delete('/jueces/{judge}', [JudgeController::class, 'destroy'])->name('judges.destroy');
    Route::post('/jueces/{judge}/toggle-status', [JudgeController::class, 'toggleStatus'])->name('judges.toggle-status');
    
    // Asignaciones de jueces a concursos
    Route::get('/jueces/{judge}/asignaciones', [JudgeController::class, 'assignments'])->name('judges.assignments');
    Route::post('/jueces/{judge}/asignar', [JudgeController::class, 'assignToContest'])->name('judges.assign');
    Route::delete('/jueces/{judge}/concursos/{contest}', [JudgeController::class, 'removeFromContest'])->name('judges.remove-contest');
});

// Rutas Breeze
require __DIR__.'/auth.php';