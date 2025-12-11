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

// PÁGINA PÚBLICA
Route::get('/', WelcomeController::class)->name('welcome');

// AUTENTICACIÓN (GUEST)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});


// USUARIOS AUTENTICADOS (GENERAL)
// AQUÍ AGREGAMOS 'verified' PARA OBLIGAR A CONFIRMAR EMAIL
Route::middleware(['auth', 'verified'])->group(function () {
    
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
    
    // Gestión de Equipos (Participante) - Rutas específicas primero
    Route::get('/equipos/buscar', function() { return view('equipos.search'); })->name('equipos.search.form');
    Route::post('/equipos/buscar', [TeamController::class, 'search'])->name('equipos.search');
    Route::post('/equipos/{team}/unirse', [TeamController::class, 'join'])->name('equipos.join');
    Route::delete('/equipos/{team}/salir', [TeamController::class, 'leave'])->name('equipos.leave');
    Route::get('/concursos/{contest}/equipos-publicos', [TeamController::class, 'publicTeams'])->name('equipos.public');
    
    // Concursos (Vista Participante) - Rutas específicas antes que genéricas
    Route::post('/concursos/{id}/registrar', [ContestController::class, 'register'])->name('concursos.register');
    Route::delete('/concursos/{id}/cancelar', [ContestController::class, 'cancelRegistration'])->name('concursos.cancel');
    Route::post('/concursos/{id}/certificado', [ContestController::class, 'requestCertificate'])->name('concursos.certificate');
    Route::post('/concursos/{id}/subir-archivo', [ContestController::class, 'uploadFile'])->name('concursos.upload-file');
    Route::post('/concursos/{id}/actualizar-github', [ContestController::class, 'updateGithubLink'])->name('concursos.update-github');
    Route::get('/concursos/{contest}/descargar-archivo/{registration}', [ContestController::class, 'downloadFile'])->name('concursos.download-file');
    Route::get('/concursos/{id}', [ContestController::class, 'show'])->name('concursos.show');

    // Clasificación (Leaderboard)
    Route::get('/clasificacion', [LeaderboardController::class, 'index'])->name('clasificacion.index');
    Route::get('/clasificacion/{id}', [LeaderboardController::class, 'show'])->name('clasificacion.show');

    // Sedes
    Route::get('/sedes', [VenueController::class, 'index'])->name('sedes.index');
    Route::get('/sedes/{id}', [VenueController::class, 'show'])->name('sedes.show');
    
    // Blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/blog/crear/nuevo', [BlogController::class, 'create'])->name('blog.create')->middleware('can:create,App\Models\Post');
    Route::post('/blog', [BlogController::class, 'store'])->name('blog.store')->middleware('can:create,App\Models\Post');
    Route::post('/blog/posts/{post}/like', [BlogController::class, 'like'])->name('blog.like');
});

// SUPER usuario (SOLO SUPER ADMIN)
Route::middleware(['auth', 'verified', 'super_admin'])->prefix('admin')->name('admin.')->group(function () {
    // Gestión de Usuarios
    Route::resource('usuarios', UserController::class);
    Route::post('usuarios/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('usuarios.toggle-status');
    Route::post('usuarios/{user}/assign-role', [UserController::class, 'assignRole'])->name('usuarios.assign-role');
});

// GESTIÓN Y ADMINISTRACIÓN (ADMIN, SUPER_ADMIN Y JUEZ)
// Permitimos entrar a 'admin', 'super_admin' O 'juez' usando el middleware de roles de Spatie
Route::middleware(['auth', 'verified', 'role:admin|super_admin|juez'])->prefix('admin')->name('admin.')->group(function () {
    
    // 1. RUTAS EXCLUSIVAS DE ADMIN Y SUPER_ADMIN
    Route::middleware(['role:admin|super_admin'])->group(function () {
        
        // Gestión Avanzada de Concursos - Rutas específicas ANTES de genéricas
        Route::get('/concursos/crear', [AdminContestController::class, 'create'])->name('concursos.create');
        Route::post('/concursos', [AdminContestController::class, 'store'])->name('concursos.store');
        Route::post('/concursos/{id}/cerrar', [AdminContestController::class, 'close'])->name('concursos.close');
        Route::delete('/concursos/{id}', [AdminContestController::class, 'destroy'])->name('concursos.destroy');
        
        // Gestión Avanzada de Equipos (Eliminar, Clasificar manualmente)
        Route::delete('/concursos/{contestId}/equipos/{registrationId}', [AdminContestController::class, 'deleteTeam'])->name('concursos.equipos.delete');
        Route::post('/concursos/{contestId}/equipos/{registrationId}/clasificar', [AdminContestController::class, 'qualify'])->name('concursos.equipos.qualify');
        Route::post('/concursos/{contestId}/equipos/{registrationId}/desclasificar', [AdminContestController::class, 'disqualify'])->name('concursos.equipos.disqualify');
        
        // Gestión de Jueces (CRUD completo) - Rutas específicas primero
        Route::get('/jueces/crear', [JudgeController::class, 'create'])->name('jueces.create');
        Route::get('/jueces/{judge}/editar', [JudgeController::class, 'edit'])->name('jueces.edit');
        Route::get('/jueces/{judge}/asignaciones', [JudgeController::class, 'assignments'])->name('jueces.assignments');
        Route::get('/jueces', [JudgeController::class, 'index'])->name('jueces.index');
        Route::post('/jueces', [JudgeController::class, 'store'])->name('jueces.store');
        Route::put('/jueces/{judge}', [JudgeController::class, 'update'])->name('jueces.update');
        Route::delete('/jueces/{judge}', [JudgeController::class, 'destroy'])->name('jueces.destroy');
        Route::post('/jueces/{judge}/toggle-status', [JudgeController::class, 'toggleStatus'])->name('jueces.toggle-status');
        Route::post('/jueces/{judge}/asignar', [JudgeController::class, 'assignToContest'])->name('jueces.assign');
        Route::delete('/jueces/{judge}/concursos/{contest}', [JudgeController::class, 'removeFromContest'])->name('jueces.remove-contest');
    });
    
    // 2. RUTAS COMPARTIDAS (ADMIN, SUPER_ADMIN Y JUEZ)
    
    // Calificar equipo (Acción principal del Juez) - Ruta específica primero
    Route::post('/concursos/{contest}/equipos/{registration}/calificar', [AdminContestController::class, 'gradeTeam'])->name('concursos.equipos.grade');
    
    // Ver equipos dentro de un concurso
    Route::get('/concursos/{id}/equipos', [AdminContestController::class, 'teams'])->name('concursos.teams');
    
    // Ver lista de concursos - Ruta genérica al final
    Route::get('/concursos', [AdminContestController::class, 'index'])->name('concursos.index');
});

// Ruta pública de concursos
Route::get('/concursos-publicos', [ContestController::class, 'index'])->name('concursos.public');

// Rutas de Breeze
require __DIR__.'/auth.php';

Route::get('/test-mail', function () {
    try {
        Mail::raw('Este es un correo de prueba enviado con Resend + Laravel + Railway', function ($message) {
            $message->to('codebattle61@gmail.com')
                    ->subject('Prueba de correo con Resend');
        });

        return "Correo enviado correctamente (verifica tu bandeja).";
    } catch (\Throwable $e) {
        return "Error: " . $e->getMessage();
    }
});