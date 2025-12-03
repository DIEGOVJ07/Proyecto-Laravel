<?php

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\Admin\AdminContestController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

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
});

// Rutas de administración (solo admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Panel de concursos
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
});

// Rutas Breeze
require __DIR__.'/auth.php';