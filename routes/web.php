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
use App\Http\Controllers\Admin\UserController;

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
    
    // Concursos (Vista Participante)
    Route::get('/concursos/{id}', [ContestController::class, 'show'])->name('contests.show');
    Route::post('/concursos/{id}/registrar', [ContestController::class, 'register'])->name('contests.register');
    Route::delete('/concursos/{id}/cancelar', [ContestController::class, 'cancelRegistration'])->name('contests.cancel');

    // Gestión de Equipos (Participante)
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
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/blog/crear/nuevo', [BlogController::class, 'create'])->name('blog.create')->middleware('can:create,App\Models\Post');
    Route::post('/blog', [BlogController::class, 'store'])->name('blog.store')->middleware('can:create,App\Models\Post');
    Route::post('/blog/posts/{post}/like', [BlogController::class, 'like'])->name('blog.like');
});

// ==========================================
// SUPER ADMINISTRACIÓN (SOLO SUPER ADMIN)
// ==========================================
Route::middleware(['auth', 'super_admin'])->prefix('admin')->name('admin.')->group(function () {
    // Gestión de Usuarios
    Route::resource('users', UserController::class);
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::post('users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assign-role');
});

// ==========================================
// GESTIÓN Y ADMINISTRACIÓN (ADMIN, SUPER_ADMIN Y JUEZ)
// ==========================================
// Permitimos entrar a 'admin', 'super_admin' O 'juez' usando el middleware de roles de Spatie
Route::middleware(['auth', 'role:admin|super_admin|juez'])->prefix('admin')->name('admin.')->group(function () {
    
    // -----------------------------------------------------------
    // 1. RUTAS COMPARTIDAS (ADMIN, SUPER_ADMIN Y JUEZ)
    // -----------------------------------------------------------
    
    // Ver lista de concursos (El Juez solo verá opción de "Ver Equipos")
    Route::get('/concursos', [AdminContestController::class, 'index'])->name('contests.index');
    
    // Ver equipos dentro de un concurso
    Route::get('/concursos/{id}/equipos', [AdminContestController::class, 'teams'])->name('contests.teams');
    
    // Calificar equipo (Acción principal del Juez)
    Route::post('contests/{contest}/teams/{registration}/grade', [AdminContestController::class, 'gradeTeam'])->name('contests.teams.grade');

    // -----------------------------------------------------------
    // 2. RUTAS EXCLUSIVAS DE ADMIN Y SUPER_ADMIN (El Juez NO entra aquí)
    // -----------------------------------------------------------
    Route::middleware(['role:admin|super_admin'])->group(function () {
        
        // Gestión Avanzada de Concursos (Crear, Borrar, Cerrar)
        Route::get('/concursos/crear', [AdminContestController::class, 'create'])->name('contests.create');
        Route::post('/concursos', [AdminContestController::class, 'store'])->name('contests.store');
        Route::delete('/concursos/{id}', [AdminContestController::class, 'destroy'])->name('contests.destroy');
        Route::post('/concursos/{id}/cerrar', [AdminContestController::class, 'close'])->name('contests.close');
        
        // Gestión Avanzada de Equipos (Eliminar, Clasificar manualmente)
        Route::delete('/concursos/{contestId}/equipos/{registrationId}', [AdminContestController::class, 'deleteTeam'])->name('contests.teams.delete');
        Route::post('/concursos/{contestId}/equipos/{registrationId}/clasificar', [AdminContestController::class, 'qualify'])->name('contests.teams.qualify');
        Route::post('/concursos/{contestId}/equipos/{registrationId}/desclasificar', [AdminContestController::class, 'disqualify'])->name('contests.teams.disqualify');
        
        // Gestión de Jueces (CRUD completo)
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
});

// Rutas de Breeze
require __DIR__.'/auth.php';